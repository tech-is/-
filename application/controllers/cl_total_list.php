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
        $_SESSION["shop_id"] = 1;
        //GET.POST.インサート分の中身を確認。コンストラクタ内で利用するie
        // $this->output->enable_profiler();
    }

    public function index()
    {
        $data["list"] = $this->get_total_list();
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/vi_total_list', $data);
    }

    //一覧を表示させる
    private function get_total_list()
    {
        $_SESSION["shop_id"] = 1;
        $shop_id = $_SESSION["shop_id"];
        return $this->Mdl_total_list->m_get_total_list($shop_id);
    }

    //ペットと顧客の登録
    public function insert_total_data()
    {
        // $data['debug'] = var_export($_POST, true);
        //顧客の登録
        if($this->total_validation() == true) {
            $post = $this->input->post(null, true);
            foreach($post as $key => $val) {
                if(strpos($key,'customer_') !== false) {
                    $customer_data[$key] = $val;
                    $customer_data["customer_shop_id"] = $_SESSION["shop_id"];
                } else {
                    $pet_data[$key] = $val;
                }
            }
            // $this->load->model("Mdl_total_list");
            if($this->Mdl_total_list->m_insert_total_list($customer_data, $pet_data) == true) {
                echo "成功!";
                exit;
            } else {
                echo "fail..";
                exit;
            }
        } else {
            echo "vali_erro";
            exit;
        }
    }
            
        
    private function total_validation()
    {
        $config = [
            [
                'field' => 'customer_name',
                'label' => '名前',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '名前を入力してください'
                ]
            ],
            [
                'field' => 'customer_kana',
                'label' => 'カナ',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'カナを入力してください'
                ]
            ],
            [
                'field' => 'customer_mail',
                'label' => 'メール',
                'rules' => 'required',
                'errors' => [
                    'required' => 'メールを入力して下さい'
                ]
            ],
            [
                'field' => 'customer_tel',
                'label' => '電話',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '番号を入力してください'
                ]
            ],
            [
                'field' => 'customer_zip_adress',
                'label' => '郵便番号',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '郵便番号を入力してください'
                ]
            ],
            [
                'field' => 'customer_address',
                'label' => '住所',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '住所を入力してください'
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
                'rules' => 'required',
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
                'rules' => 'trim'
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
        $this->load->library('form_validation', $config);
        // $this->form_validation->set_rules($config);
        return $this->form_validation->run();
    }
}