<?php

namespace gdkf\gdkfSdk\src\pay;

use gdkf\gdkfSdk\payClient\GdkfPayClient;
use gdkf\gdkfSdk\GdkfPayConfig;


/**
 *统一下单接口
 */

class UnifiedPayTrans
{

    private  $unifiedPayConfig;

    private $unifiedPayClient;

    public function __construct()
    {
        $this->unifiedPayConfig=new GdkfPayConfig();
        $this->unifiedPayConfig->setMchtCh(config('gdkf.config.mchtCd'));
        $this->unifiedPayConfig->setOrgCd(config('gdkf.config.secretKey'));
        $this->unifiedPayConfig->setSecretKey(config('gdkf.config.typeField'));
        $this->unifiedPayConfig->setTypeField(config('gdkf.config.orgCd'));
        $this->unifiedPayConfig->setReqUrl(config('gdkf.config.reqUrl'));
        $this->unifiedPayClient=new GdkfPayClient($this->unifiedPayConfig);
    }

    public function unifiedPay($reqData)
    {
//        //外部订单号
//        $reqData["outOrderId"] = time(); // 此处仅做示例,故以时间戳为值
//        //交易金额, 单位：元
//        $reqData["transAmt"] = "0.1";
//        //产品编号，统一下单：tran
//        $reqData["proCd"] = "tran";
//        //费率通道,1:常规通道； 2:H5支付 5:条码 7:小程序 默认：1
//        $reqData["chanelType"] = "1";
//        //订单标题，非必填
//        $reqData["outOrderTitle"] = "银典下单";
//        //订单描述，非必填
//        $reqData["outOrderDesc"] = "商城购物";
//        //异步通知地址
//        $reqData["notifyUrl"] = "商城购物";
//        //收银台回调地址，用户支付完成后显示的页面。
//        $reqData["frontUrl"] = "https://cash.yunfastpay.com/html/#/paysucc";
//        //订单有效时间,YYYYMMDDHHMMSS，默认1小时
//        $reqData["expireTime"] = "20180807171001";
//        //是否分账，0：不分账，1：分账。为空时默认分帐。
//        $reqData["isSplitBill"] = "1";
       return $this->unifiedPayClient->reqPay($reqData);
    }

}