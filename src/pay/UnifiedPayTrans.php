<?php

namespace gdkf\gdkfSdk\src\pay;

use gdkf\gdkfSdk\unifiedPay\UnifiedPayClient;
use gdkf\gdkfSdk\unifiedPay\UnifiedPayConfig;

/**
 * 支付宝-微信支付
 */
class UnifiedPayTrans
{

    private  $unifiedPayConfig;

    private $unifiedPayClient;

    public function __construct()
    {
        $this->unifiedPayConfig=new UnifiedPayConfig();
        $this->unifiedPayConfig->setAppid("wx15ffc9d274ae60f1");
        $this->unifiedPayConfig->setMchtCh("MCHT100011937");
        $this->unifiedPayConfig->setOrgCd("201901176661391");
        $this->unifiedPayConfig->setSecretKey("WJ6X1X6IRMO2EXZYLYWWZGMY");
        $this->unifiedPayConfig->setTypeField("ORG");
        $this->unifiedPayClient=new UnifiedPayClient($this->unifiedPayConfig);
    }

    public function unifiedPay($payContent)
    {
       return $this->unifiedPayClient->reqPay($payContent);
    }

}