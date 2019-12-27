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

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form', 'ajax']);
        $this->load->model('Mdl_total_list');
        $this->load->library('form_validation');
        isset($_SESSION['shop_id'])?: header('location: https://www.animarl.com/login');
    }

    /**
     * 顧客・ペット管理ページの読み込み
     *
     * @return void
     */
    public function index()
    {
        $data = [
            'list' => $this->Mdl_total_list->get_total_data($_SESSION['shop_id']),
            'groups' => $this->Mdl_total_list->m_get_kind_group(['kind_group_shop_id ' => $_SESSION['shop_id'], 'kind_group_state ' => 1])
        ];
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/total_list/view_total_list', $data);
    }

    /**
     * POSTデータをエスケープ処理
     *
     * @return array
     */
    private function escape_xss()
    {
        $customer_array = [
            'customer_name',
            'customer_kana',
            'customer_mail',
            'customer_tel',
            'customer_zip_adress',
            'customer_address',
            'customer_add_info',
            'customer_group_id'
        ];
        $pet_form_array = [
            'pet_name',
            'pet_img',
            'pet_classification',
            'pet_type',
            'pet_animal_gender',
            'pet_birthday',
            'pet_contraception',
            'pet_body_height',
            'pet_body_weight',
            'pet_information'
        ];
        foreach ($customer_array as $key) {
            $data['customer'][$key] = $this->input->post($key);
        }
        foreach ($pet_form_array as $key) {
            $data['pet'][$key] = $this->input->post($key);
        }
        return $data;
    }

    //更新時、全件取得
    public function get_total_all_data()
    {
        judge_httprequest();
        header('Content-Type: application/json; charaset=utf-8');
        exit(json_encode($this->Mdl_total_list->m_get_total_all($this->input->post('pet_id'))?:['error' => ['title' => 'データの取得に失敗しました', 'msg' => 'また後ほどお試しください']]));
    }

    /**
     * 顧客データとペットデータを同時登録
     * 
     * 
     */
    public function insert_total()
    {
        //顧客の登録
        judge_httprequest();
        header('Content-Type: application/json; charaset=utf-8');
        $error = json_encode(json_msg('total', false, 0));
        if ($this->form_validation->run('total')) {
            $data = $this->escape_xss();
            if (!empty($_FILES['pet_img'])) {
                if ($_FILES['pet_img']['error'] === 0) {
                    $result_upload = $this->img_upload();
                    $data['pet']['pet_img'] = $result_upload?: exit($error);
                } elseif ($_FILES['pet_img']['error'] !== 4) {
                    exit(json_encode($error));
                }
            }
            $data['customer']['customer_shop_id'] = $_SESSION['shop_id'];
            if ($this->Mdl_total_list->insert_total($data['customer'], $data['pet']) === true) {
                $res_array = json_msg('total', true, 0);
            } else {
                $res_array = $error;
            }
        } else {
            $res_array = ['valierr' => $this->form_validation->error_array()];
        }
        exit(json_encode($res_array));
    }

    /**
     * 顧客データとペットデータを同時更新
     *
     * @return void
     */
    public function update_total()
    {
        judge_httprequest();
        header('Content-Type: application/json; charaset=utf-8');
        $error = json_encode(json_msg('total', false, 1));
        if ($this->form_validation->run('total')) {
            $data['where'] = [
                'customer_id' => @$this->input->post('customer_id')?: exit($error),
                'pet_id' => @$this->input->post('pet_id')?: exit($error)
            ];
            $data['update'] = $this->escape_xss();
            if (!empty($_FILES['pet_img'])) {
                if ($_FILES['pet_img']['error'] === 0) { //エラーがなく正常
                    $imgName = !empty($imgName['pet_img'])? basename($imgName['pet_img']): null;
                    $data['update']['pet']['pet_img'] = $this->img_upload($imgName)?: exit($error);
                } elseif ($_FILES['pet_img']['error'] !== 4) { //エラーにてアップロードされてない以外の処理
                    exit($error);
                }
            }
            if ($this->Mdl_total_list->update_total($data['where'], $data['update']['customer'], $data['update']['pet'])) {
                exit(json_encode(json_msg('total', true, 1)));
            } else {
                exit($error);
            }
        } else {
            exit(json_encode(['valierr' => $this->form_validation->error_array()]));
        }
    }

    //グループ管理インサート
    public function insert_kind_group()
    {
        judge_httprequest();
        header('Content-Type: application/json; charaset=utf-8');

        $data = [
            'kind_group_shop_id ' => $_SESSION['shop_id'],
            'kind_group_name' => $this->input->post('kind_group_name')
        ];
        exit(json_encode(json_msg('group', $this->Mdl_total_list->insert_group($data), false, 1)));
    }

    //グループを削除リストへ表示させる
    public function delete_kind_group()
    {
        judge_httprequest();
        header('Content-Type: application/json; charaset=utf-8');
        $this->form_validation->run('group')?: exit(json_encode(json_msg('group', false, 1)));
        $id = [
            'kind_group_id' => @$this->input->post('kind_group_id')?:exit(),
            'shop_id' => $_SESSION['shop_id']
        ];
        exit(json_encode(json_msg('group', $this->Mdl_total_list->delete_kind_group($id), false, 1)));
    }

    /**
     * アップロードされた画面のexif情報を削除し、サムネイルサイズにリサイズ
     * 
     * @return string || boolean
     */
    private function img_upload($prevName = null)
    {
        $fileName = $_FILES['pet_img']['name'];
        $tmpName  = $_FILES['pet_img']['tmp_name'];
        $fileSize = $_FILES['pet_img']['size'];
        $extentison = pathinfo($fileName, PATHINFO_EXTENSION);
        $newName = $prevName?:$_SERVER['REQUEST_TIME'].'.'.$extentison;
        $path = FCPATH.'upload/tmp/'.$newName;
        // exit($path);
        try {
            // ファイルにスクリプトタグが含まれていないかのチェック
            if (count(token_get_all($fileName)) >= 2)  {
                throw new RuntimeException('ファイル形式が不正です');
            }

            // MIMEタイプに対応する拡張子チェック
            if ($extentison != array_search(mime_content_type($tmpName),
                array('gif' => 'image/gif', 'jpg' => 'image/jpeg', 'png' => 'image/png'), true)) {
                throw new RuntimeException('ファイル形式が不正です');
            }

            if (!isset($_FILES['pet_img']['error']) || !is_int($_FILES['pet_img']['error'])) {
                throw new RuntimeException('ファイル形式が不正です');
            } else {
                switch ($_FILES['pet_img']['error']) {
                    case UPLOAD_ERR_OK:
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        throw new RuntimeException('ファイルが選択されていません');
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new RuntimeException('ファイルサイズが大きすぎます');
                    default:
                        throw new RuntimeException('その他のエラーが発生しました');
                }
            }

            // アップロード時にJPEGの場合はEXIFをGDで削除
            list(, , $type) = getimagesize($tmpName);
            if($type === IMG_JPG) {
                // 新規サイズを取得
                $gd = imagecreatefromjpeg($tmpName);
                $w = imagesx($gd);
                $h = imagesy($gd);
                // 再サンプル
                $out = imagecreatetruecolor($w, $h);
                imagecopyresampled($out, $gd, 0, 0, 0, 0, $w, $h, $w, $h);
                // 元画像を削除した上で同一名でファイルを再生成
                unlink($tmpName);
                imagejpeg($out, $tmpName, 100);
                imagedestroy($gd);
            }
            // アップロードされたファイル名をランダムなファイル名にする。
            // ドキュメントルート外のフォルダを指定する クラウドストレージが安全。
            if (!move_uploaded_file ($tmpName, $path)){
                throw new RuntimeException('ファイル保存時にエラーが発生しました');
            }

            // アップロードファイルは実行権限のない状態へ
            chmod($path, 0755);
            return $this->resize_img($path, $newName);
        } catch (RuntimeException $e) {
            // $res_array[] = $e->getMessage();
            exit(json_encode(['error' => ['title' => '写真のアップロードに失敗しました', 'msg' => $e->getMessage()]]));
        }
    }

    /**
     * アップロードされた画像をサムネイルサイズにリサイズ
     *
     * @param   string  $path
     * @param   string  $newName
     * @param   boolean $type
     * @return  void
     */
    private function resize_img($path, $newName)
    {
        $config = [
            'source_image' => $path,
            'new_image' => FCPATH.'/upload/img/'.$newName,
            'width' => 640,
        ];
        $this->load->library('image_lib', $config);
        if ($this->image_lib->resize()) {
            return base_url().'upload/img/'.$newName;
        } else {
            exit(json_encode(['error' => ['title' => '写真のアップロードに失敗しました', 'msg' => "写真のサイズが大きいか不正なファイルを\nアップロードした可能性があります"]]));
        }
    }
}
