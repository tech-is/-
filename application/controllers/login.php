<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
        session_start();
        // $_SESSION['shop_id'] = 1;
    }

    public function index()
    {
        $data['token'] = bin2hex(openssl_random_pseudo_bytes(24));
        $_SESSION['token'] = $data['token'];
        if(isset($_SESSION['shop_id'])) {
            header('location: //animarl.com/cl_main');
        } else {
            $this->load->view('login/view_sign-in', $data);
        };
    }

    public function login()
    {
        $this->judge_request_param();
        if($this->form_validation->run('login')) {
            $this->load->model('mdl_login');
            $data = $this->mdl_login->get_userdata(['shop_email' => $this->input->post('login-email')]);
            if($data !== false) {
                if(password_verify($this->input->post('login-password'), $data['shop_password'])) {
                    $res_array = ['success' => 'success_login'];
                    $_SESSION['shop_id'] = $data['shop_id'];
                } else {
                    $res_array = ['error' => 'failed_login'];
                }
            } else {
                $res_array = ['error' => 'failed_login'];
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json');
        exit(json_encode($res_array));
    }

    public function prov_register()
    {
        $this->judge_request_param();
        if($this->form_validation->run('prov-register')) {
            $data = [
                'tmp_shop_email' => $this->input->post("prov-email"),
                'tmp_shop_code' => hash('md5', getmypid().microtime())
            ];
            $this->load->model('mdl_login');
            if($this->mdl_login->insert_tmp_data($data)) {
                $res_array = $this->send_email($data)? ['success' => "仮登録が完了しました！"]: ['error' => 'failed_login'];
            } else {
                $res_array = ['error' => 'failed_login'];
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json');
        exit(json_encode($res_array));
    }

    public function forgot_password()
    {
        $this->judge_request_param();
        if($this->login_validation('forgot-password')) {
            $this->load->model('mdl_login');
            $data = $this->mdl_login->get_userdata(['shop_email' => $this->input->post('login-email')]);
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        exit(json_encode($res_array));
    }

    public function password_reset()
    {
        // if(!empty($code = $this->input->get('code'))) {
            // $this->load->model('mdl_shops');
            $this->load->view('login/view_reset_password');
        // } else {
        //     header('HTTP/1.1 403 Forbidden');
        //     exit;
        // }
    }

    /**
     * リクエストの正当性をチェック
     *
     * @param [str] $_SERVER['HTTP_X_CSRF_TOKEN'] && $_SESSION['token']
     */
    private function judge_request_param()
    {
        if(empty($_SERVER['HTTP_X_CSRF_TOKEN']) || $_SERVER['HTTP_X_CSRF_TOKEN'] !== $_SESSION['token']) {
            header('HTTP/1.1 403 Forbidden');
            exit('不正な接続です');
        }
    }

    private function send_email($data)
    {
        $message = <<< EOM
            このメールは配信専用のアドレスで配信されています。\n
            このメールに返信されても、返信内容の確認及びご返答ができませんので、あらかじめご了承ください。\n
            \n
            この度はAnimarl仮登録頂きありがとうございます。\n
            本登録を開始するには、次のリンクをクリックしてください。\n
            http://animarl.com/register?code={$data['tmp_shop_code']}\n
            このメールに覚えのない場合には、お手数ですがメールを破棄してくださいますようお願い致します。\n
        EOM;
        $this->load->library("email");
        $this->email->from("system_animarl@niji-desk.work", "Animarlシステムメール");
        $this->email->to($data['tmp_shop_email']);
        $this->email->set_newline("\r\n");
        $this->email->subject("会員本登録メール");
        $this->email->message($message);
        return $this->email->send();
    }

    public function send_token()
    {
        $email = $this->input->post('email');
        if($this->chk_login_data() == true) {
            try {
                $this->load->library('email');
                $this->email->from('example@example.com', 'Animarlシステムメール');
                $this->email->to($email);
                $this->email->subject('Animarlログインパスワードリセット');
                $msg = <<< EOM
                いつもAnimarlをご利用いただきありがとうございます。\n
                パスワードリセット用のURLを添付いたしましたので以下のリンクから変更をお願い致します。\n
                http://animarl.com/cl_login/password_reset?=
                このメールに心当たりがない場合、他のお客様がパスワードをリセットする際に誤って\n
                お客様のメールアドレスを入力した可能性がありますので、\n
                お手数ですがメールを破棄してくださいますようお願い致します。\n';
                EOM;
                $this->email->message($msg);
            } catch(extension $e) {
                echo 'メールの送信に失敗しました';
            }
        } else {
            return false;
        }
    }

}