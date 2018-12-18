<?php
class Admin extends CI_Controller {
    private $pass = '';
    public function __construct() {
    parent::__construct ();
    $this->load->helper ( array (
        'form',
        'url'
    ));
    $this->load->library('session');
    $this->load->model('admin_model');

    if($_SESSION["username"]!="admin"||empty($_SESSION['username'])){
      redirect('login');
    }
 }

    public function index() {
        $para=$this->admin_model->readInitConfig();
        $this->load->view('admin',$para);
    }

    public function formsubmit() {
        $para["total_round"] = $_REQUEST["total_round"];
        $para["N"] = $_REQUEST["N"];
        $para["V0"] = $_REQUEST["V0"];
        $para["sigma_v"] = $_REQUEST["sigma_v"];
        $para["sigma_uL"] = $_REQUEST["sigma_uL"];
        $para["sigma_uH"] = $_REQUEST["sigma_uH"];
        $para["sigma_e"] = $_REQUEST["sigma_e"];

        $para["sound_bit"] = $_REQUEST["sound_bit"];
        $para["test_type"] = $_REQUEST["test_type"];
        $para["voice_type"] = $_REQUEST["voice_type"];//3.7->3.8新增
        $para["loudness_mapping_type"] = $_REQUEST["loudness_mapping_type"];//3.8->3.9新增
        $para=$this->admin_model->saveConfig($para);
        redirect('admin');
    }

    public function test(){
      for($i=0;$i<10000;$i++){
        echo rand(0,1);
        echo "<br>";
      }
    }

    public function logout(){
        echo "Fasdfads";
    }
}
