<?php

namespace gdkf\gdkfSdk\src\pay;

use gdkf\gdkfSdk\unifiedPay\UnifiedPayClient;
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
        $this->unifiedPayClient=new UnifiedPayClient($this->unifiedPayConfig);
    }

    public function unifiedPay($payContent)
    {
       return $this->unifiedPayClient->reqPay($payContent);
    }

}