<?php

class Mdl_shops extends CI_Model
{
    public function insert_mail($data)
    {
        $this->db->insert('tmp_shops', $data)? $result = true: $result = false;
        return $result;
    }

    public function select_code($code)
    {
        $this->db->where("tmp_code", $code);
        $this->db->select("tmp_email", "tmp_code");
        $query = $this->db->get("tmp_shops");
        $query->num_rows() == 1? $result = $query->row(0, "array"): $result = false;
        return $result;
    }

    public function insert_shops($data)
    {
        return $this->db->insert('shops', $data);
    }

    public function update_shops()
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
        return $this->db->update('shops', $data);
    }

    public function delete_email($email)
    {
        $this->db->delete('shops', ['email' => $email]);
    }

}