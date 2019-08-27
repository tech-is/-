<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cl_customer extends CI_Controller {

	/**
	 * Undocumented function
	 *
	 * @return 
	 */
	public function index()
	{
		//mdl_customerの呼び出し
    $this->load->model('mdl_customer');
	
		$this->load->helper(["url", "form"]);

		//顧客登録一覧
		$this->load->view('cms/Customer_view');
		$this->load->view('cms/pages/parts/header');
		$this->load->view('cms/pages/parts/sidebars');
	}
	
	// public function check_customer()
  //   {
  //       $config = [
  //           [
  //               'field' => 'email',
  //               'label' => 'メールアドレス',
  //               'rules' => 'required'
  //           ],
  //           [
  //               'field' => 'password',
  //               'label' => 'パスワード',
  //               'rules' => 'required'
  //           ],
  //       ];
  //       $this->load->library("form_validation", $config);
  //       if($this->form_validation->run() == false) {
  //           $this->load->view('sign-up.html');
  //       } else {
  //           if($this->mdl_members->chk_login()) {
  //               redirect("index.php/cl_main/main");
  //           } else {
  //               redirect("index.php/cl_main/login");
  //           }
  //       }
  //   }
	//入力後のミス確認からモデルへ
	public function customer_validation(){
		$c_test['customer_magazine'] ="";
		$config=array(
			array(
			   'field' => 'customer_name',
			   'label' => '名前',
			   'rules' => 'required|trim',
			   'errors' => array(
				 'required' => '名前を入力してください'
													 )
				 ),
			array(
				'field' => 'customer_kana',
				'label' => 'カナ',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => 'カナを入力してください'
													)
				),
			array(
				'field' => 'customer_mail',
				'label' => 'メール',
				'rules' => 'required',
				'errors' => array(
				'required' => 'メールを入力して下さい'
														)
				),
			array(
				'field' => 'customer_tel',
				'label' => '電話',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => '番号を入力してください'
														)
				),
			array(
				'field' => 'customer_zip_address',
				'label' => '郵便番号',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => '郵便番号を入力してください'
														)
				),
			array(
				'field' => 'customer_address',
				'label' => '住所',
				'rules' => 'required|trim',
				'errors' => array(
				'required' => '住所を入力してください'
														)
				),
			array(
				'field' => 'customer_magazine',
				'label' => 'マガジン発行',
				),
			array(
				'field' => 'customer_add_info',
				'label' => '追加情報',
				'rules' => 'required|trim',
				),
			array(
				'field' => 'customer_group',
				'label' => 'ランク',
				'rules' => 'required|trim',
				)
		);
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
	if ($this->form_validation->run() !== false){
				$this->load->model('mdl_customer');
				$c_test = $this->input->post(NULL,true);
		}else{
			$this->load->view('cms/Customer_view.html');
		}

				//メールマガジンをintへ
				if(isset($c_test['customer_magazine'])){
					if($c_test['customer_magazine'] == 'null') {
							$c_test['customer_magazine'] = 0; 
						}else{
							$c_test['customer_magazine'] = 1;
					}
				}
				//グループをintへ
					if($c_test['customer_group'] == 'gold') {
							$c_test['customer_group'] = 0; 
						}elseif ($c_test['customer_group'] == 'silver') {
							$c_test['customer_group'] = 1;
						}elseif($c_test['customer_group'] == 'bronze'){
							$c_test['customer_group'] = 2;
						}else{
							$c_test['customer_group'] = 3;
						}
					//データベースの呼び出し	

				if($this->mdl_customer->test($c_test) == true) {
						$data["text"] = "<script>alert('お客様の登録が完了致しました。')</script>";
						$this->load->view("cms/Customer_view",$data);
					} else {
						$data["text"]  = "<script>alert('登録失敗しました。以上の項目をご確認ください。')</script>";
						$this->load->view("cms/Customer_view",$data);
					}
				}
	
}
