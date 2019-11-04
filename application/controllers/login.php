<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        session_start();
        // $_SESSION['shop_id'] = 1;
    }

    public function index()
    {
        $data['token'] = bin2hex(openssl_random_pseudo_bytes(24));
        $_SESSION['token'] = $data['token'];
        if(isset($_SESSION['shop_id'])){ 
            session_regenerate_id();
            header('location: //animarl.com/cl_main');
        } else {
            $this->load->view('login/view_sign-in', $data); 
        };
    }

    public function login_judgement()
    {
        $this->judge_request_param();
        if($this->judge_validation('login')) {
            $this->load->model('mdl_login');
            $data = $this->mdl_login->select_login_data(['shop_email' => $this->input->post('email')]);
            if(!empty($data) && count($data) === 1) {
                if(password_verify($this->input->post('password'), $data['shop_password'])) {
                    $_SESSION['shop_id'] = $data['shop_id'];
                    $res_array = ['success' => 'login_success'];
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
        if($this->judge_validation('prov-register')) {
            // $email = $this->input->post("prov-email");
            // $code = hash('md5', $email.microtime());
            // $code = hash('sha256', $email);
            $data = [
                'tmp_shop_email' => $this->input->post("prov-email"),
                'tmp_shop_code' => hash('md5', $email.microtime())
            ];
            $this->load->model('mdl_login');
            if($this->mdl_login->insert_tmp_data($data)) {
                if($this->send_mail($email, $code)) {
                    $res_array = ['error' => 'failed_login'];
                }
            }
            // $res_array = ['code' => $code];
            //         echo "仮登録が完了しました！メールを送信しましたのでご確認ください。";
            //     } else {
            //         $res_array = ['error' => 'failed_login'];
            //     }
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
            $data = $this->mdl_login->select_login_data(['shop_email' => $this->input->post('login-email')]);
            if(!empty($data) && count($data) === 1) {
            // 
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        exit(json_encode($res_array));
    }

    public function register()
    {
        if(!empty($code = $this->input->get('code'))) {
            $this->load->model('mdl_shops');
            count($this->mdl_shops->select_code($code)) === 1?$this->load->view('login/view_register', $data): header('HTTP/1.1 403 Forbidden');
        } else {
            header('HTTP/1.1 403 Forbidden');
            exit;
        }
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

    private function judge_validation($set)
    {
        $this->load->library('form_validation');
        return $this->form_validation->run($set);
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

    private function send_mail($email, $code)
    {
        $message = <<< EOM
            "このメールは配信専用のアドレスで配信されています。\n
            このメールに返信されても、返信内容の確認及び
            ご返答ができません。\n
            あらかじめご了承ください。\n
            電子メールアドレスのご登録ありがとうございます。\n
            電子メールアドレスを確認するには、次のリンクをクリックしてください。\n
            http://localhost/cl_login/register?code={$code}\n
            このメールに覚えのない場合には、お手数ですがメールを破棄してくださいますようお願い致します。\n
        EOM;
        $this->load->library("email");
        $this->email->from("system_animarl@niji-desk.work", "Animarlシステムメール");
        $this->email->to($email);
        $this->email->set_newline("\r\n");
        $this->email->subject("会員本登録メール");
        $this->email->message($message);
        return $this->email->send();
    }

}