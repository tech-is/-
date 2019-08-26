<?php

class Mdl_register extends CI_Model
{
    public function insert_mail($email, $code)
    {
        $data = [
            'tmp_email' => $email,
            'tmp_code' => $code
        ];
        $this->db->insert('tmp_shops', $data)? $result = true: $result = false;
        return $result;
    }

    public function check_code($code)
    {
        $query = $this->db->get_where("tmp_shops", ["tmp_code" => $code]);
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