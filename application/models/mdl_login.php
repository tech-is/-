<?php
class Mdl_login extends CI_Model
{
    public function chk_login()
    {
        $this->db->where("email", $this->input->post("email"));
        $this->db->select("id, password");
        $query = $this->db->get('customer');
        if($query->num_rows() == 1) {
            return $query->result_array();
        }else{
            return false;
        }
    }
}