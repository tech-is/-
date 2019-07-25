<?php

class Mdl_members extends CI_Model {

    /**
     * get_customer_table
     * custmoerテーブルからデータを配列で取得
     * @return $query->result();
     */
    public function chk_login()
    {
        $this->db->where("email", $this->input->post("email"));
        $this->db->select("id, password");
        $query = $this->db->get('members');
        if($query->num_rows() == 1) {
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
    public function insert_mail($email, $code)
    {
        $data = [
            'email' => $email,
            'code' => $code
        ];
        $this->db->insert('tmp_members', $data)? $result = true: $result = false;
        return $result;
    }

    public function check_code($code)
    {
        $query = $this->db->get_where("members", ["code" => $code]);
        $query->num_rows() == 1? $result = $query->result("array"): $result = false;
        return $result;
    }

    public function insert_user()
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

    public function delete_email($email)
    {
        $this->db->delete('mytable', ['email' => $email]);
    }
}