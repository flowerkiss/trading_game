<?php
class Login extends CI_Controller {
 private $pass = '';
 public function __construct() {
  parent::__construct ();
  $this->load->helper ( array (
    'form',
    'url'
  ) );
  $this->load->library('session');
 }

 public function intro_test($data) {
     //$data = array();
     $this->load->view ( 'introduction', $data );
 }

 public function index() {
  $this->load->view ( 'login' );
 }

 public function logout(){
   $this->session->sess_destroy();
   $this->load->view ( 'login' );
 }

 public function formsubmit() {
  $this->load->model("random_gen_model");
  $this->load->library ( 'form_validation' );

  $this->form_validation->set_rules ( 'username', 'Username', 'required' );
  $this->form_validation->set_rules ( 'password', 'Password', 'required' );
  if ($this->form_validation->run () == FALSE) {
   $this->load->view ( 'login' );
  } else {
   $arr = $this->random_gen_model->getPara();
   if (isset ( $_POST ['submit'] ) && ! empty ( $_POST ['submit'] )) {
    $data = array (
      'user' => $_POST ['username'],
      'pass' => md5($_POST ['password']),
      'role' => "tester",
      'test_num_left' => $arr["total_round"]
    );
    $newdata = array(
      'username'  =>  $data ['user'] ,
      'userip'     => $_SERVER['REMOTE_ADDR'],
      'luptime'   =>time()
    );
    if ($_POST ['submit'] == 'login') {
      $query = $this->db->get_where ( 'trading_test_user', array (
        'user' => $data ['user']
      ), 1, 0 );

     $pass = '';
     foreach ( $query->result () as $row ) {
       $pass = $row->pass;
     }
     $para["error"] = "Login Failed!";
     if($pass=='')$this->load->view ( 'login',$para);
     if ($pass == $data ['pass']) {

       if($data ['user']!="admin"){
         $_SESSION = array();
         //session_start();
         $this->session->set_userdata($newdata);
         //$this->load->view ( 'introduction', $data );
         redirect('test/introduction');
       }else{
         $this->session->set_userdata($newdata);
         redirect('admin');
         //$this->load->view( 'admin', $data );
       }

    }
    } else if ($_POST ['submit'] == 'register') {

      if($data ['user']!="admin"){
        $this->db->insert ( 'trading_test_user', $data );
        $data2 = array(
          'id'  =>  $data ['user']
        );
        $this->db->insert ( 'bonus_result', $data2 );
        $_SESSION = array();
        //session_start();
        $this->session->set_userdata($newdata);
        //$this->load->view ( 'introduction', $data );
        redirect('test/introduction');
      }else{
        redirect('login');
      }

    } else {
     $this->session->sess_destroy();
     $this->load->view ( 'login' );
    }
   }
  }
 }
}
