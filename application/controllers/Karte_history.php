<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * タイトル：顧客詳細・IDで管理
 * 説明    ：顧客・IDで詳細管理
 *
 * 著作権  ：Copyright(c) 2019 TECH I.S
 * 会社名  ：TECH I.S
 *
 * 変更履歴：2019.8 開発
 */

class Karte_history extends CI_Controller
{
    //コンストラクタ
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        $this->load->model('Mdl_karute');
        session_start();
        $_SESSION["shop_id"] = 1;
    }

    //TOPページ
    public function index()
    {   //上新規入力画面、↓カルテ画面
        
        if (!empty($data["karute_id"] = $this->input->post("karute_id"))) {
            if ($this->input->post("karute_in") == 1) { //カルテ入力ボタンにて
                // $data["r_karute"] = $this->Mdl_karute->get_karute_for_customer($_SESSION["shop_id"]);
                $data["karute_created_at"] = "2019-11-19 16:56:05";
                $this->load->view('cms/pages/parts/header');
                $this->load->view('cms/pages/parts/sidebar');
                $this->load->view('cms/vi_new_karute', $data);
            } elseif ($this->input-post("karute_his") == 2) {  //カルテ履歴ボタンにて
            }
        } else {    //カルテの最初の画面にて一覧リスト
            $data["r_karute"] = $this->Mdl_karute->get_karute_for_customers($_SESSION["shop_id"]);
            $this->load->view('cms/pages/parts/header');
            $this->load->view('cms/pages/parts/sidebar');
            $this->load->view('cms/vi_rireki_karute', $data);
            
            // $this->load->view('cms/vi_Karte_history_list', $data);
        }
    }
    // カルテ履歴ボタン
    public function rireki()
    {
        $data["r_karute"] = $this->Mdl_karute->get_karute_history_customer($_SESSION["shop_id"], $this->input->get('customer_id'));
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/vi_Karte_history_list', $data);
        // var_dump($this->input->get('customer_id'));
        // exit;
    }
    //新規カルテ本登録
    public function update_karute()
    {
        $this->load->library('form_validation');
        if ($this->form_validation->run('karte')) {
            // $data = $this->input->post(NULL,true);
            // $data['karute_shop_id'] = $_SESSION["shop_id"];
            $data = [
                "where" => [
                    "karute_id" => $this->input->post("karute_id"),
                    "karute_shop_id" => $_SESSION["shop_id"],
                ],
                "update" => [
                    "karute_title" => $this->input->post("karute_title"),
                    "karute_comment" => $this->input->post("karute_comment")
                ]
             ];
            //var_dump($data);  exit;
            $this->Mdl_karute->main_insert_karute($data);
            redirect(base_url()."Karte_history");
        } else {
            echo "err";
        }
    }

    //更新時、全件取得
    // public function get_total_all_data()
    // {
    //     $pet_id = $this->input->post("id");
    //     $this->load->model("Mdl_total_list");
    //     return  $this->Mdl_total_list->m_get_total_all($pet_id);

    // }

    //入力チェック
    // private function total_validation()
    // {
    //     $config = [
    //         [
    //             'field' => 'karute_title',
    //             'label' => 'カルテタイトル',
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => '入力してください'
    //             ]
    //         ],
    //         [
    //             'field' => 'karute_comment',
    //             'label' => 'カルテコメント',
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'カナを入力してください'
    //             ]
    //         ]
    //     ];
    //     $this->load->library('form_validation', $config);
    //     return $this->form_validation->run('karte');
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
