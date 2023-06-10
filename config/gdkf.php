<?php

return [
    'config'=>[
        //交易码，公众号支付/小程序支付/生活号支付/H5支付/APP支付固定：TRANS1106
        'trscode'=>'',
        //商户号
        'mchtCd'=>'',
        //机构秘钥
        'secretKey'=>'',
        //秘钥类型域，机构秘钥:ORG、商户秘钥：MCHT、终端秘钥：TERM
        'typeField'=>'ORG',
        //orgCd是机构号
        'orgCd'=>'',
        //请求地址，区分测试与生产
        'reqUrl'=>'',
    ]
];