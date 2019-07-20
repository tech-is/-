<?php

class Mdl_members extends CI_Model {

    public function __construct()
    {
        // CI_Model constructor の呼び出し
        parent::__construct();
    }

    /**
     * get_customer_table
     * custmoerテーブルからデータを配列で取得
     * @return $query->result();
     */
    public function chk_login()
    {
        $this->db->where("mail", $this->input->post("mail"));
        $this->db->select("id, password");
        $query = $this->db->get('members');
        if($query->num_rows() == 1){
            return $query->result('array');
        }else{
            return false;
        }
    }

    /**
     * get_pets_table
     * petsテーブルからデータを配列で取得
     * @return $query->result();
     */
    public function sign_up_mail($mail)
    {   
        $data = [
            'mail' => $mail,
            'tmp_password' => $tmp
        ];
        return $this->db->insert('members', $data);
    }

    public function update_user()
    {
        $data = $this->input->post(["name", "kana", "tel", "mail", "year"]);
    }
}