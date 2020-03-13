<?php
class Mdl_login extends CI_Model
{
    public function get_userdata($data)
    {
        return $this->db->where($data)->select("shop_id, shop_name, shop_email, shop_password")->get('shops')->row_array();
    }

    public function check_tmp_user($data)
    {
        $query = $this->db->where('shop_email', $data)->select("shop_id")->get('shops');
        return !is_bool($query)? $query->num_rows(): $query;
    }

    public function get_tmp_email($code)
    {
        return $this->db->where("tmp_shop_code", $code)->select("tmp_shop_email")->get("tmp_shops")->row_array();
    }

    public function insert_tmp_data($data)
    {
        return $this->db->insert('tmp_shops', $data);
    }

    public function update_password($data)
    {
        $this->db->trans_start();
        $this->db->where('shop_email', $data['where'])->update('shops', $data['set']);
        $this->db->where('tmp_shop_email', $data['where'])->delete('tmp_shops');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete_tmp_shop($email)
    {
        return$this->db->where('tmp_shop_email', $email)->delete('tmp_shops');
    }
}
