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
        isset($_SESSION['shop_id'])?: header('location: //animarl.com/login');
    }

    //TOPページ
    public function index()
    {   //上新規入力画面、↓カルテ画面
        
        if (!empty($data["karute_id"] = $this->input->get("karute_id"))) {
            $data["d_karute"] = $this->Mdl_karute->new_select_karute($_SESSION["shop_id"], $data["karute_id"]);
            //ここで$data["karute_id"]のデータを取得
            $this->load->view('cms/pages/parts/header');
            $this->load->view('cms/pages/parts/sidebar');
            $this->load->view('cms/pages/karute/view_new_karute', $data);
        } else {    //カルテの最初の画面にて一覧リスト
            $data["r_karute"] = $this->Mdl_karute->get_karute_for_customers($_SESSION["shop_id"]);
            $this->load->view('cms/pages/parts/header');
            $this->load->view('cms/pages/parts/sidebar');
            $this->load->view('cms/pages/karute/view_rireki_karute', $data);
        }
    }
    // カルテ履歴ボタン
    public function rireki()
    {
        $data["r_karute"] = $this->Mdl_karute->get_karute_history_customer($_SESSION["shop_id"], $this->input->get('customer_id'));
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/karute/view_Karte_history_list', $data);
        // var_dump($this->input->get('customer_id'));
        // exit;
    }

    //(新規カルテ本登録)(view_new_karuteより)
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

    //カルテ消去
    public function delete_karute()
    {
        $karute_id = $this->input->get("karute_id");
        $shop_id = $_SESSION["shop_id"];
        $this->Mdl_karute->delete_karute_data($karute_id, $shop_id);
        redirect(base_url()."Karte_history");
    }

    //カルテ用バーコード印刷
    public function customer_barcode()
    {
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/vi_barcode');
        include("cms/php_barcode-master/barcode.php");
    }
}
