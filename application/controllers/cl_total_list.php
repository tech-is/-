<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_total_list extends CI_Controller {

    /**
     * Undocumented function
     *
     * @return 
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        $this->load->model('Mdl_total_list');
        // $this->load->driver('session');
        session_start();
        // $_SESSION["shops_id"] = 1;
        //GET.POST.インサート分の中身を確認。コンストラクタ内で利用するie
        // $this->output->enable_profiler();
    }

    public function index()
    {       
        $data["list"] = $this->get_total_list();
        //print_r($data);
        
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/vi_total_list', $data);
    }
    //pet登録
    public function pet_info_validation()
    {
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
        $this->load->model('mdl_pet_info');
        // $p_data['pet_contraception'] ="";
        // $p_data['pet_type'] ="";
        $config = [
            [
                'field' => 'pet_name',
                'label' => '名前',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '名前を入力してください'
                ]
            ],
            [
                'field' => 'pet_classification',
                'label' => '分類',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '入力してください'
                ]
                ],
            [
                'field' => 'pet_type',
                'label' => '種類',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '入力してください'
                ]
                ],
            [
                'field' => 'pet_animal_gender',
                'label' => '性別',
                'rules' => '',
                'errors' => [
                    'required' => '選択してください'
                ]
                ],
            [
                'field' => 'pet_birthday',
                'label' => '生年月日',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '入力してください'
                ]
            ],
            [
                'field' => 'pet_contraception',
                'label' => '避妊',
                'rules' => ''
            ],
            [
                'field' => 'pet_body_height',
                'label' => '体高',
                'rules' => 'trim',
                'errors' => [
                    'required' => '入力してください'
                ]
            ],
            [
                'field' => 'pet_body_weight',
                'label' => '体重',
                'rules' => 'trim',
                'errors' => [
                    'required' => '入力してください'
                ]
            ],
            [
                'field' => 'pet_information',
                'label' => '備考',
                'rules' => 'trim',
            ]
        ];
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == true){
            $p_data = $this->input->post();
                    //避妊をintへ
            // if(isset($p_data['pet_contraception'])){
            //     if($p_data['pet_contraception'] == 'on') {
            //         $p_data['pet_contraception'] = 1;
            //     } else {
            //         $p_data['pet_contraception'] = 2;
            //     }
            // }
            return $p_data;
            exit;
        // } else {
        //     echo "ペットデータが不正です";
        //     exit;
        }    
    }

    private function check_customer_data()
    {
        $config = [
            [
                'field' => 'customer_name',
                'label' => '名前',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => '名前を入力してください'
                )
            ],
            array(
                'field' => 'customer_kana',
                'label' => 'カナ',
                'rules' => 'required|trim',
                'errors' => array(
                'required' => 'カナを入力してください'
                                                    )
                ),
            array(
                'field' => 'customer_mail',
                'label' => 'メール',
                'rules' => 'required',
                'errors' => array(
                'required' => 'メールを入力して下さい'
                                                        )
                ),
            array(
                'field' => 'customer_tel',
                'label' => '電話',
                'rules' => 'required|trim',
                'errors' => array(
                'required' => '番号を入力してください'
                                                        )
                ),
            array(
                'field' => 'customer_zip_adress',
                'label' => '郵便番号',
                'rules' => 'required|trim',
                'errors' => array(
                'required' => '郵便番号を入力してください'
                                                        )
                ),
            array(
                'field' => 'customer_address',
                'label' => '住所',
                'rules' => 'required|trim',
                'errors' => array(
                'required' => '住所を入力してください'
                                                        )
                ),
            array(
                'field' => 'customer_magazine',
                'label' => 'マガジン発行',
                ),
            array(
                'field' => 'customer_add_info',
                'label' => '追加情報',
                'rules' => 'required|trim',
                ),
            array(
                'field' => 'customer_group',
                'label' => 'ランク',
                'rules' => 'required|trim',
                )
        ];
        $this->load->library('form_validation');
        $this->form_validation->set_rules($config);
        return $this->form_validation->run();
    }
    // customerデータに入れていないキーの処理
    public function c_check()
    {
        // $c_test['customer_magazine'] ="";
        if ($this->check_customer_data() == true) {
            $c_test = $this->input->post(NULL,true);
            //メールマガジンをintへ
            if(empty($this->input->post("customer_magazine"))) {
                $c_test['customer_magazine'] = 1;
            } else {
                $c_test['customer_magazine'] = 0;
            }
            //グループをintへ
            if($c_test['customer_group'] == 'gold') {
                $c_test['customer_group'] = 0;
            } elseif ($c_test['customer_group'] == 'silver') {
                $c_test['customer_group'] = 1;
            } elseif($c_test['customer_group'] == 'bronze'){
                $c_test['customer_group'] = 2;
            } else{
                $c_test['customer_group'] = 3;
            }
            $c_test["customer_shop_id"] = $_SESSION["shop_id"];
            return $c_test;
        } else {
            return false;
        }
    }

    //新規登録
    public function insert_customer()
    {
      
    }
    
    //一覧を表示させる
    private function get_total_list()
    {
        $_SESSION["shop_id"] = 1;
        $shop_id = $_SESSION["shop_id"];
        return $this->Mdl_total_list->m_get_total_list($shop_id);
    }
    //ペットと顧客の登録
    public function insert_total_data(){
        $data['debug'] = var_export($_POST, true);
        echo "a";
        //顧客の登録
        if(isset($_POST['customer_name']) == true) {
            echo "i";
            if($this->c_check() == true) {
                echo "u";
                $customer_data = $this->c_check();
            }
            if(isset($_POST['pet_name']) == true) {
                echo "e";
                $pet_data = $this->pet_info_validation();
                $pet_data["pet_customer_id"] = $c_test["customer_shop_id"];
                $this->load->model("Mdl_total_list");
            }
            if($this->Mdl_total_list->m_insert_total_list($pet_data, $customer_data) == true) {
                echo "成功!";
                exit;
            } else {
                echo "fail..";
                exit;
            } 
        }


    }
}
