<?php

class Mdl_shops extends CI_Model
{

    public function get_tmp_user($code)
    {
        return $this->db->select("tmp_shop_email", "tmp_shop_code")
            ->where("tmp_shop_code", $code)
            ->get("tmp_shops")
            ->row_array();
    }

    public function insert_shops($data)
    {
        return $this->db->insert('shops', $data);
    }

    public function update_shops()
    {
        $this->db->where('id', $id);
        return $this->db->update('shops', $data);
    }

    public function delete_email($email)
    {
        $this->db->delete('shops', ['email' => $email]);
    }

}