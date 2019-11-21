<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * タイトル：顧客詳細・IDで管理
 * 説明    ：顧客・IDで詳細管理
 *
 * 著作権  ：Copyright(c) 2019 TECH I.S
 * 会社名  ：TECH I.S
 *
 * 変更履歴：2019.8 開発
 */

class Cl_karute extends CI_Controller
{
    //コンストラクタ
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        $this->load->model('Mdl_total_list');
        $this->load->model('Mdl_karute');
        session_start();
        $_SESSION["shop_id"] = 1;
    }

    //TOPページ
    public function index()
    {
        if(!empty($customer_id = $this->input->post("customer_id"))){
            $data["karute"] = $this->Mdl_karute->m_karute_get($_SESSION["shop_id"], $customer_id);
            // var_dump($data["karute"]);exit;
            // 以下カルテにインサート
            $this->Mdl_karute->sub_insert_karute($_SESSION["shop_id"],$data["karute"]["customer_id"]);
            // print_r($data);
            // exit;
            $this->karute_result($data);
            //     if(!empty($data["r_karute"] = $this->Mdl_karute->m_rireki_karute_total_list($_SESSION["shop_id"], $data["karute"]["karute_customer_id"]))){
            //         $this->rireki_karute($data);
            // }else{
            //     redirect('/cl_karute/');
            // }
        }else{
            $data["list"] = $this->get_total_list();
            $data["groups"] = $this->get_kind_group();
            $this->load->view('cms/pages/parts/header');
            $this->load->view('cms/pages/parts/sidebar');
            $this->load->view('cms/vi_karute', $data);
            // $this->load->view('cms/vi_karute');
        }
    }

    //検索結果をページ遷移
    public function karute_result($data)
    {
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/vi_karute_result', $data);
        // print_r ($data["karute"]);
        // exit;
    }
    //カルテページ遷移
    public function rireki_karute($data)
    {
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/vi_karute_result', $data);
        // print_r ($data["karute"]);
        // exit;
    }

    //karuteでトータルリストから一覧取得 indexへ表示
    private function get_total_list()
    {
        $shop_id = $_SESSION["shop_id"];
        return $this->Mdl_total_list->m_get_total_list($shop_id);
    }

    //karuteでトータルリストからグループ検索 indexへ表示
    private function get_kind_group()
    {
        $id = $_SESSION["shop_id"];
        return $this->Mdl_total_list->m_get_kind_group($id);
    }

    //更新時、全件取得
    // public function get_total_all_data()
    // {
    //     $pet_id = $this->input->post("id");
    //     $this->load->model("Mdl_total_list");
    //     return  $this->Mdl_total_list->m_get_total_all($pet_id);

    // }

    //カルテの登録
    public function karute_data()
    {
        // $data['debug'] = var_export($_POST, true);
        //顧客の登録
        // exit;
            $this->load->model("Mdl_karute");
            if($this->Mdl_karute->m_insert_karute() === true){
                echo "success";
                exit;
            } else {
                echo "dberror";
                exit;
            }
    }

    //入力チェック
    // private function total_validation()
    // {
    //     $config = [
    //         [
    //             'field' => 'customer_name',
    //             'label' => '名前',
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => '名前を入力してください'
    //             ]
    //         ],
    //         [
    //             'field' => 'customer_kana',
    //             'label' => 'カナ',
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'カナを入力してください'
    //             ]
    //     ];
    //     $this->load->library('form_validation', $config);
    //     // $this->form_validation->set_rules($config);
    //     return $this->form_validation->run();
    // }

    //ペットファイルの画像アップ
    // private function img_upload()
    // {
    //     $filename = time();
        // $config['upload_path'] = './upload/tmp';//リサイズ前
        // $config['allowed_types'] = 'gif|jpg|png';
        // $config['file_name'] = $filename;
        // $config['max_size']	= '3072';
        // $config['max_width']  = '';
        // $config['max_height']  = '';
    //     $config = [
    //         'upload_path' => './upload/tmp',
    //         'allowed_types' => 'gif|jpg|png',
    //         'file_name' => $filename,
    //         'max_size'	=> '3072',
    //         'max_width'  => '',
    //         'max_height'  => ''
    //     ];
    //     $this->load->library('upload', $config);
    //     $result = $this->upload->do_upload('pet_img');
    //     if ($result) {
    //         $resize_path = './upload/img/thumbs';//リサイズ後
    //         $image_data = $this->upload->data();
    //         $config['source_image'] = $image_data["full_path"];
    //         $config['maintain_ration'] = true;
    //         $config['new_image'] = $resize_path; //サムネイル保存フォルダ
    //         $config['width'] = 640;
    //         $config['height'] = 360;
    //         $this->load->library("image_lib", $config);
    //         if($this->image_lib->resize(gi) === true) {
    //             // $fullpath = realpath($resize_path);
    //       return base_url().'upload/img/thumbs/'.$image_data['file_name']; //本番環境では "\" を　"/" に変更
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }
}