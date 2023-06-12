<?php

namespace gdkf\gdkfSdk\service;

class Des3Utils
{
    //加密
    public static function encrypt($input, $key)
    {
        return openssl_encrypt($input, 'des-ede3', $key, 0);
    }

    //解密
    public static function decrypt($encrypted, $key)
    {
        return openssl_decrypt(base64_decode($encrypted), 'des-ede3', $key, OPENSSL_RAW_DATA);
    }

}

