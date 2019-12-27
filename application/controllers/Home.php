<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
        isset($_SESSION['shop_id'])?: header('location: https://www.animarl.com/login');
    }

    public function index()
    {
        $this->load->model(['mdl_reserve', 'mdl_shift']);
        $reserve_columns = [
            'pet_name' => 'title',
            'reserve_start' => 'start',
            'reserve_end' => 'end',
            'reserve_color' => 'color'
        ];
        $shift_columns = [
            'staff_name' => 'title',
            'shift_start' => 'start',
            'shift_end' => 'end',
            'staff_color' => 'color'
        ];
        $array = null;
        if (!empty($reserves = $this->mdl_reserve->get_reserve($_SESSION['shop_id']))) {
            foreach ($reserves as $row => $reserve) {
                foreach ($reserve as $column => $value) {
                    if (array_key_exists($column, $reserve_columns)) {
                        $array['reserve'][$row][$reserve_columns[$column]] = $value;
                    } else {
                        $array['reserve'][$row][$column] = $value;
                    }
                }
            }
        }
        if ($shifts = $this->mdl_shift->get_shift($_SESSION["shop_id"])) {
            foreach ($shifts as $row => $shift) {
                foreach ($shift as $column => $value) {
                    if (array_key_exists($column, $shift_columns)) {
                        $array['shift'][$row][$shift_columns[$column]] = $value;
                    } else {
                        $array['shift'][$row][$column] = $value;
                    }
                }
            }
        }
        if(is_array($array['reserve']) && is_array($array['reserve'])) {
            $events = array_merge($array['reserve'], $array['shift']);
        } else {

        }
        $data['json'] = !empty($events)? json_encode($events): '{}';
        $this->load->view('cms/pages/parts/header');
        $this->load->view('cms/pages/parts/sidebar');
        $this->load->view('cms/pages/home/view_home', $data);
    }
}
