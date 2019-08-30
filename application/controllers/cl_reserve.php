<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cl_reserve extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(["url", "form"]);
    }

    public function get_reserve_data()
    {
        $event_id = $this->input->post("event_id");
        $data = $this->get_reserve($event_id);
        $result = $this->create_html_parts($data);
        echo $result;
    }

    public function update_reserve_data()
    {
        if($this->chk_reserve_data() == true) {
            if($this->update_reserve() == true) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function register_reserve_data()
    {
        if($this->chk_reserve_data() == true) {
            if($this->insert_reserve() == true) {
                redirect("cl_main/reserve");
            } else {
                redirect("cl_main/reserve");
            }
        } else {
            echo "hoge";
            // redirect("cl_main/reserve_new_form");
        }
    }

    private function chk_reserve_data()
    {
        $config = [
            [
                'field' => 'customer',
                'label' => 'お客様名',
                'rules' => 'required'
            ],
            [
                'field' => 'pet',
                'label' => 'ペット名',
                'rules' => 'required'
            ],
            [
                'field' => 'start',
                'label' => '開始日',
                'rules' => 'required'
            ],
            [
                'field' => 'end',
                'label' => '終了日',
                'rules' => 'required'
            ],
            [
                'field' => 'content',
                'label' => '内容',
                'rules' => 'required'
            ]
        ];
        $this->load->library("form_validation", $config);
        $result = $this->form_validation->run();
        return $result;
    }

    private function insert_reserve()
    {
        $this->load->model("mdl_reserve");
        isset($_POST["staff_id"]) == ""? $staff = null: $staff = $_POST["staff_id"];
        $data = [
            'event_customer' => $_POST["customer"],
            'event_pet' => $_POST["pet"],
            'event_start' => $_POST["start"],
            'event_end' => $_POST["end"],
            'event_content' => $_POST["content"],
            'event_staff_id' => $staff
        ];
        $result = $this->mdl_reserve->insert_reserve_data($data);
        return $result;
    }

    private function get_reserve($event_id)
    {
        $this->load->model("mdl_reserve");
        $result = $this->mdl_reserve->select_reserve_data($event_id);
        return $result;
    }

    private function update_reserve()
    {
        $this->load->model("mdl_reserve");
        isset($_POST["staff_id"]) == ""? $staff = null: $staff = $_POST["staff_id"];
        $data = [
            'event_customer' => $_POST["customer"],
            'event_pet' => $_POST["pet"],
            'event_start' => $_POST["start"],
            'event_end' => $_POST["end"],
            'event_content' => $_POST["content"],
            'event_staff_id' => $staff
        ];
        $result = $this->mdl_reserve->update_reserve_data($data);
        return $result;
    }

    private function create_html_parts($data)
    {
        // if(isset($staff_id)) {
        //     $select = "<select name='staff_id' class='form-control show-tick'>";
        //     while($staff_id) {
        //         $select .= "<option value='{$staff_id}'>{$staff_id}</option>";
        //     }
        // } else {
        //     $select = "<select name='staff_id' class='form-control' disabled>";
        //     $select .= "<option>スタッフが登録されていません</option>";
        // }
        // $select .= "</select>";
        $html = <<<EOH
        <form method="POST" action="../cl_reserve/register_reserve_data" id="reserve">
            <div class="header clearfix" style="margin: 30px 0px 30px 0px;">
                <h2 class="pull-left" style="font-weight: bold; line-height: 37px; margin: 0px">編集</h2>
                <div class="pull-right">
                    <button type="button" class="btn bg-pink waves-effect">
                        <i class="material-icons">cancel</i>
                        <span>cancel</span>
                    </button>
                    <button type="submit" class="btn bg-orange waves-effect" style="margin-right: 10px">
                        <i class=" material-icons">save</i>
                        <span>SAVE</span>
                    </button>
                </div>
            </div>
            <div class="body">
                <div class="form-group">
                    <div class="form-line">
                        <label for="customer">お客様名<span style="color: red; margin-left: 10px">必須</span></label>
                        <input type="text" class="form-control" name="customer" placeholder="例：田中太郎さん" value='{$data[0]['event_customer']}'>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="pet">ペット名<span style="color: red; margin-left: 10px">必須</span></label>
                        <input type="text" class="form-control" name="pet" placeholder="例：ポチくん" value='{$data[0]['event_pet']}'>
                    </div>
                </div>
                <div class="form-group">
                    <!-- <div class="form-line"> -->
                    <label for="staff">担当者</label>
                    <?= select_staff()?>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="start">開始日時<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="datetime-local" name="start" class="form-control" placeholder="開始日時">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="end">終了日時<span style="color: red; margin-left: 10px">必須</span></label>
                                <input type="time" name="end" class="datetimepicker form-control" placeholder="終了日時">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="from_name">予約内容</label>
                        <textarea rows=4 class="form-control" name="content" placeholder="トリミング"></textarea>
                    </div>
                </div>
            </div>
            <input type="hidden" name="event_id" value="{$data[0]['event_id']}">
        </form>
        <script>
        $("#reserve").validate({
                rules: {
                    customer: {
                        required: true
                    },
                    pet: {
                        required: true
                    },
                    start: {
                        required: true
                    },
                    end: {
                        required: true
                    },
                    content: {
                        required: true
                    }
                },
                messages: {
                    customer: {
                        required: "入力してください。"
                    },
                    pet: {
                        required: "入力してください。"
                    },
                    start: {
                        required: "入力してください。"
                    },
                    end: {
                        required: "入力してください。"
                    },
                    content: {
                        required: "入力してください。"
                    }
                },
                highlight: function (input) {
                    // console.log(input);
                    $(input).parents('.form-line').addClass('error');
                },
                unhighlight: function (input) {
                    $(input).parents('.form-line').removeClass('error');
                },
                errorPlacement: function (error, element) {
                    $(element).parents('.input-group').append(error);
                    $(element).parents('.form-group').append(error);
                }
            });
        </script>
        EOH;
        return $html;
    }

}