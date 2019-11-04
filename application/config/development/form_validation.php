<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = [
    'prov-register' => [
        [
            'field' => 'prov-email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => '%s を入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ],
    ],
    'login' => [
        [
            'field' => 'login-email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => '%s を入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ],
        [
            'field' => 'login-password',
            'label' => 'パスワード',
            'rules' => 'required',
            'errors' => [
                'required' => '%sを入力してください',
            ]
        ],
    ],
    'forgot-password' => [
        [
            'field' => 'forgot-email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => '%sを入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ]
    ]
];