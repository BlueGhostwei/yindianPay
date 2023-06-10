<?php

/**
 * 3Des加密解密方法
 */

//加密
function encrypt($input, $key)
{
    return openssl_encrypt($input,'des-ede3', $key, 0);
}

//解密
function decrypt($encrypted, $key)
{
    return openssl_decrypt(base64_decode($encrypted), 'des-ede3', $key, OPENSSL_RAW_DATA);
}
 