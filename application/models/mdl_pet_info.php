<?php

class mdl_pet_info extends CI_Model
{
     //ANIMARLのデータベースを呼び出し
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //データの登録
   //登録するデータを第一引数で持つ
    public function test($p_test)
    {
        echo 'aaaa';
        var_dump($p_test);

        //$c_testは連想配列、カラム名をkeyとして格納し
        //1引数でテーブル名、2で連想配列として受け渡す

        $this->db->insert('pet',$p_test);
    }
    // public funcution reservdate()
    // {
    //     $this->db->query('select ')
    // }
        
    /**
     * get_customer_table
     * custmoerテーブルからデータを配列で取得
     * @return $query->result();
     */
}