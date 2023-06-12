<?php

namespace gdkf\gdkfSdk\payClient;

use gdkf\gdkfSdk\GdkfPayConfig;
use gdkf\gdkfSdk\service\HttpClientUtils;
use gdkf\gdkfSdk\service\Des3Utils;

class GdkfPayClient
{
    public $mchtCd;

    /**
     * 网关地址
     */
    public $reqUrl;

    /**
     * 秘钥类型域，机构秘钥:ORG、商户秘钥：MCHT、终端秘钥：TERM
     */
    public $typeField;

    /**
     * secretKey是3des加密秘钥，测试时请替换成自己的测试秘钥，
     * 生产需要换生产秘钥，如果没有请联系广东快付的技术获取。
     * 这里可以使用机构秘钥或者商户秘钥。使用机构秘钥加密类型ORG，
     * 使用商户秘钥加密类型MCHT
     */
    public $secretKey;

    /**
     * orgCd是机构号，测试时请替换成自己的测试机构号，
     * 生产需要换生产机构号，如果没有请联系广东快付的技术获取。
     */
    public $orgCd;

    //产品编号，统一下单：tran
    public $proCd='tran';

    //费率通道，公众号支付：1，生活号支付：1，小程序支付：7，H5支付/APP支付：7
    public $chanelType=1;


    //订单标题，非必填
    public $outOrderTitle = '下单';

    //订单描述，非必填
    public $outOrderDesc = '购物';


    //交易码，公众号支付/小程序支付/生活号支付/H5支付/APP支付固定：TRANS1106
    private $trscode='TRANS1106';

    public function trscode()
    {
        return $this->trscode;
    }

    public function setTrscode($trscode)
    {
        $this->trscode = $trscode;
    }


    public function proCd()
    {
        return $this->proCd;
    }

    public function setProCd($proCd)
    {
        $this->proCd = $proCd;
    }

    public function chanelType()
    {
        return $this->chanelType;
    }

    public function setChanelType($chanelType)
    {
        $this->chanelType = $chanelType;
    }


    public function outOrderDesc()
    {
        return $this->outOrderDesc;
    }

    public function setOutOrderDesc($outOrderDesc)
    {
        return $this->outOrderDesc = $outOrderDesc;
    }

   public function __construct()
   {
       if(func_num_args()==1 && func_get_arg(0) instanceof GdkfPayConfig){
           $payConfig=func_get_arg(0);
           $this->mchtCd=$payConfig->getMchtCd();
           $this->reqUrl=$payConfig->getReqUrl();
           $this->typeField=$payConfig->getTypeField();
           $this->secretKey=$payConfig->getSecretKey();
           $this->orgCd=$payConfig->getOrgCd();
       }
   }

    public function reqPay($reqData)
    {
        $reqData['mchtCd']=$this->mchtCd;
        $reqData['trscode']=$this->trscode;
        $reqData['orgCd']=$this->orgCd;
        $reqData['timestamp']= date("Y-m-d H:i:s");
        //获取校验参数
        $this->checkEmpty($reqData);
        ksort($reqData);
        $encReqData = Des3Utils::encrypt(json_encode($reqData), $this->secretKey);//加密数据
        $data = [];
        $data["typeField"] = $this->typeField;
        $data["keyField"] = $this->orgCd;
        $data["dataField"] = $encReqData;
        //echo "=====>请求报文：" . json_encode($data). "<br/>";
        $encRespStr = HttpClientUtils::send_request($this->reqUrl, json_encode($data));
        //echo "=====>返回报文：" . $encRespStr . "<br/>";
        $respMsg = json_decode($encRespStr, true);
        $respStr = Des3Utils::decrypt($respMsg["dataField"], $this->secretKey);//解密数据
        //echo "=====>返回数据：" . $respStr . "<br/>";
        return $respStr;
    }


    /**
     * @param $reqData
     * @return true
     * @throws \Exception
     * 校验必传参数
     */
    public function checkEmpty($reqData)
    {
        $filte = array_filter($reqData);
        $filteKey=array_keys($filte);
        //定义必传参数
        $key=['trscode','orgCd','mchtCd','outOrderId','transAmt','proCd','chanelType','outOrderTitle','notifyUrl','isSplitBill'];
        //获取差集
        $checkRes=array_diff($filteKey,$key);
        if($checkRes){
            foreach ($checkRes as $key =>$vel){
                throw new \Exception(config('gdkf_error.'.$vel),0);
                return false;
            }
        }
        return true;
    }








}