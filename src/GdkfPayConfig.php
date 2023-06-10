<?php

namespace gdkf\gdkfSdk;

class GdkfPayConfig
{

    /**
     * 商户编号
     * 商户号，测试时请替换成自己的测试商户号，
     * 生产需要换生产商户，如果没有请联系广东快付的技术获取。
     */
    private $mchtCd;

    //网关地址
    private $reqUrl;

    /**
     * 秘钥类型域，机构秘钥:ORG、商户秘钥：MCHT、终端秘钥：TERM
     */
    private $typeField;

    /**
     *
     * secretKey是3des加密秘钥，测试时请替换成自己的测试秘钥，
     * 生产需要换生产秘钥，如果没有请联系广东快付的技术获取。
     * 这里可以使用机构秘钥或者商户秘钥。使用机构秘钥加密类型ORG，
     * 使用商户秘钥加密类型MCHT
     */
    private $secretKey;

    /**
     * orgCd是机构号，测试时请替换成自己的测试机构号，
     * 生产需要换生产机构号，如果没有请联系广东快付的技术获取。
     */
    private $orgCd;


    public function typeField()
    {
        return $this->typeField;
    }

    public function setTypeField($typeField)
    {
        $this->typeField=$typeField;
    }

    public function getTypeField()
    {
        return $this->typeField;
    }

    public function secretKey()
    {
        return $this->secretKey;
    }

    public function setSecretKey($secretKey)
    {
        $this->secretKey=$secretKey;
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function orgCd()
    {
        return $this->orgCd;
    }

    public function setOrgCd($orgCd)
    {
        $this->orgCd=$orgCd;
    }

    public function getOrgCd()
    {
        return $this->orgCd;
    }
    
    public function reqUrl()
    {
        return $this->reqUrl;
    }

    public function setReqUrl($reqUrl)
    {
        $this->reqUrl=$reqUrl;
    }

    public function mchtCh()
    {
        return $this->mchtCd;
    }

    public function setMchtCh($mchtch)
    {
        $this->mchtCd = $mchtch;
    }

    public function getMchtCd()
    {
       return $this->mchtCd;
    }

    public function getReqUrl()
    {
        return $this->reqUrl;
    }
}