<?php
class Mdl_login extends CI_Model
{
    public function select_login_data($data)
    {
        return $this->db->where($data)
            ->select("shop_id, shop_password")
            ->get('shops')
            ->row_array();
    }

    public function insert_tmp_data($data)
    {
        return $this->db->insert('tmp_shops', $data);
    }

    public function update_password($data)
    {
        $this->db->where($data["shop_id"]);
        $this->db->set("shop_password", $data["password"]);
        return $this->db->update('shops');
    }
}