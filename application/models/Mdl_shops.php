<?php

class Mdl_shops extends CI_Model
{
    public function get_tmp_email($code)
    {
        return $this->db->select("tmp_shop_email")->where("tmp_shop_code", $code)->get("tmp_shops")->row_array();
    }

    public function insert_shops($data)
    {
        $this->db->trans_start();
        $this->db->insert('shops', $data);
        $this->db->where('tmp_shop_email', $data['shop_email'])->delete('tmp_shops');
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update_shops()
    {
        $this->db->where('id', $id)->db->update('shops', $data);
    }

    public function delete_email($email)
    {
        $this->db->delete('shops', ['email' => $email]);
    }
}
