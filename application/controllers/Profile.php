<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form', 'ajax']);
        isset($_SESSION['shop_id'])?: header('location: //animarl.com/login');
        $this->load->model('mdl_Profile');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['Profile'] = $this->mdl_Profile->m_Profile_get($_SESSION['shop_id']);
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/profile/view_profile', $data);
    }

    public function update_profile()
    {
        judge_httprequest();
        if ($this->form_validation->run('register')) {
            $key_array = ['shop_name', 'shop_kana', 'shop_tel', 'shop_email', 'shop_zip_code', 'shop_address', 'shop_password'];
            foreach ($key_array as $key) {
                $data['update'][$key] = $key === 'shop_password'? password_hash($this->input->post($key), PASSWORD_DEFAULT): $this->input->post($key);
            }
            $data['where'] = ['shop_id' => $_SESSION['shop_id']];
            if ($this->mdl_Profile->update_shops($data)) {
                $res_array = ['success' => '登録が完了しました！'];
                $_SESSION['name'] = $data['update']['shop_name'];
                $_SESSION['email'] = $data['update']['shop_email'];
            } else {
                $res_array = ['error' => 'メールアドレスが既に登録されている可能性があります'];
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json');
        exit(json_encode($res_array));
    }
}
