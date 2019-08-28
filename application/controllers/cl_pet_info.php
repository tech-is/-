<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cl_pet_info extends CI_Controller {

	/**
	 * Undocumented function
	 *
	 * @return 
	 */
	public function index()
	{
	//mdl_customerの呼び出し
	$this->load->model('mdl_pet_info');
	$this->load->helper(["url", "form"]);
	//ペットカルテ
	$this->load->view('cms/pet_info_view.php');
	$this->load->view('cms/pages/parts/header.php');
	$this->load->view('cms/pages/parts/sidebars.php');
	}

		//入力後のミス確認からモデルへ
		public function pet_info_validation(){
			$p_test['pet_contraception'] ="";
			$config=array(
				array(
					 'field' => 'pet_name',
					 'label' => '名前',
					 'rules' => 'required|trim',
					 'errors' => array(
					 'required' => '名前を入力してください'
														 )
					 ),
				array(
					'field' => 'pet_classification',
					'label' => '分類',
					'rules' => 'required|trim',
					'errors' => array(
					'required' => '入力してください'
														)
					),
				array(
					'field' => 'pet_type',
					'label' => '種類',
					'rules' => 'required',
					'errors' => array(
					'required' => '入力して下さい'
															)
					),
				array(
					'field' => 'pet_animal_gender',
					'label' => '性別',
					'rules' => 'required|trim',
					'errors' => array(
					'required' => '選択してください'
															)
					),
				array(
					'field' => 'pet_birthday',
					'label' => '生年月日',
					'rules' => 'required|trim',
					'errors' => array(
					'required' => '入力してください'
															)
					),
				array(
					'field' => 'pet_contraception',
					'label' => '避妊',
					'rules' => 'required|trim',
					'errors' => array(
					'required' => '入力してください'
															)
					),
				array(
					'field' => 'pet_body_height',
					'label' => '体高',
					'rules' => 'required|trim',
					'errors' => array(
					'required' => '入力してください'
															)
					),
				array(
					'field' => 'pet_body_weight',
					'label' => '体重',
					'rules' => 'required|trim',
					'errors' => array(
						'required' => '入力してください'
																)
					),
				array(
					'field' => 'pet_information',
					'label' => '備考',
					'rules' => 'required|trim',
					)
				);
							$this->load->library('form_validation');
							$this->form_validation->set_rules($config);
							// $this->form_validation->set_rules('files[]', '写真', 'required');

					if ($this->form_validation->run() !== false){
								$this->load->model('mdl_pet_info');
								$p_test = $this->input->post();
							}else{
								// $this->index();
							}
	
					//避妊をintへ
					if(isset($p_test['pet_contraception'])){
						if($p_test['pet_contraception'] == 'null') {
								$p_test['pet_contraception'] = 1; 
							}else{
								$p_test['pet_contraception'] = 2;
							}
						}
					//性別をintへ
						// if($p_test['pet_animal_gender'] == 'male') {
						// 		$p_test['pet_animal_gender'] = 1; 
						// 	}elseif ($p_test['pet_animal_gender'] == 'female') {
						// 		$p_test['pet_animal_gender'] = 2;
						// 	}elseif($p_test['pet_animal_gender'] == 'other'){
						// 		$p_test['pet_animal_gender'] = 3;
						// 	}else{
						// 		$p_test['pet_animal_gender'] = NULL;
						// 	}

						//データベースの呼び出し	
						// $this->mdl_pet_info->test($p_test);

					if($this->mdl_pet_info->test($p_test) == true) {
							$data["text"] = "<script>alert('お客様の登録が完了致しました。')</script>";
							$this->load->view("cms/pet_info_view",$data);
						} else {
							$data["text"]  = "<script>alert('登録失敗しました。以上の項目をご確認ください。')</script>";
							$this->load->view("cms/pet_info_view",$data);
						}
		}
}
