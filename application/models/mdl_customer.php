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
    public function test($c_test)
    {
        echo 'aaaa';
        var_dump($c_test);
        $this->db->insert('customer',$c_test);


        //SQLのカラムtask_nameに格納する
        //以下は連想配列、カラム名をkeyとして格納し
        // $data=['task_name'=>$task];
        //1引数でテーブル名、2で連想配列として受け渡す
        // $this->db->insert('task',$data);
    }

    /**
     * get_customer_table
     * custmoerテーブルからデータを配列で取得
     * @return $query->result();
     */
}