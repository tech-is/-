<?php
class Mdl_login extends CI_Model
{
    public function select_login_data($data)
    {
        $this->db->where($data);
        $this->db->select("shop_id, shop_password");
        $query = $this->db->get('shops');
        if($query->num_rows() == 1) {
            return $query->row(0, "array");
        }else{
            return false;
        }
    }
}