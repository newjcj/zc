<?php
return [
    'use_alias'    => env('WECHAT_USE_ALIAS', false),
    'app_id'       => 'wx3334e793de27a393', // 必填1
    'secret'       => '714161dfe1fc3f1f6ae78faac2217ade', // 必填1   //xingshuqi19951005xingshuqi199510
    'mchKey'        => 'xingshuqi19951005xingshuqi199510',  // 必填1
    'mchId'        => '1496813642',  // 必填1
    'token'        => 'xingshuqi19951005xingshuqi199510',  // 必填1
    'encoding_key' => env('WECHAT_ENCODING_KEY', 'YourEncodingAESKey'), // 加密模式需要，其它模式不需要   // EncodingAESKey bETUMbnw92y27orjkzSXGFx2G7W7u6J7r8vvifoS94w
    'notify_url' => 'http://'.$_SERVER['HTTP_HOST'].'/wap/pay/wnotify', // 支付回调地址
    'redirect_url' => 'http://'.$_SERVER['HTTP_HOST'].'/wap/login/wxh5pay', // h5支付返回app地址
];
//return [
//    'use_alias'    => env('WECHAT_USE_ALIAS', false),
//    'app_id'       => 'wx734346ba2e997918', // 必填
//    'secret'       => 'b99be148eeee29d770e58bb3c4858adf', // 必填   //xingshuqi19951005xingshuqi199510
//    'mchKey'        => 'xingshuqi19951005xingshuqi199510',  // 必填
//    'mchId'        => '1488522742',  // 必填
//    'token'        => 'xingshuqi19951005xingshuqi199510',  // 必填
//    'encoding_key' => env('WECHAT_ENCODING_KEY', 'YourEncodingAESKey'), // 加密模式需要，其它模式不需要   // EncodingAESKey bETUMbnw92y27orjkzSXGFx2G7W7u6J7r8vvifoS94w
//    'notify_url' => 'http://'.$_SERVER['HTTP_HOST'].'/wap/pay/wnotify', // 支付回调地址
//    'redirect_url' => 'http://'.$_SERVER['HTTP_HOST'].'/wap/login/wxh5pay', // h5支付返回app地址
//];