<?php
header("Content-Type: text/html;charset=utf-8");
require_once("../utils/KFRequestUtil.php");

/**
 * 这个程序实现快捷支付下单接口调用示例
 * 机构号，秘钥，请求地址，请在KFRequestUtil.java修改。
 * 2018-05-18
 */
class BindCardPay {

    public function test(){
        try {
        	
            /*
            * orgCd是机构号，测试时请替换成自己的测试机构号，
            * 生产需要换生产机构号，如果没有请联系广东快付的技术获取。
            */

            static $orgCd = "201901176661391";
            /*
             * 商户号，测试时请替换成自己的测试商户号，
             * 生产需要换生产商户，如果没有请联系广东快付的技术获取。
             */
            $mchtCd = "MCHT100011937";
            //交易码
            $reqData.put["trscode"] = "TRANS1110";
            //商户编号
            $reqData.put["mchtCd"] = $mchtCd;
            //产品编号，固定：kj
            $reqData.put["proCd"] = "kj";
            //费率通道，固定1
            $reqData.put["chanelType"] = "1";
            //外部订单号
            $reqData.put["outOrderId"] = "4a1fd372b63f4ae38043cf7718263a0f";
            //交易金额
            $reqData.put["transAmt"] = "1.00";
            //卡种 1-借] =2-贷
            $reqData.put["cDPay"] = "1";
            //订单描述
            $reqData.put["outOrderTitle"] = "消费";
            //卡号 经过绑卡交易的卡号，卡号与绑卡协议编号必须二选一上送
            //$reqData.put["settleAcct"] = "asdfadfadsf";
            //绑卡协议编号
            $reqData.put["chnlCardCd"] = "123456789";
            //绑卡令牌
            //$reqData.put["adddata1"] = "123456";
            //异步通知地址
            $reqData.put["notifyUrl"] = "https://111.com";
            
            /* 发送 */
            $respStr = KFRequestUtil::req($reqData);
            $respData = json_decode($respStr, true);
            if("0000" == $respData["respCode"]){
                /* 请求成功 */
                echo $respData["respMsg"] . "<br/>";
            } else {
                /* 请求失败 */
                echo $respData["respMsg"] . "<br/>";
                /*交易状态未知，请调查询接口获取最终状态*/
            }
        } catch (Exception $e){
            print_r($e);
        }
    }
}

$agentTrans = new BindCardPay();
$agentTrans->test();
