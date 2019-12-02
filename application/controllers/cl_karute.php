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
        if(!empty($customer_barcode = $this->input->post("customer_barcode"))){
            // $customer_id = $this->input->post("customer_id");
            $data["karute"] = $this->Mdl_karute->m_karute_get($_SESSION["shop_id"], $customer_barcode);
            // 以下カルテにインサート
            $this->Mdl_karute->sub_insert_karute($_SESSION["shop_id"],$data["karute"]["customer_id"]);
            $this->karute_result($data);
        }else{
            $data["list"] = $this->get_total_list();
            $data["groups"] = $this->get_kind_group();
            $this->load->view('cms/pages/parts/header');
            $this->load->view('cms/pages/parts/sidebar');
            $this->load->view('cms/pages/stanby_karute/vi_karute', $data);
        }
    }

    //検索結果をページ遷移
    public function karute_result($data)
    {
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/stanby_karute/vi_karute_result', $data);
    }
    //カルテページ遷移
    public function rireki_karute($data)
    {
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/stanby_karute/vi_karute_result', $data);
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

    //カルテの登録
    public function karute_data()
    {
        // $data['debug'] = var_export($_POST, true);
        //顧客の登録
            $this->load->model("Mdl_karute");
            if($this->Mdl_karute->m_insert_karute() === true){
                echo "success";
                exit;
            } else {
                echo "dberror";
                exit;
            }
    }
}