<?php
header("Content-Type: text/html;charset=utf-8");
require_once("../utils/Des3Utils.php");

/**
 * 这个程序实现“异步回调”接口调用示例
 * 支付结果异步回调，交易发起方广东快付，请提供回调链接给快付技术。
 * 机构号，秘钥，请求地址，请在KFRequestUtil.php修改。
 * 2018-05-18
 */
class PayNotice {
    /*
     * secretKey是3des加密秘钥，测试时请替换成自己的测试秘钥，
     * 生产需要换生产秘钥，如果没有请联系广东快付的技术获取。
     * 这里可以使用机构秘钥或者商户秘钥。使用机构秘钥加密类型ORG，
     * 使用商户秘钥加密类型MCHT
     */
    static $secretKey = "WJ6X1X6IRMO2EXZYLYWWZGMY";

    public function notify(){
        try {
            $msg = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
            if (empty($msg)) {
                # 如果没有数据，直接返回失败
                echo "数据有误";exit;
            }
            echo "解密前报文：" . $msg . "<br/>";
            $reqStr = decrypt($msg, PayNotice::$secretKey);
            echo "解密后报文：" . $reqStr . "<br/>";
            $respData = json_decode($reqStr, true);
            if("100" ==  $respData["transStatus"]){
                /*交易成功*/
                echo "外部订单号：" . $respData["outOrderId"] . "<br/>"; 
                echo "支付订单号：" . $respData["orderCd"] . "<br/>"; 
                echo "交易金额：" . $respData["transAmt"] . "<br/>"; 
                /*这里建议做一下金额核对。*/
            }else if("102" == $respData["transStatus"]){ 
                /*交易失败*/
            } else {
                /*未知结果，这种情况不会有。*/
            }
        } catch (Exception $e) {
             print_r($e);
        }
        /*  一定要记得返回成功，否则，会继续通知，持续半小时。  */
        echo "{\"respCode\" : \"0000\", \"respMsg\" : \"成功\"}";
    }

}

$payNotice = new PayNotice();
$payNotice->notify();