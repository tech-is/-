<?php

class mdl_customer extends CI_Model
{
     //ANIMARLのデータベースを呼び出し
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //データの登録
    //登録するデータを第一引数で持つ
    // public function ses_insert_customer($sesdata) {
    //     if($this->db->insert('customer',$sesdata)) {
    //         return true;
    //     }else{
    //         echo "セッション失敗";
    //         // return false;
    //     }
    // }

    public function m_insert_customer($c_test)
    {
        // var_dump($c_test);
        //$c_testは連想配列、カラム名をkeyとして格納し
        //1引数でテーブル名、2で連想配列として受け渡す

        if($this->db->insert('customer', $c_test)) {
            return true;
        }else{
            echo "セッション以外のやつが失敗";
            // return false;
        }
    }

    // private function insert_magazine_data()
    // {
    //     $post_data = $this->input->post(null, true);
    //     $data = [
    //         "mail_shop_id" => $_SESSION["shops_id"],
    //         "mail_from_name" => $post_data["from_name"],
    //         "mail_shop_mail" => $post_data["mail"],
    //         "mail_subject" => $post_data["subject"],
    //         "mail_detail" => $post_data["detail"]
    //     ];
    //     $this->load->model("mdl_magazine");
    //     return $this->mdl_magazine->insert_magazine($data);
    // }
    /**
     * get_customer_table
     * custmoerテーブルからデータを配列で取得
     * @return $query->result();
     */
}