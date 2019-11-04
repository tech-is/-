<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = [
    'prov-register' => [
        [
            'field' => 'prov-email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email|trim',
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
            'rules' => 'required|valid_email|trim',
            'errors' => [
                'required' => '%s を入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ],
        [
            'field' => 'login-password',
            'label' => 'パスワード',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください',
            ]
        ],
    ],
    'forgot-password' => [
        [
            'field' => 'forgot-email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ]
    ],
    'regiser' => [
        [
            'field' => 'name',
            'label' => 'ユーザ名',
            'rules' => 'required'
        ],
        [
            'field' => 'kana',
            'label' => 'フリガナ',
            'rules' => 'required|regex_match[/^[ァ-ヾ]+$/u]|trim',
            'error' => [
                'required' => '%sを入力してください',
                'regex_match' => '全角カタカナで入力してください。'
            ]
        ],
        [
            'field' => 'email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ],
        [
            'field' => 'tel',
            'label' => '電話番号',
            'rules' => 'required'
        ],
        [
            'field' => 'zip_code',
            'label' => '郵便番号',
            'rules' => 'required'
        ],
        [
            'field' => 'zip_address',
            'label' => '住所',
            'rules' => 'required'
        ],
        [
            'field' => 'password',
            'label' => 'パスワード',
            'rules' => 'required'
        ]
    ]
];