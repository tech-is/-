<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('judge_request')) {
    /**
     * httpリクエストの正当性をチェック
     *
     */
    function judge_httprequest()
    {
        if (empty($_SERVER['HTTP_X_CSRF_TOKEN']) || $_SERVER['HTTP_X_CSRF_TOKEN'] !== $_SESSION['token']) {
            exit(header('HTTP/1.1 403 Forbidden'));
        }
    }
}

if (! function_exists('json_msg')) {
    /**
     * httpリクエストごとにjsonを出力
     *
     * @param	bool
     * @param	string
     * @return	array
     */
    function json_msg(string $item, bool $type, int $index = null)
    {
        $msg = [
            'login' => [
                true => [
                    'success' => [
                        'title' => 'ログインに成功しました',
                        'msg' => ''
                    ]
                ],
                false => [
                    'error' => [
                        'title' => 'ログインに失敗しました...',
                        'msg' => 'メールかパスワードが間違っています'
                    ]
                ]
            ],
            'register' => [
                true => [
                    'success' => [
                        'title' => '登録が完了しました！',
                        'msg' => ''
                    ]
                ],
                false => [
                    'error' => [
                        'title' => '登録に失敗しました...',
                        'msg' => "登録時間の有効期限が切れました。\nまたメールアドレスを送信してください"
                    ]
                ]
            ],
            'send_token' => [
                true => [
                    'success' => [
                        'title' => 'パスワードリセットメールを送信しました！',
                        'msg' => 'メールを送信しましたのでご確認ください'
                    ]
                ],
                false => [
                    'error' => [
                        'title' => 'メールの送信に失敗しました...',
                        'msg' => "既にメールを送信している可能性があります。\nメールが届いていない場合はしばらく待ってから\n再申請してください"
                    ]
                ]
            ],
            'prov' => [
                true => [
                    'success' => [
                        'title' => '仮登録が完了しました！',
                        'msg' => 'メールを送信しましたのでご確認ください'
                    ]
                ],
                false => [
                    'error' => [
                        'title' => '仮登録に失敗しました...',
                        'msg' => 'メールアドレスが既に登録されている可能性があります'
                    ]
                ]
            ],
            'password_reset' => [
                false => [
                    [
                        'error' => [
                            'title' => 'パスワードリセットに失敗しました...',
                            'msg' => "再発行の有効期限が切れました。\nまたメールアドレスを送信してください"
                        ]
                    ],
                    [
                        'error' => [
                            'title' => 'パスワードリセットに失敗しました...',
                            'msg' => "再発行の有効期限が切れました。\nまたメールアドレスを送信してください"
                        ]
                    ]
                ]
            ],
            'total' =>[
                true => [
                    [
                        'success' => [
                            'title' => '登録に成功しました！',
                            'msg' => ''
                        ]
                    ],
                    [
                        'success' => [
                            'title' => '更新に成功しました！',
                            'msg' => ''
                        ]
                    ],
                    [
                        'success' => [
                            'title' => '削除に成功しました！',
                            'msg' => ''
                        ]
                    ]
                ],
                false => [
                    [
                        'error' => [
                            'title' => '登録に失敗しました...',
                            'msg' => ''
                        ]
                    ],
                    [
                        'error' => [
                            'title' => '更新に失敗しました...',
                            'msg' => ''
                        ]
                    ],
                    [
                        'error' => [
                            'title' => '削除に失敗しました...',
                            'msg' => ''
                        ]
                    ]
                ]
            ],
            'staff' => [
                true => [
                    'success' => [
                        [
                            'title' => '登録に成功しました！',
                            'msg' => ''
                        ],
                        [
                            'title' => '更新に成功しました！',
                            'msg' => ''
                        ],
                        [
                            'title' => '削除に成功しました！',
                            'msg' => ''
                        ]
                    ]
                ],
                false => [
                    [
                        'title' => '登録に失敗しました...',
                        'msg' => ''
                    ],
                    [
                        'title' => '更新に失敗しました...',
                        'msg' => ''
                    ],
                    [
                        'title' => '削除に失敗しました...',
                        'msg' => ''
                    ]
                ]
            ],
            'shift' => [
                true => [
                    [
                        'title' => '登録に成功しました！',
                        'msg' => ''
                    ],
                    [
                        'title' => '更新に成功しました！',
                        'msg' => ''
                    ],
                    [
                        'title' => '削除に成功しました！',
                        'msg' => ''
                    ]
                ],
                false => [
                    [
                        'title' => '登録に失敗しました...',
                        'msg' => ''
                    ],
                    [
                        'title' => '更新に失敗しました...',
                        'msg' => 'シフトidが送信されていません'
                    ],
                    [
                        'title' => '削除に失敗しました...',
                        'msg' => ''
                    ]
                ]
            ]
        ];
        return $index? $msg[$item][$type][$index] : $msg[$item][$type];
    }
}
