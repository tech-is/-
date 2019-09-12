<?php

class mdl_customer extends CI_Model
{
     //ANIMARLのデータベースを呼び出し
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

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

    public function update_customer_data($id, $data)
    {
        //update customer set where = customer_id and customer_shop_id;
        $this->db->set($data);
        $this->db->where(['customer_id'=> $id['customer_id'], 'customer_shop_id' => $id['customer_shop_id']]);
        return $this->db->update('customer');
    }

    public function delete_staff_data($id)
    {
        $this->db->set("customer_state", 999);
        $this->db->where(['customer_id'=> $id['customer_id'], 'customer_shop_id' => $id['customer_shop_id']]);
        return $this->db->update('customer');
    }

}