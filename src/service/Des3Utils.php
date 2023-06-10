<?php

namespace gdkf\gdkfSdk\service;

//加密
if (function_exists('encrypt')) {
    function encrypt($input, $key)
    {
        return openssl_encrypt($input, 'des-ede3', $key, 0);
    }
}
//解密
if (function_exists('decrypt')) {
    function decrypt($encrypted, $key)
    {
        return openssl_decrypt(base64_decode($encrypted), 'des-ede3', $key, OPENSSL_RAW_DATA);
    }
}

