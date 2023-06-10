<?php
header("Content-Type: text/html;charset=utf-8");
require_once("../utils/KFRequestUtil.php");

/**
 * 这个程序实现绑卡短信验证接口调用示例
 * 机构号，秘钥，请求地址，请在KFRequestUtil.java修改。
 * 2018-05-18
 */
class UnBindCard {

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
            $reqData.put["trscode"] = "TRANS7315";
            //商户编号
            $reqData.put["mchtCd"] = $mchtCd;
            //产品编号，固定：kj
            $reqData.put["proCd"] = "kj";
            //费率通道，固定1
            $reqData.put["chanelType"] = "1";
            //卡号
            //$reqData.put["settleAcct"] = "6222222";
            //绑卡协议编号
            $reqData.put["chnlCardCd"] = "123456";
            //用户编号，业务系统商户用户唯一标识
            //$reqData.put["buyerCd"] = "123456";
            //绑卡协议编号    ，业务系统商户用户唯一标识
            //$reqData.put["adddata1"] = "123456";
            
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

$agentTrans = new UnBindCard();
$agentTrans->test();
