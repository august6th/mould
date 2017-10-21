<?php

return [
    'custom' => [
        'name' => [
            'required' => '名称不能为空。',
            'max' => '名称不能超过50个字符。'
        ],
        'telephone' => [
            'required' => '联系方式不能为空。',
            'max' => '请填写正确的联系方式。',
            'unique' => '该手机号已经进行签到，无需再签到。'
        ],
        'corporate' => [
            'required' => '名称不能为空。',
            'max' => '公司名称太长啦。'
        ],
        'openid' => [
            'required' => '请先用微信进行登录。',
            'unique' => '该微信账号已经进行签到，无需再签到。'
        ],
    ],
];

