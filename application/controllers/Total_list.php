<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * タイトル：顧客・ペット管理
 * 説明    ：顧客・ペットの登録・変更・削除を行う
 *
 * 著作権  ：Copyright(c) 2019 TECH I.S
 * 会社名  ：TECH I.S
 *
 * 変更履歴：2019.8 開発
 */

class Total_list extends CI_Controller
{
    /**
     * コンストラクタ
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        $this->load->model('Mdl_total_list');
        $this->load->library('form_validation');
        $_SESSION['shop_id'] = 1;
        // isset($_SESSION['shop_id'])?: header('location: //animarl.com/login');
    }

    /**
     * 顧客・ペット管理ページの読み込み
     *
     * @return void
     */
    public function index()
    {
        $data["list"] = $this->Mdl_total_list->get_total_data($_SESSION["shop_id"]);
        $data["groups"] = $this->get_kind_group();
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/total_list/view_total_list', $data);
    }

    /**
     *
     *
     * @return void
     */
    private function get_total_list()
    {
        $shop_id = $_SESSION["shop_id"];
        return $this->Mdl_total_list->get_total_data($shop_id);
    }

    //グループ検索
    private function get_kind_group()
    {
        $id = $_SESSION["shop_id"];
        return $this->Mdl_total_list->m_get_kind_group($id);
    }

    //グループを削除リストへ表示させる
    public function delete_kind_group()
    {
        if ($this->request_ajax_check() === true) {
            $kind_group_id = @$this->input->post("kind_group_id")?: exit;
            $id = [
                "kind_group_id" => $kind_group_id,
                "shop_id" => $_SESSION["shop_id"]
            ];
            $result = $this->Mdl_total_list->delete_kind_group_data($id);
            echo $result===true? 1: "dberror";
        }
        exit;
    }

    //グループ管理インサート
    public function insert_kind_group()
    {
        $data = [
            "kind_group_shop_id " => $_SESSION['shop_id'],
            "kind_group_name" => $this->input->post("kind_group_name")
        ];
        $this->load->model("Mdl_total_list");
        $result = $this->Mdl_total_list->insert_model_data($data);
        if ($result === true) {
            echo "success";
        }
    }

    //更新時、全件取得
    public function get_total_all_data()
    {
        $pet_id = $this->input->post("id");
        $this->load->model("Mdl_total_list");
        $return = $this->Mdl_total_list->m_get_total_all($pet_id);
        if ($return) {
            header("Content-type: application/json; charset=UTF-8");
            echo json_encode($return);
            exit;
        } else {
            echo "dberror";
            exit;
        }
    }

    //ペットと顧客の登録
    public function insert_total_data()
    {
        //顧客の登録
        if ($this->form_validation->run('total')) {
            $data = $this->escape_xss();
            if (isset($_FILES["pet_img"])) {
                if ($_FILES["pet_img"]["error"] === 0) { //エラーがなく正常
                    $result_upload = $this->img_upload();
                    if ($result_upload) {
                        $data["pet_data"]["pet_img"] = $result_upload;
                    } else {
                        $res_array = json_msg('total', false);
                        exit;
                    }
                } elseif ($_FILES["pet_img"]["error"] !== 4) { //エラーにてアップロードされてない以外の処理
                    echo "upload_err";
                    exit;
                }
            }
            $this->load->model("Mdl_total_list");
            if ($this->Mdl_total_list->m_insert_total_list($data["customer_data"], $data["pet_data"]) === true) {
                echo "success";
                exit;
            } else {
                $res_array = json_msg('total', false);
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        header('Content-Type: application/json');
        exit(json_encode($res_array));
    }

    private function request_ajax_check()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $ref_url = @$_SERVER["HTTP_REFERER"]? parse_url($_SERVER["HTTP_REFERER"]): exit;
            return $ref_url["host"].$ref_url["path"] === "animarl.com/total_list/"? true: false;
        }
    }


    public function update_total_data()
    {
        if ($this->total_validation() == true) {
            $data = $this->escape_xss();
            if (isset($_FILES["pet_img"])) {
                if ($_FILES["pet_img"]["error"] === 0) { //エラーがなく正常
                    $result_upload = $this->img_upload();
                    if ($result_upload === false) {
                        echo "upload_err";
                        exit;
                    } else {
                        $data["pet_data"]["pet_img"] = $result_upload;
                    }
                } elseif ($_FILES["pet_img"]["error"] !== 4) { //エラーにてアップロードされてない以外の処理
                    echo "upload_err";
                    exit;
                }
            }
            $this->load->model("Mdl_total_list");
            if ($this->Mdl_total_list->m_update_total_list($data["id"], $data["customer_data"], $data["pet_data"]) == true) {
                echo "success";
                exit;
            } else {
                echo "dberror";
                exit;
            }
        } else {
            echo "vali_err";
            exit;
        }
    }

    //XSS前処理
    private function escape_xss()
    {
        $post = $this->input->post(null, true); //ajaxでｃーテーブルとテーブルを一緒に登録
        if (isset($post["pet_id"]) && isset($post["customer_id"])) {
            $id = ["customer_id" => $post["customer_id"], "pet_id" => $post["pet_id"]];
            unset($post["customer_id"], $post["pet_id"]);
        }

        foreach ($post as $key => $val) { //カスタマーとペットに分ける処理
            if (strpos($key, 'customer_') !== false) {
                $customer_data[$key] = $val;
                $customer_data["customer_shop_id"] = $_SESSION["shop_id"];
            } else {
                $pet_data[$key] = $val;
            }
        }

        if (isset($id)) {
            return ["id" => $id, "customer_data" => $customer_data, "pet_data" => $pet_data];
        } else {
            return ["customer_data" => $customer_data, "pet_data" => $pet_data];
        }
    }

    //ペットファイルの画像アップ
    private function img_upload()
    {
        $filename = time();
        // $config['upload_path'] = './upload/tmp';//リサイズ前
        // $config['allowed_types'] = 'gif|jpg|png';
        // $config['file_name'] = $filename;
        // $config['max_size']	= '3072';
        // $config['max_width']  = '';
        // $config['max_height']  = '';
        $config = [
            'upload_path' => './upload/tmp',
            'allowed_types' => 'gif|jpg|png',
            'file_name' => $filename,
            'max_size'	=> '3072',
            'max_width'  => '',
            'max_height'  => ''
        ];
        $this->load->library('upload', $config);
        $result = $this->upload->do_upload('pet_img');
        if ($result) {
            $resize_path = './upload/img/thumbs';//リサイズ後
            $image_data = $this->upload->data();
            $config['source_image'] = $image_data["full_path"];
            $config['maintain_ration'] = true;
            $config['new_image'] = $resize_path; //サムネイル保存フォルダ
            $config['width'] = 640;
            $config['height'] = 360;
            $this->load->library("image_lib", $config);
            if ($this->image_lib->resize() === true) {
                // $fullpath = realpath($resize_path);
                return base_url().'upload/img/thumbs/'.$image_data['file_name']; //本番環境では "\" を　"/" に変更
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
