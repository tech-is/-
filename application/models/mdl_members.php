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
    public function sign_up_mail($email, $tmp)
    {
        $data = [
            'email' => $email,
            'pass_tmp' => $tmp
        ];
        // $this->db->trans_start();
        if($this->db->insert('members', $data)) {
            return true;
        } else {
            return false;
        }
        // $this->db->trans_complete();
        // if ($this->db->trans_status() === FALSE){
        //     return false;
        // } else {
        //     return true;
        // }
    }

    public function check_tmp($tmp)
    {
        $query = $this->db->get_where("members", ["pass_tmp" => $tmp]);
        $row = $query->result();
        count($row)  == 1? $result = true: $result =false;
        return $result;
    }

    public function update_user()
    {
        $data = [
            "name" => $name,
            "kana" => $kana,
            "tel" => $tel,
            "year" => $year,
            "password" => $password,
            "pass_tmp" => null
        ];
        $this->db->where('id', $id);
        return $this->db->update('mytable', $data);
    }
}