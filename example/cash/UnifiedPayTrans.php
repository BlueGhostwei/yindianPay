<?php
header("Content-Type: text/html;charset=utf-8");
require_once("../utils/KFRequestUtil.php");

/**
 * 这个程序实现“公众号支付/小程序支付/生活号支付/H5支付/APP支付”接口调用示例
 * H5支付/APP支付，通过APP跳转至小程序再发起小程序支付实现。
 * 机构号，秘钥，请求地址，请在KFRequestUtil.php修改。
 * 2018-05-18
 */
class UnifiedPayTrans {

    public function test(){
        try {
        		/*
             * orgCd是机构号，测试时请替换成自己的测试机构号，
             * 生产需要换生产机构号，如果没有请联系广东快付的技术获取。
             */
            $orgCd = "201806077798594";
            /*
             * 商户号，测试时请替换成自己的测试商户号，
             * 生产需要换生产商户，如果没有请联系广东快付的技术获取。
             */
            $mchtCd = "MCHT100012141";

            //交易码，固定：TRANS1119
            $reqData["trscode"] = "TRANS1119";
            //机构号
            $reqData["orgCd"] = $orgCd;
            //商户编号
            $reqData["mchtCd"] = $mchtCd;
            //外部订单号
            $reqData["outOrderId"] = time(); // 此处仅做示例,故以时间戳为值
            //交易金额, 单位：元
            $reqData["transAmt"] = "0.1";
            //产品编号，统一下单：tran
            $reqData["proCd"] = "tran";
            //费率通道，公众号支付：1，生活号支付：1，小程序支付：7，H5支付/APP支付：7
            $reqData["chanelType"] = "7";
            //订单标题，非必填
            $reqData["outOrderTitle"] = "下单";
            //订单描述，非必填
            $reqData["outOrderDesc"] = "购物";
            //浏览器，区分消费者支付方式：支付宝：alipay，微信：wxpay
            $reqData["browser"] = "wxpay";
            //是否分账，0：不分账，1：分账。为空时默认分帐。
            $reqData["isSplitBill"] = "0";


            /* 发送 */
            $respStr = KFRequestUtil::req($reqData);
            $respData = json_decode($respStr, true);
            if("0000" == $respData["respCode"]){
                /* 交易正常 */
                echo $respData["respMsg"] . "<br/>";
                if("100" == $respData["transStatus"]){
                    /*交易成功*/
                }else if("102" ==  $respData["transStatus"]){
                    /*交易失败*/
                } else {
                    /*交易状态未知，请调查询接口获取最终状态*/
                }
            } else {
                /* 交易异常 */
                echo $respData["respMsg"] . "<br/>";
                /*交易状态未知，请调查询接口获取最终状态*/
            }
        } catch (Exception $e){
            print_r($e);
        }
    }
}

$unifiedPayTrans = new UnifiedPayTrans();
$unifiedPayTrans->test();

