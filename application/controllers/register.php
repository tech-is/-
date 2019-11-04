<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller
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
        if(!empty($code = $this->input->get('code'))) {
            $this->load->model('mdl_shops');
            if($data = $this->mdl_shops->get_tmp_user($code)) {
                $this->load->view('login/view_register', $data);
            } else {
                exit(header('HTTP/1.1 403 Forbidden'));
            }
        } else {
            header('HTTP/1.1 403 Forbidden');
            exit;
        }
    }

    public function register()
    {
        $hash_pass = password_hash($data["password"], PASSWORD_DEFAULT);
        $this->load->model("mdl_shops");
        $data = [
            "shop_name" => $data["name"],
            "shop_kana" => $data["kana"],
            "shop_tel" => $data["tel"],
            "shop_email" => $data["email"],
            "shop_zip_code" => $data["zip_code"],
            "shop_address" => $data["zip_address"],
            "shop_password" => $hash_pass,
        ];
        return $this->mdl_shops->insert_shops($data);
    }
}