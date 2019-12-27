<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config = [
    'prov-register' => [
        [
            'field' => 'prov-email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email|trim',
            'errors' => [
                'required' => '%sを入力してください',
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
                'required' => '%sを入力してください',
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
    'reset-password' => [
        [
            'field' => 'reset-password',
            'label' => 'パスワード',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'confirm-password',
            'label' => 'パスワード再確認',
            'rules' => 'required|matches[reset-password]|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'matches' => 'もう一度同じパスワードを入力してください'
            ]
        ]
    ],
    'register' => [
        [
            'field' => 'shop_name[0]',
            'label' => 'ユーザ名',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'shop_name[1]',
            'label' => 'ユーザ名',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'shop_kana[0]',
            'label' => 'フリガナ',
            'rules' => 'required|regex_match[/^[ァ-ヾ ]+$/u]|trim',
            'errors' => [
                'required' => '%sを入力してください',
                "regex_match" => "全角カタカナで入力してください。"
            ]
        ],
        [
            'field' => 'shop_kana[1]',
            'label' => 'フリガナ',
            'rules' => 'required|regex_match[/^[ァ-ヾ ]+$/u]|trim',
            'errors' => [
                'required' => '%sを入力してください',
                "regex_match" => "全角カタカナで入力してください。"
            ]
        ],
        [
            'field' => 'shop_email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ],
        [
            'field' => 'shop_tel',
            'label' => '電話番号',
            'rules' => 'required|numeric|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'numeric' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'shop_zip_code',
            'label' => '郵便番号',
            'rules' => 'required|numeric|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'numeric' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'shop_zip_address[0]',
            'label' => '住所',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'shop_zip_address[1]',
            'label' => '住所',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'shop_zip_address[2]',
            'label' => '住所',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'shop_password',
            'label' => 'パスワード',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'shop_confirm_pass',
            'label' => 'パスワード再確認',
            'rules' => 'required|matches[shop_password]|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'matches'=> 'もう一度同じパスワードを入力してください'
            ]
        ]
    ],
    'karte' => [
        [
            'field' => 'karute_title',
            'label' => 'カルテタイトル',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'karute_comment',
            'label' => 'カルテコメント',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ]
    ],
    'reserve' => [
        [
            'field' => 'reserve_customer',
            'label' => '顧客名',
            'rules' => 'required|trim',
            'errors' => [
                'required' => 'テーブルから顧客とペットを選択してください'
            ]
        ],
        [
            'field' => 'reserve_pet',
            'label' => 'ペット名',
            'rules' => 'required|trim',
            'errors' => [
                'required' => 'テーブルから顧客とペットを選択してください'
            ]
        ],
        [
            'field' => 'reserve_start',
            'label' => '来店予定日',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'reserve_time',
            'label' => '終了予定日',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'reserve_end',
            'label' => '終了予定日',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => '_reserve_time',
            'label' => '終了予定日',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'reserve_color',
            'label' => 'ラベルカラー',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'reserve_content',
            'label' => '備考',
            'rules' => 'trim'
        ]
    ],
    'total' => [
        [
            'field' => 'customer_name',
            'label' => '名前',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'customer_kana',
            'label' => 'カナ',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'customer_mail',
            'label' => 'メール',
            'rules' => 'required',
            'errors' => [
                'required' => '%sを入力して下さい'
            ]
        ],
        [
            'field' => 'customer_tel',
            'label' => '電話番号',
            'rules' => 'required|numeric|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'numeric' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'customer_zip_adress',
            'label' => '郵便番号',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'customer_address',
            'label' => '住所',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'customer_add_info',
            'label' => '追加情報',
            'rules' => 'trim',
        ],
        [
            'field' => 'pet_name',
            'label' => '名前',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'pet_classification',
            'label' => '分類',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'pet_type',
            'label' => '種類',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'pet_birthday',
            'label' => '生年月日',
            'rules' => 'trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'pet_contraception',
            'label' => '避妊',
            'rules' => 'trim',
        ],
        [
            'field' => 'pet_body_height',
            'label' => '体高',
            'rules' => 'numeric|trim',
            'errors' => [
                'numeric' => '半角数字で入力してください'
            ]
        ],
        [
            'field' => 'pet_body_weight',
            'label' => '体重',
            'rules' => 'numeric|trim',
            'errors' => [
                'numeric' => '半角数字で入力してください'
            ]
        ],
        [
            'field' => 'pet_information',
            'label' => '備考',
            'rules' => 'trim',
        ]
    ],
    'group' => [
        [
            'field' => 'staff',
            'label' => 'スタッフ',
            'rules' => 'required|greater_than[0]|trim',
            'errors' => [
                'required' => '%sを選択してください',
                'greater_than' => '%sを選択してください'
            ]
        ]
    ],
    'shift' => [
        [
            'field' => 'staff',
            'label' => 'スタッフ',
            'rules' => 'required|greater_than[0]|trim',
            'errors' => [
                'required' => '%sを選択してください',
                'greater_than' => '%sを選択してください'
            ]
        ],
        [
            'field' => 'shift_start',
            'label' => '開始日時',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'shift_end',
            'label' => '終了日時',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'shift_time',
            'label' => '開始時間',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => '_shift_time',
            'label' => '終了日時',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
    ],
    'staff' => [
        [
            'field' => 'staffFamilyName',
            'label' => '名前',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'staffFirstName',
            'label' => '名前',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'staff_tel',
            'label' => '電話番号',
            'rules' => 'required|numeric|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'numeric' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'staff_email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ],
        [
            'field' => 'staff_color',
            'label' => 'カラーラベル',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください'
            ]
        ],
        [
            'field' => 'staff_remarks',
            'label' => '備考',
            'rules' => 'trim'
        ]
    ]
];
