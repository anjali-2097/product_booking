<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Order_model extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function fetch_products(){
		$query = $this->db->get('product_master');
		$results=array();
		foreach ($query->result() as $key => $row){
			$results[$key]= array(
				'product_id' => $row->id,
				'product_name' => $row->product_name,
				'unit' => $row->unit,
				'unit_price' => $row->unit_price,
			);
		}
		return $results;
	}

	public function fetch_subproduct(){
		$product_id=$this->input->post("product_id");
		$query=$this->db->select('GROUP_CONCAT(product_subcategory_master.id) as sub_cat_id,GROUP_CONCAT(product_subcategory_master.subcat_name) as subcat_name')
		->from('product_subcategory_master')
		->join('product_master','product_master.id=product_subcategory_master.pdt_cat_id')
		->where('product_subcategory_master.pdt_cat_id',$product_id)
		->get();

		foreach ($query->result() as $key => $value){
			$sub_cat_id=explode(",", $value->sub_cat_id);
			$subcat_name=explode(",", $value->subcat_name);
		}

		$results=array(
			'sub_cat_id'=>$sub_cat_id,
			'subcat_name'=>$subcat_name
		);
		return $results;
	}

	public function get_subcat_price(){
		$product_subcat_id=$this->input->post("product_subcat_id");
		// print_r($product_subcat_id);die();
		$query=$this->db->select('subcat_unit_price as unit_price')
		->from('product_subcategory_master')
		->where('product_subcategory_master.id',$product_subcat_id)
		->get()
		->result_array();

		$price=$query[0]['unit_price'];

		return $price;
	}

	public function insert_order_details(){

		$customer_name=$this->input->post("customer_name");
		$mobile_number=$this->input->post("mobile_number");
		$pick_up_loc=$this->input->post("pick_up_loc");
		$pick_up_date=$this->input->post("pick_up_date");
		$product_detail=$this->input->post("product_detail");
		$total_amount=$this->input->post("total_amount");

		$data=array(
			'user_name'=>$customer_name,
			'user_mob_no'=>$mobile_number,
			'pickup_location_id' => $pick_up_loc,
			'pick_up_date'=> $pick_up_date,
			'total_price'=> $total_amount,
		);

		$this->db->insert('orders',$data);
		$order_id=$this->db->insert_id();

		foreach ($product_detail as $key => $value) {
			$product_data=array(
				'orders_id'=>$order_id,
				'product_id'=>$value['product_name'],
				'sub_product_id' => $value['product_sub_category'],
				'quantity'=> $value['quantity'],
				'unit_price'=> $value['cost_per_product'],
			);
			$this->db->insert('order_details',$product_data);
		}

		return 1;	
	}
}
?>