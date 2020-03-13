<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form', 'ajax']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(!isset($_SESSION['token'])) {
            $data['token'] = bin2hex(openssl_random_pseudo_bytes(24));
            $_SESSION['token'] = $data['token'];
        } else {
            $data['token'] = $_SESSION['token'];
        }
        if (!empty($_SESSION['shop_id'])) {
            header('location: https://www.animarl.com/home');
        } else {
            $this->load->view('login/view_sign-in', $data);
        }
    }

    public function login()
    {
        judge_httprequest();
        if ($this->form_validation->run('login')) {
            $this->load->model('mdl_login');
            if ($data = $this->mdl_login->get_userdata(['shop_email' => $this->input->post('login-email')])) {
                if (password_verify($this->input->post('login-password'), $data['shop_password'])) {
                    $res_array = json_msg('login', true);
                    $_SESSION = [
                        'shop_id' => $data['shop_id'],
                        'name' => $data['shop_name'],
                        'email' => $data['shop_email'],
                        'token' => bin2hex(openssl_random_pseudo_bytes(24))
                    ];
                } else {
                    $res_array = json_msg('login', false);
                }
            } else {
                $res_array = json_msg('login', false);
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json; charaset=utf-8');
        exit(json_encode($res_array));
    }


    public function logout()
    {
        session_destroy();
        exit(header('location: https://www.animarl.com/login'));
    }

    public function prov_register()
    {
        judge_httprequest();
        if ($this->form_validation->run('prov-register')) {
            $data = [
                'tmp_shop_email' => $this->input->post('prov-email'),
                'tmp_shop_code' => hash('md5', getmypid().microtime()),
                'tmp_expires' => date('Y-m-d H:i:s', time()+3600)
            ];
            $this->load->model('mdl_login');
            if ($this->mdl_login->check_tmp_user($data['tmp_shop_email']) === 0) {
                if ($this->mdl_login->insert_tmp_data($data)) {
                    exit(json_encode(json_msg('prov', $this->send_email($data)?: false)));
                } else {
                    $res_array = json_msg('prov', false);
                }
            } else {
                $res_array = json_msg('prov', false);
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json; charaset=utf-8');
        exit(json_encode($res_array));
    }

    public function send_token_for_reset()
    {
        judge_httprequest();
        if ($this->form_validation->run('forgot-password')) {
            $this->load->model('mdl_login');
            $email = $this->input->post('forgot-email');
            if ($this->mdl_login->check_tmp_user($email) === 1) {
                $data = [
                    'tmp_shop_email' => $email,
                    'tmp_shop_code' => hash('md5', getmypid().microtime()),
                    'tmp_expires' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']+3600)
                ];
                if ($this->mdl_login->insert_tmp_data($data)) {
                    try {
                        $msg = "いつもAnimarlをご利用いただきありがとうございます。\n";
                        $msg .= "パスワードリセット用のURLを添付いたしましたので以下のリンクから変更をお願い致します。\n";
                        $msg .="https://www.animarl.com/login/password_reset_form?code={$data['tmp_shop_code']}\n";
                        $msg .="このメールに覚えのない場合には、お手数ですがメールを破棄してくださいますようお願い致します。\n";
                        $this->load->library('email');
                        $this->email->from('system@animarl.com', 'Animarl_system');
                        $this->email->to($email);
                        $this->email->subject('Animarlログインパスワードリセット');
                        $this->email->message($msg);
                        if (!$this->email->send()) {
                            $this->mdl_login->delete_tmp_shop($email);
                            exit(print_r($this->email->print_debugger()));
                        } else {
                            $res_array = json_msg('send_token', true);
                        }
                    } catch (Exception $e) {
                        $this->mdl_login->delete_tmp_shop($email);
                        $res_array = json_msg('send_token', false);
                    }
                } else {
                    $res_array = json_msg('send_token', false);
                }
            } else {
                $res_array = ['valierr' => ['forgot-email' => 'メールアドレスが登録されていません']];
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json; charaset=utf-8');
        exit(json_encode($res_array));
    }

    public function password_reset_form()
    {
        if (!empty($code = $this->input->get('code'))) {
            $this->load->model('mdl_shops');
            if ($data = $this->mdl_shops->get_tmp_email($code)) {
                $data['code'] = $code;
                $data['token'] = bin2hex(openssl_random_pseudo_bytes(24));
                $_SESSION['token'] = $data['token'];
                $this->load->view('login/view_reset_password', $data);
            } else {
                exit(header('HTTP/1.1 403 Forbidden'));
            }
        } else {
            exit(header('HTTP/1.1 403 Forbidden'));
        }
    }

    public function password_reset()
    {
        judge_httprequest();
        if ($this->form_validation->run('reset-password')) {
            $this->load->model('mdl_login');
            if ($email = $this->mdl_login->get_tmp_email($this->input->post('reset-token'))) {
                $data = [
                    'where' => $email['tmp_shop_email'],
                    'set' => ['shop_password' => password_hash($this->input->post('reset-password'), PASSWORD_DEFAULT)]
                ];
                $res_array = json_msg('reset_password', $this->mdl_login->update_password($data));
            } else {
                $res_array = json_msg('reset_password', false);
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json; charaset=utf-8');
        exit(json_encode($res_array));
    }

    private function send_email($data)
    {
        $msg = "このメールは配信専用のアドレスで配信されています。\n";
        $msg .= "このメールに返信されても、返信内容の確認及びご返答ができませんので、あらかじめご了承ください。\n";
        $msg .= "この度はAnimarl仮登録頂きありがとうございます。\n";
        $msg .= "本登録を開始するには、次のリンクをクリックしてください。\n";
        $msg .= "https://www.animarl.com/register?code={$data['tmp_shop_code']}\n";
        $msg .= "このメールに覚えのない場合には、お手数ですがメールを破棄してくださいますようお願い致します。\n";
        $this->load->library('email');
        $this->email->from('system@animarl.com', 'Animarl_system');
        $this->email->to($data['tmp_shop_email']);
        $this->email->subject('仮登録完了のお知らせ');
        $this->email->message($msg);
        if (!$this->email->send()) {
            // print_r($this->email->print_debugger());
            // exit;
            $this->mdl_login->delete_tmp_shop($email);
            return false;
        } else {
            return true;
        }
    }
}
