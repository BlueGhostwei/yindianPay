<?php

require_once("Des3Utils.php");
require_once("HttpClientUtils.php");

class KFRequestUtil {
    /*
     * 秘钥类型域，机构秘钥:ORG、商户秘钥：MCHT、终端秘钥：TERM
     */
    static $typeField = "ORG";

    /*
     * secretKey是3des加密秘钥，测试时请替换成自己的测试秘钥，
     * 生产需要换生产秘钥，如果没有请联系广东快付的技术获取。
     * 这里可以使用机构秘钥或者商户秘钥。使用机构秘钥加密类型ORG，
     * 使用商户秘钥加密类型MCHT
     */
    static $secretKey = "WJ6X1X6IRMO2EXZYLYWWZGMY";

    /*
     * orgCd是机构号，测试时请替换成自己的测试机构号，
     * 生产需要换生产机构号，如果没有请联系广东快付的技术获取。
     */

    static $orgCd = "201901176661391";

    /*
     * 测试请求地址：http://test.api.route.hangmuxitong.com
     * 生产请求地址：https://api.yunfastpay.com
     */
    static $reqUrl = "http://test.api.route.hangmuxitong.com";

    public static function req($reqData){
        echo "=====>请求路径：" . KFRequestUtil::$reqUrl. "<br/>";
        echo "=====>请求参数：" . json_encode($reqData, JSON_UNESCAPED_UNICODE). "<br/>";
        $encReqData = encrypt(json_encode($reqData), KFRequestUtil::$secretKey);
        
        $data = [];
        $data["typeField"] = KFRequestUtil::$typeField;
        $data["keyField"] = KFRequestUtil::$orgCd;
        $data["dataField"] = $encReqData;

        echo "=====>请求报文：" . json_encode($data). "<br/>";
        $encRespStr = send_request(KFRequestUtil::$reqUrl, json_encode($data));
        echo "=====>返回报文：" . $encRespStr . "<br/>";
        $respMsg = json_decode($encRespStr, true);
        
        $respStr = decrypt($respMsg["dataField"], KFRequestUtil::$secretKey);
        echo "=====>返回数据：" . $respStr . "<br/>";
        return $respStr;
    }
}
