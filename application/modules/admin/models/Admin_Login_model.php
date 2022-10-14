<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Login_model extends MY_Controller {

 function __construct() {
    parent::__construct();
    $this->load->database();
}

public function login_data($email,$password){

    $query=$this->db->where(['email'=>$email,'password'=>$password])->get('admin_login');
    if ($query->num_rows() == 1) {
        $login='valid';
    }else{
        $login='invalid';
    }
    return $login;
}

// public function add_new_admin()
// {
//     $new_admin_email=$this->input->post("new_admin_email");
//     $new_mob_no=$this->input->post("new_mob_no");

//     $this->db->select('*')->from('email_list')->where('email',$new_admin_email);
//     $query1= $this->db->get();
//     if ( $query1->num_rows() == 0 )
//     {
//         return 0;
//     }
//     $this->db->select('*')->from('admin')->where('email',$new_admin_email);
//     $query= $this->db->get();
//     if ( $query->num_rows() == 0 )
//     {
//         $key=rand(10000,99999);
//         $data=array(
//             'email'=>$new_admin_email,
//             'phone_no'=>$new_mob_no,
//             'key_gen'=>$key,
//         );
//         $this->db->insert('admin',$data);
//         $id=$this->db->insert_id();
//         $subject='Change Your Password Here';
//         $url=base_url();
//         $sms_text='<a href="'.$url.'admin_reset_pass?id='.$id.'&key='.$key.'">click here to reset your password..</a>';
//         $this->load->helper('send_mail_helper');
//         send_email($new_admin_email,$subject,$sms_text);
//     }
//     $this->db->set('mobile',$new_mob_no)->where('email',$new_admin_email)->update('email_list');
//     return 1;
// }  

public function check_email($email){
    $this->db->select('*');
    $this->db->from('admin_login');
    $this->db->where('email', $email );
    $query = $this->db->get();

    if ( $query->num_rows() == 0 )
    {
        $check_email='incorrect_email';
    }else{
        $check_email='';
    }
    return $check_email;
}

// public function save_admin_reset_pass()
// {
//     $new_pass=$this->input->post("new_pass");
//     $reset_id=$this->input->post("reset_id");

//     $key=rand(10000,99999);

//     $this->db->set(['password'=>$new_pass,'key_gen'=>$key])->where('id',$reset_id)->update('admin');
//     return 1;

// }

// public function user_data(){
//     $query = $this->db->get('users');
//     $results=array();
//     foreach ($query->result() as $key => $row){
//         $results[$key]= array(
//             'user_id' => $row->id,
//             'user_name' => $row->name,
//             'user_email' => $row->email,
//             'user_add' => $row->address,
//             'user_mob' => $row->phone_no,
//         );
//     }
//     return $results;
// }

// public function fetch_user_details(){
//     $user_id=$this->input->post("id");
//     $this->db->select('*')->from('users')->where('id',$user_id);
//     $query=$this->db->get();

//     $results=array();
//     foreach ($query->result() as $key => $row){
//         $results= array(
//             'user_id' => $row->id,
//             'name' => $row->name,
//             'email' => $row->email,
//             'description' => $row->description,
//             'designation' => $row->designation,
//             'phone_no' => $row->phone_no,
//             'gender' => $row->gender,
//             'address' => $row->address,
//             'office_address' => $row->office_address,
//         );
//     }
//     return $results;
// }

// public function delete_user(){
//     $user_id=$this->input->post("id");
//     $this->db->where('id',$user_id);
//     $this->db->delete('users');
//     return true;
// }

// public function check_old_pass()
// {
//     $old_pass=md5($this->input->post('pass'));
//     $email=$_SESSION['admin_email'];
//     $query=$this->db->select('password')->from('admin')->where(['email'=>$email,'password'=>$old_pass])->get()->num_rows();
//     if($query==1){
//         return true;
//     }else{
//         return false;
//     }
// }

// public function update_pass()
// {
//     $old_pass=md5($this->input->post('password'));
//     $email=$_SESSION['admin_email'];
//     $this->db->set('password',$old_pass)
//     ->where('email',$email)
//     ->update('admin');
//     $query=$this->db->select('*')->from('admin')->where(['password'=>$old_pass,'email'=>$email])->get()->num_rows();
//     if($query==1){
//         return 1;
//     }else{
//         return 0;
//     } 
// }

// public function user_book_detail()
// {
//     $total_users=$this->db->select('*')->from('users')->get()->num_rows();
//     $date=date('Y-m-d');
//     $today_request=$this->db->select('*')->from('book')->where('request_date',$date)->get()->num_rows();
//     $pending_request=$this->db->select('*')->from('book')->where('book_status','default')->get()->num_rows();
//     $total_book_request=$this->db->select('*')->from('book')->get()->num_rows();


//     $data=array(
//         'num_of_user'=>$total_users,
//         'num_of_today_request'=>$today_request,
//         'pending_request'=>$pending_request,
//         'num_of_book_request'=>$total_book_request,
//     );
//     return $data;
// }
}
