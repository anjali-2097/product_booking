<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Order_Controller extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('User_Order_model');
		$this->load->database();
		$this->load->helper(array('cookie', 'url')); 
	}

	public function index()
	{
		$products['product_names']=$this->User_Order_model->fetch_products();
		$this->load->view('user_order_form',$products);
	}

	public function fetch_subproduct()
	{
		$sub_products=$this->User_Order_model->fetch_subproduct();
		$result['data']=$sub_products;
		$result['message']="Success";
		$result['success']=1;

		echo json_encode($result);
	}

	public function get_subcat_price()
	{
		$sub_cat_price=$this->User_Order_model->get_subcat_price();
		$result['price']=$sub_cat_price;
		$result['message']="Success";
		$result['success']=1;

		echo json_encode($result);
	}
	
	public function book_order()
	{
		$sub_cat_price=$this->User_Order_model->insert_order_details();
		if($sub_cat_price==1){
			$result['message']="Success";
			$result['success']=1;
		}else{
			$result['message']="Error";
			$result['success']=0;
		}
		echo json_encode($result);
	}
}
