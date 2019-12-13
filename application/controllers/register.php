<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form', 'ajax']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (!empty($code = $this->input->get('code'))) {
            $this->load->model('mdl_shops');
            if ($data = $this->mdl_shops->get_tmp_email($code)) {
                $data['token'] = bin2hex(openssl_random_pseudo_bytes(24));
                $_SESSION['token'] = $data['token'];
                $this->load->view('login/view_register', $data);
            } else {
                exit(header('HTTP/1.1 403 Forbidden'));
            }
        } else {
            exit(header('HTTP/1.1 403 Forbidden'));
        }
    }

    public function register()
    {
        judge_httprequest();
        if ($this->form_validation->run('register')) {
            $key_array = ['shop_name', 'shop_kana', 'shop_tel', 'shop_email', 'shop_zip_code', 'shop_address', 'shop_password'];
            foreach ($key_array as $key) {
                $data[$key] = $key === 'shop_password'? password_hash($this->input->post($key), PASSWORD_DEFAULT): $this->input->post($key);
            }
            $this->load->model("mdl_shops");
            $res_array = json_msg('register', $this->mdl_shops->insert_shops($data));
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json');
        exit(json_encode($res_array));
    }
}
