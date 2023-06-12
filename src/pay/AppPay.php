<?php

namespace gdkf\gdkfSdk\src\pay;

use gdkf\gdkfSdk\GdkfPayConfig;
use gdkf\gdkfSdk\payClient\GdkfPayClient;

/**
 * app支付宝使用此接口，微信用统一下单接口
 */

class AppPay
{
    private  $appScanPayConfig;

    private $gdkfPayClient;

    public function __construct()
    {
        $this->appScanPayConfig=new GdkfPayConfig();
        $this->appScanPayConfig->setMchtCh(config('gdkf.config.mchtCd'));
        $this->appScanPayConfig->setOrgCd(config('gdkf.config.secretKey'));
        $this->appScanPayConfig->setSecretKey(config('gdkf.config.typeField'));
        $this->appScanPayConfig->setTypeField(config('gdkf.config.orgCd'));
        $this->appScanPayConfig->setReqUrl(config('gdkf.config.reqUrl'));
        $this->gdkfPayClient=new GdkfPayClient($this->appScanPayConfig);
    }

    public function AppClientPay()
    {

    }



}