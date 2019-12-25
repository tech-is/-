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
            $data = [
                'shop_name' => $this->input->post('shop_name[0]').' '.$this->input->post('shop_name[1]'),
                'shop_kana' => $this->input->post('shop_kana[0]').' '.$this->input->post('shop_kana[1]'),
                'shop_tel' => $this->input->post('shop_tel'),
                'shop_email' => $this->input->post('shop_email'),
                'shop_zip_code' => $this->input->post('shop_zip_code'),
                'shop_address' =>  $this->input->post('shop_address[0]').$this->input->post('shop_address[1]').$this->input->post('shop_address[2]'),
                'shop_password' => password_hash($this->input->post('shop_password'), PASSWORD_DEFAULT)
            ];
            $this->load->model("mdl_shops");
            $res_array = json_msg('register', $this->mdl_shops->insert_shops($data));
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json; charaset=utf-8');
        exit(json_encode($res_array));
    }
}
