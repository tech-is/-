<?php

class Mdl_shops extends CI_Model
{

    public function get_tmp_email($code)
    {
        $query = $this->db->select("tmp_shop_email", "tmp_shop_code")->where("tmp_shop_code", $code)->get("tmp_shops");
        // $this->db->where("tmp_shop_code", $code);
        // $this->db->select("tmp_shop_email", "tmp_shop_code");
        // $query = $this->db->get("tmp_shops");
        $query->num_rows() === 1? $result = $query->row(0, "array"): $result = false;
        // $result = $query->num_rows() === 1 ? $query->row(0, "array"): false;
        return $result;
    }

    public function insert_shops($data)
    {
        $this->db->trans_start();
        $query = $this->db->insert('shops', $data);
        $query = $this->db->where('tmp_shop_email', $data['shop_email'])->delete('tmp_shops');
        $this->db->trans_complete();
        return !$this->db->trans_status()? false: true;
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