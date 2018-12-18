<?php
class Test extends CI_Controller{

  public function __construct() {
   parent::__construct ();
   $this->load->library('session');
   $this->load->helper('url');
   $this->checkLogin();
  }

  public function checkLogin(){
    if(empty($_SESSION["username"])){
      $this->load->helper('url');
      redirect("./login");
    }
  }

    public function gen_rand($N){
      $this->load->model('random_gen_model');

        echo "Generate ".$N."Random numbers:<br>";
        $i = 0;
        $mu = (double)0.0;
        $sigma = (double)1.0;
        while($i < $N){
         echo $this->random_gen_model->generateGaussianNoise($mu,$sigma);
         echo "<br>";
        //  $this->random_gen_model->test();
          $i++;
        }
    }

    public function introduction(){
         $this->checkLogin();
         $this->load->view ('introduction');
    }

    public function rule_desp(){
        $Para["test_type"] = $_SESSION["test_type"];
        $this->load->view('includes/header.php');
        $this->load->view('test/rule_desp.php',$Para);
        $this->load->view('includes/footer.php');
    }

    public function examples($type=0){
      if(isset($_REQUEST["type"])){
        $type = $_REQUEST["type"];
      }
      if($type==6){
        $this->load->model('random_gen_model');
        $Para = $this->random_gen_model->getPara();
        $this->load->view('includes/header.php');
        $this->load->view('select_test.php',$Para);
        $this->load->view('includes/footer.php');

      }else{
        $this->show_echarts_example($type);
      }
    }

    public function gen_plot_data(){
        $this->load->model('random_gen_model');
        $N = 20;
        $V0 = 50.0;
        $sigma_v = 10;
        $sigma_u = 20;
        $sigma_e = 30;
        $results = $this->random_gen_model->generateRandomArrays($N, $V0, $sigma_v, $sigma_u, $sigma_e);
        print_r($results);
    }

    public function show_charts(){
      $this->load->model('random_gen_model');
      $para =Array();
      $N = 20;
      $V0 = 50.0;
      $sigma_v = 5;
      $sigma_u = 10;
      $sigma_e = 5;
      $results = $this->random_gen_model->generateRandomArrays($N, $V0, $sigma_v, $sigma_u, $sigma_e);

      $this->load->view('includes/header.php',$para);
      $this->load->view('chart/show_charts.php',$results);
      $this->load->view('includes/footer.php',$para);

    }

    public function show_echarts($N,$V0,$sigma_v,$sigma_u,$sigma_e,$total_round,$sigma_uH, $mode,$type=""){
      $this->load->model('random_gen_model');
      $para =Array();
      $Para = $this->random_gen_model->getPara();

      $results = $this->random_gen_model->generateRandomArrays($N, $V0, $sigma_v, $sigma_u, $sigma_e);
      $results["total_round"] = $total_round;
      $results["sigma_uH"] = $sigma_uH;
      $results["mode"] = $mode;
      $results["voice_type"] = $Para["voice_type"];
      $results["loudness_mapping_type"] = $Para["loudness_mapping_type"];

      $para =  $this->random_gen_model->get_test_num_left($_SESSION["username"]);
      $this->load->view('includes/header.php',$para);
      $_SESSION["test_type"]=$type;

      if($type=="Sequence"){
        $this->load->view('chart/show_echarts_sequence.php',$results);
      }elseif($type=="Joint"){
        $this->load->view('chart/show_echarts_joint.php',$results);
      }else{
        $this->load->view('chart/show_echarts_sequence_vol_first.php',$results);
      }
      $this->load->view('includes/footer.php',$para);
    }

    public function show_echarts_example($type){
      $this->load->model('random_gen_model');
      $para =Array();
      $Para = $this->random_gen_model->getPara();
      $N = $Para["N"];
      $V0 = $Para["V0"];
      $sigma_e = $Para["sigma_e"];
      $sigma_v = $Para["sigma_v"];
      $total_round = $Para["total_round"];
      $sigma_uH = $Para["sigma_uH"];
      if($type%2!=0){
        $sigma_u = $Para["sigma_uL"];
      }else{
        $sigma_u = $Para["sigma_uH"];
      }
      $results = $this->random_gen_model->generateRandomArrays($N, $V0, $sigma_v, $sigma_u, $sigma_e);
      $results["total_round"] = $total_round;
      $results["sigma_uH"] = $sigma_uH;
      if($type==0||$type==1){
        $results["mode"] = 0;
      }else{
        $results["mode"] = 1;
      }
      $results["type"] = $type;
      $results["voice_type"] = $Para["voice_type"];
      $results["loudness_mapping_type"] = $Para["loudness_mapping_type"];

      $this->load->view('includes/header.php',$para);
      $this->load->view('chart/show_echarts_example.php',$results);
      $this->load->view('includes/footer.php',$para);
    }


    public function myTest(){
      $this->load->model('random_gen_model');
      $user_state = $this->random_gen_model->get_test_num_left($_SESSION["username"]);
      $Para = $this->random_gen_model->getPara();
      if($user_state["test_num_left"]>0){
        $N = $Para["N"];
        $V0 = $Para["V0"];
        $sigma_v = $Para["sigma_v"];
        $dice = rand(0,1);
        $sound_bits = $Para["sound_bit"];
        $sound_bits_arr = str_split($sound_bits,1);
        $total_round = $Para["total_round"];

        $this_mode = 0;
        $bit_index = $total_round-$user_state["test_num_left"];
        if(isset($sound_bits_arr[$bit_index]))
        {
            $this_mode = $sound_bits_arr[$bit_index];
        }else{
            $this_mode = rand(0,2);
        }

        if($dice<=0.5){
          $sigma_u = $Para["sigma_uL"];
        }else{
          $sigma_u = $Para["sigma_uH"];
        }
        $sigma_e = $Para["sigma_e"];

        $this -> show_echarts($N,$V0,$sigma_v,$sigma_u,$sigma_e,$total_round,$Para["sigma_uH"],$this_mode);
      }else{
        $this->load->view('includes/header.php');
        $this->load->view('chart/test_finished.php',$user_state);
        //Generate Result Table
        $this->load->library('table');
        $user = $_SESSION['username'];
        $query = $this->db->query("SELECT `round_num`,`final_value`,`final_price`,`order`,`round_gain`,`best_order`,`best_gain` FROM `trading_record` WHERE `user`='$user'");
        $template = array(
            'table_open' => '<table border="0" cellpadding="2" cellspacing="1" class="mytable">'
         );
        $this->table->set_template($template);
        $this->table->set_heading('Round', 'Close Value', 'Close Price', 'Order Number','Round Gain','Best Order', 'Best Gain');
        $this->table->set_caption($_SESSION["username"]."'s Test Result");
        echo $this->table->generate($query);

        $this->load->view('includes/footer.php');
      }
    }

    public function seqTest(){
      //Sequence Test
        $this->load->model('random_gen_model');
        $user_state = $this->random_gen_model->get_test_num_left($_SESSION["username"]);
        $Para = $this->random_gen_model->getPara();
        if($user_state["test_num_left"]>0){
          $N = $Para["N"];
          $V0 = $Para["V0"];
          $sigma_v = $Para["sigma_v"];
          $dice = rand(0,1);
          $sound_bits = $Para["sound_bit"];
          $sound_bits_arr = str_split($sound_bits,1);
          $total_round = $Para["total_round"];
          $test_type = $Para["test_type"];
          $this_mode = rand(0,2);
          $bit_index = $total_round-$user_state["test_num_left"];
          if(isset($sound_bits_arr[$bit_index]))
          {
              $this_mode = $sound_bits_arr[$bit_index];
          }

          if($dice<=0.5){
            $sigma_u = $Para["sigma_uL"];
          }else{
            $sigma_u = $Para["sigma_uH"];
          }
          $sigma_e = $Para["sigma_e"];

          $this -> show_echarts($N,$V0,$sigma_v,$sigma_u,$sigma_e,$total_round,$Para["sigma_uH"],$this_mode,"Sequence");
        }else{
          redirect("test/intro2");
        }
    }

    public function seqTest_vol_first(){
      //Sequence Test
        $this->load->model('random_gen_model');
        $user_state = $this->random_gen_model->get_test_num_left($_SESSION["username"]);
        $Para = $this->random_gen_model->getPara();
        if($user_state["test_num_left"]>0){
          $N = $Para["N"];
          $V0 = $Para["V0"];
          $sigma_v = $Para["sigma_v"];
          $dice = rand(0,1);
          $sound_bits = $Para["sound_bit"];
          $sound_bits_arr = str_split($sound_bits,1);
          $total_round = $Para["total_round"];
          $test_type = $Para["test_type"];
          $this_mode = rand(0,2);
          $bit_index = $total_round-$user_state["test_num_left"];
          if(isset($sound_bits_arr[$bit_index]))
          {
              $this_mode = $sound_bits_arr[$bit_index];
          }

          if($dice<=0.5){
            $sigma_u = $Para["sigma_uL"];
          }else{
            $sigma_u = $Para["sigma_uH"];
          }
          $sigma_e = $Para["sigma_e"];

          $this -> show_echarts($N,$V0,$sigma_v,$sigma_u,$sigma_e,$total_round,$Para["sigma_uH"],$this_mode,"Sequence_vol_first");
        }else{
          redirect("test/intro2");
        }
    }

    public function jointTest(){
      //Joint test

        //Sequence Test
          $this->load->model('random_gen_model');
          $user_state = $this->random_gen_model->get_test_num_left($_SESSION["username"]);
          $Para = $this->random_gen_model->getPara();
          if($user_state["test_num_left"]>0){
            $N = $Para["N"];
            $V0 = $Para["V0"];
            $sigma_v = $Para["sigma_v"];
            $dice = rand(0,1);
            $sound_bits = $Para["sound_bit"];
            $sound_bits_arr = str_split($sound_bits,1);
            $total_round = $Para["total_round"];

            $this_mode = rand(0,2);
            $bit_index = $total_round-$user_state["test_num_left"];
            if(isset($sound_bits_arr[$bit_index]))
            {
                $this_mode = $sound_bits_arr[$bit_index];
            }

            if($dice<=0.5){
              $sigma_u = $Para["sigma_uL"];
            }else{
              $sigma_u = $Para["sigma_uH"];
            }
            $sigma_e = $Para["sigma_e"];

            $this -> show_echarts($N,$V0,$sigma_v,$sigma_u,$sigma_e,$total_round,$Para["sigma_uH"],$this_mode,"Joint");
          }else{
            redirect("test/intro2");
          }
    }

    public function show_final_result($test_type){
      //Generate Result Table
      $this->load->library('table');
      $user = $_SESSION['username'];
      /*
      if($test_type=="Sequence"){
        $query = $this->db->query("SELECT `round_num`,`q1_answer`,`q2_answer`,`q1`,`q2`,`round_bonus` FROM `trading_record` WHERE `user`='$user' AND `round_num`<>0");
        $template = array(
            'table_open' => '<table border="0" cellpadding="2" cellspacing="1" class="mytable">'
         );
        $this->table->set_template($template);
        $this->table->set_heading('Round', 'Your Answer(Q1)', 'Your Answer(Q2)', 'Right Answer(Q1)','Right Answer(Q2)','Round Bonus');
      }else{
        $query = $this->db->query("SELECT `round_num`,`q3_answer`,`q3`,`round_bonus` FROM `trading_record` WHERE `user`='$user' AND `round_num`<>0");
        $template = array(
            'table_open' => '<table border="0" cellpadding="2" cellspacing="1" class="mytable">'
         );
        $this->table->set_template($template);
        $this->table->set_heading('Round', 'Your Answer(Q3)', 'Right Answer(Q3)','Round Bonus');
      }
      */
      $this->table->set_caption($_SESSION["username"]."的测试结果<br />(标红的轮次为系统随机选取的付费轮次！)<br/>第一部分：交易测试");
      $query = $this->db->query("SELECT `round_num`,`round_bonus` FROM `trading_record` WHERE `user`='$user' AND `round_num`<>0");
      $template = array(
          'table_open' => '<table border="0" cellpadding="2" cellspacing="1" class="mytable">'
       );
       $this->table->set_template($template);
       $this->table->set_heading('轮次序号','单轮奖励（实验币）');
       echo $this->table->generate($query);
    }

    public function test_echarts(){
      $para =Array();
      $this->load->model('random_gen_model');
      $para =Array();
      $N = 20;
      $V0 = 50.0;
      $sigma_v = 5;
      $sigma_u = 10;
      $sigma_e = 5;
      $results = $this->random_gen_model->generateRandomArrays($N, $V0, $sigma_v, $sigma_u, $sigma_e);

      $this->load->view('chart/test_echarts.php',$results);

    }

    public function store_cog_exp1_data(){
       $data['test_id'] = $_SESSION["username"];
       $data['start_time'] = "";
       $data['end_time'] = "";
       $data['rec1'] = $_REQUEST["rec1"];
       $data['rec2'] = $_REQUEST["rec2"];
       $data['match'] = $_REQUEST["match"];
       $data['input'] = $_REQUEST["input"];
       $data['input_time'] = $_REQUEST["input_time"];
       $data['error'] = $_REQUEST["error"];
       $data['total_score'] = $_REQUEST["total_score"];
       $data['finish_flag'] = 1;

       $this->db->insert ( 'cog_exp1_result', $data );

    }


    public function store_data(){
        $this->load->model('random_gen_model');
        $user_state = $this->random_gen_model->get_test_num_left($_SESSION["username"]);

        $data['user'] = $_SESSION["username"];
        $data['round_num'] = $_SESSION["total_round"]-$user_state["test_num_left"];
        $data['user_round'] = $data['user']."_".$data['round_num'];
        $data['N'] = $_SESSION["N"];
        $data['V0']  = $_SESSION["V0"];
        $data['sigma_v']  = $_SESSION["sigma_v"];
        $data['sigma_u']  = $_SESSION["sigma_u"];
        $data['sigma_e']  = $_SESSION["sigma_e"];
        $data['order'] = 0;//$_REQUEST["order"];


        $data['final_value'] = floor(end($_SESSION["value"])*100)/100;

        $N = $_SESSION["N"];
        $VT_minu1 = $_SESSION["value"][$N-1];
        $results = $this->random_gen_model->generateFinalResult($data['final_value'],$VT_minu1,$_SESSION["sigma_v"],$_SESSION["sigma_u"],$_SESSION["sigma_e"],$data['order']);

        $data['final_price'] = floor($results["PT"]*100)/100;
        $data['final_volumn'] = floor($results["QT"]*100)/100;
        $data['round_gain'] = floor($results["round_gain"]*100)/100;
        $data['best_order'] = floor($results["best_order"]*100)/100;
        $data['best_gain'] = floor($results["best_gain"]*100)/100;
        $data['uT'] = floor($results["uT"]*100)/100;

        $_SESSION["price"][$N] = floor($data['final_price']*100)/100;
        $_SESSION["volumn"][$N] = floor($data['final_volumn']*100)/100;

        $data['value_series'] = json_encode($_SESSION["value"]);
        $data['price_series'] = json_encode($_SESSION["price"]);
        $data['volumn_series'] = json_encode($_SESSION["volumn"]);
        $data['datetime'] = date('Y-m-d H:i:s');

        $data['mode'] = $_SESSION["round_mode"];

        //$data['sound_bit'] = $_SESSION["round_mode"];

        $user_state["total_gain"] = $user_state["total_gain"] + $data['round_gain'];

        $data['total_gain'] = $user_state["total_gain"];


        $_SESSION["sigma_u"]==$_SESSION["sigma_uH"]?$q2=1:$q2=2;
        $data['best_order'] >= 0? $q1=1:$q1=2;

        $data['test_type'] = $_REQUEST["test_type"];
        $data['q1_answer'] = $_REQUEST["q1_answer"];
        $data['q2_answer'] = $_REQUEST["q2_answer"];
        $data['q3_answer'] = $_REQUEST["q3_answer"];

        $data['q1'] = $q1;
        $data['q2'] = $q2;
        $data['q3'] = 2*($q1-1) + $q2;

        $data['t0'] = $_REQUEST["t0"];
        $data['t1'] = $_REQUEST["t1"];
        $data['t2'] = date('Y-m-d H:i:s');

        if($data['test_type'] == "Sequence"){
          $data['round_bonus'] = 200 + 200*(1-abs($data['q1_answer']-$q1)) + 200*(1-abs($data['q2_answer']-$q2));
        }elseif($data['test_type'] == "Joint"){
          $data['round_bonus'] = 200 + 200*(1-abs(round($data['q3_answer']/1.999)-$q1)) + 200*(1-abs(($data['q3_answer']%2)-($q2%2)));
        }else{
          $data['round_bonus'] = 0;
        }

        $this->db->insert ( 'trading_record', $data );
        $this->random_gen_model->update_test_num_left($_SESSION["username"],$data['total_gain']);
        $json["round_gain"]=$data['round_gain'];
        $json["total_gain"]=$data['total_gain'];
        $json["best_order"]=$data['best_order'];
        $json["best_gain"]=$data['best_gain'];
        echo json_encode($json);
        return  json_encode($json);
     }

    public function rand_test(){
          for($i=0;$i<100;$i++){
            echo rand(0,1);
          }
    }

    public function intro2(){
      $this->load->view('intro2.php');
    }

    public function cog_exp1(){
      $this->load->model('test_model');

      if($this->test_model->checkExp1testFinished($_SESSION["username"])){
        $_SESSION["cog_exp1_finished"] = 1;
        $this->load->view('includes/header.php');
        $this->load->view('test/cog_exp1.php');
        $this->load->view('includes/footer.php');
      }else {
        $para =Array();
        $this->load->view('includes/header.php',$para);
        $this->load->view('test/cog_exp1.php');
        $this->load->view('includes/footer.php',$para);
      }

    }

    public function cog_exp2(){
      $this->load->model('test_model');

      if($this->test_model->checkExp2testFinished($_SESSION["username"])){
        $_SESSION["cog_exp2_finished"] = 1;
        $this->load->view('includes/header.php');
        $this->load->view('test/cog_exp2.php');
        $this->load->view('includes/footer.php');
      }else{
        $this->setupExp2Question();
      }
    }

    public function process_cog_exp2(){
       $this->processExp2Result();
       redirect("test/cog_exp2");
    }

    public function cog_exp3(){
      $para =Array();
      $this->load->model('test_model');
      if(empty($_SESSION["username"])){
        $this->load->helper('url');
        redirect("./login");
      }
      if($this->test_model->checkExp3testFinished($_SESSION["username"])){
        $_SESSION["cog_exp3_finished"] = 1;
        $this->load->view('test/cog_exp3.php');
        $this->load->view('includes/footer.php',$para);
      }else{
        $this->setupExp3Question();
      }
    }

    public function process_cog_exp3(){
       $this->processExp3Result();
       redirect("test/cog_exp3");
    }

    public function cog_exp4(){
      $para =Array();
      $this->load->model('test_model');
      if(empty($_SESSION["username"])){
        $this->load->helper('url');
        redirect("./login");
      }
      if($this->test_model->checkExp4testFinished($_SESSION["username"])){
        $_SESSION["cog_exp4_finished"] = 1;
        $this->load->view('test/cog_exp4.php');
        $this->load->view('includes/footer.php',$para);
      }else{
        $this->setupExp4Question();
      }
    }

    public function background(){
      $para =Array();
      $this->load->model('test_model');
      if(empty($_SESSION["username"])){
        $this->load->helper('url');
        redirect("./login");
      }
      if($this->test_model->checkBackgroundFinished($_SESSION["username"])){
        $_SESSION["background_finished"] = 1;
        $this->load->view('test/background.php');
        $this->load->view('includes/footer.php',$para);
      }else{
        $this->setupBackgroundQuestion();
      }
    }

    public function process_cog_exp4(){
       $this->processExp4Result();
       redirect("test/cog_exp4");
    }

    public function process_background(){
       $this->processBackgroundResult();
       redirect("test/background");
    }

    public function setupExp2Question(){
        $this->load->view('includes/header.php');
        $this->load->view('test/cog_exp2.php');
        $this->load->view('includes/footer.php');
        $id = $_SESSION["username"];
        $time = time();
        $start_time = date('Y-m-d H:i:s');
        $_SESSION["start_time"]=$time;
        $query0 = "insert into cog_exp2_result(test_id,start_time)
                    Values('$id','$start_time')
                    on DUPLICATE KEY
                    UPDATE
                    start_time = values(start_time)";
        $this->db->query($query0);
    }

    public function setupExp3Question(){
        $this->load->model('test_model');
        $para["questions"] = $this->test_model->readquestions();

        $this->load->view('includes/header.php',$para);
        $this->load->view ('test/cog_exp3.php',$para);
        $this->load->view('includes/footer.php',$para);

        $content = json_encode($para['questions']);
        $id = $_SESSION["username"];
        $time = time();
        $start_time = date('Y-m-d H:i:s');
        $_SESSION["start_time"]=$time;
        $query0 = "insert into cog_exp3_result(test_id,start_time,test_content)
                    Values('$id','$start_time','$content')
                    on DUPLICATE KEY
                    UPDATE
                    start_time = values(start_time),
                    test_content = values(test_content)";
        $this->db->query($query0);
    }

    public function processExp2Result(){
        $word_num=12;
        $test_answer=array();
        $test_content=array("3118","8418","5565","1904","6446","8056","7534","5450","4098","6809");
        for($i=0;$i<$word_num;$i++){
          $j = $i+1;
          array_push($test_answer,$_REQUEST["a$j"]);
        }
        $test_intersect=array_intersect($test_content,$test_answer);
        $score = count($test_intersect);
        $id = $_SESSION["username"];
        $test_answer_json =  json_encode($test_answer, JSON_UNESCAPED_UNICODE);
        $test_content_json = json_encode($test_content, JSON_UNESCAPED_UNICODE);
        $end_time = date('Y-m-d H:i:s');
        $query1 = "update `cog_exp2_result` SET
                    `end_time` = '$end_time',
                    `test_answer` = '$test_answer_json',
                    `test_content` = '$test_content_json',
                    `score` = $score
                    ,
                    `finish_flag` = 1
                    WHERE `test_id` = '$id'";
        $this->db->query($query1);
        $para["total_question_num"] = $i;
        return $para;
    }

    public function processExp3Result(){
        $para["right_ans"] = $_SESSION["ans"];
        $para["total_question_num"] = strlen($para["right_ans"]);
        $right_num=0;
        $test_answer="";
        for($i=0;$i<strlen($para["right_ans"]);$i++){
          $j = $i+1;
          if($_REQUEST["q$j"]==substr($para["right_ans"],$i,1))$right_num++;
          $test_answer.=$_REQUEST["q$j"];
        }
        $right_ans = $para["right_ans"];
        $id = $_SESSION["username"];
        $end_time = date('Y-m-d H:i:s');
        $query1 = "update `cog_exp3_result` SET
                    `end_time` = '$end_time',
                    `test_answer` = '$test_answer',
                    `right_answer` = '$right_ans',
                    `total_question_num` = $i,
                    `right_num` = $right_num,
                    `finish_flag` = 1
                    WHERE `test_id` = '$id'";
        $this->db->query($query1);
        echo $query1;
        $para["total_question_num"] = $i;
        return $para;
    }

    public function setupExp4Question(){
        $id = $_SESSION["username"];
        $para = array();
        $this->load->view('test/cog_exp4.php');
        $this->load->view('includes/footer.php',$para);
        $start_time = date('Y-m-d H:i:s');
        $query0 = "insert into cog_exp4_result(test_id,start_time)
                    Values('$id','$start_time')
                    on DUPLICATE KEY
                    UPDATE
                    start_time = values(start_time)";
        $this->db->query($query0);
    }

    public function processExp4Result(){
        $para["total_question_num"] = 10;
        $id = $_SESSION["username"];
        $test_answer="";
        $start_time = $_SESSION["cog_exp4_start_time"];
        for($i=0;$i<$para["total_question_num"];$i++){
          $j = $i+1;
          $test_answer.=$_REQUEST["q$j"];
        }
        $end_time = date('Y-m-d H:i:s');
        $query1 = "update `cog_exp4_result` SET
                          `end_time` = '$end_time',
                          `test_answer` = '$test_answer',
                          `total_question_num` = 10,
                          `finish_flag` = 1
                          WHERE `test_id` = '$id'";
        $this->db->query($query1);
        echo $query1;
        $para["total_question_num"] = $i;
        return $para;
    }

    public function setupBackgroundQuestion(){
        $id = $_SESSION["username"];
        $para = array();
        $this->load->view('test/background.php');
        $this->load->view('includes/footer.php',$para);

        $query0 = "insert into background_result(test_id)
                    Values('$id')
                    on DUPLICATE KEY
                    UPDATE
                    test_id = values(test_id)";
        $this->db->query($query0);
    }

    public function processBackgroundResult(){
        $id = $_SESSION["username"];
        print_r($_SESSION);
        $q1 = $_REQUEST["q1"];
        $q2 = $_REQUEST["q2"];
        $q3 = $_REQUEST["q3"];
        $q4_1 = $_REQUEST["q4_1"];
        $q4_2 = $_REQUEST["q4_2"];
        $q5 = $_REQUEST["q5"];
        $q6 = $_REQUEST["q6"];
        $q7 = $_REQUEST["q7"];
        $q8 = $_REQUEST["q8"];

        $query1 = "update `background_result` SET
                          `q1` = '$q1',
                          `q2` = '$q2',
                          `q3` = '$q3',
                          `q4_1` = '$q4_1',
                          `q4_2` = '$q4_2',
                          `q5` = '$q5',
                          `q6` = '$q6',
                          `q7` = '$q7',
                          `q8` = '$q8',
                          `finish_flag` = 1
                          WHERE `test_id` = '$id'";
        $this->db->query($query1);
        $para["total_question_num"] = $i;
        return $para;
    }


    public function final_result(){
      $this->checkLogin();
      $this->load->model('test_model');
      $para = array();
      $id = $_SESSION["username"];
      $para["id"]=$id;
      $rand= substr(base_convert(md5($id),16,10),0,6);
      $para["rand"]=$rand;
      $this->load->view('includes/header_overflow.php',$para);
      //$this->show_final_result($_SESSION["test_type"]);
      $this->show_final_result("trade");
      $para = $this->test_model->getAllResult($id);
      $this->load->view ('test/final_result.php',$para);
      $this->load->view('includes/footer.php',$para);
      //Store Bonus Result
      $trade_bonus_round = $rand%31;
      $cog_bonus_round = $rand%4;
      if(isset($_SESSION["test_type"])){
        $trade_type = $_SESSION["test_type"];
      }else{
        $trade_type = "";
      }
      $query0 = "Select `round_bonus` FROM `trading_record` WHERE `id` = '$id' and `round_num`='$trade_bonus_round'";
      $result = $this->db->query($query0)->result();
      if(isset($result[0])){
        $trade_bonus = $result[0]->round_bonus;
      }else{
        $trade_bonus=0;
      }
      $cog_bonus=100;
      if($cog_bonus_round==1){
        $cog_bonus= $para["score1"]*10;
      }
      if($cog_bonus_round==2){
        $cog_bonus= $para["score2"]*10;
      }
      if($cog_bonus_round==3){
        $cog_bonus= $para["score3"]*10;
      }
      $total_bonus = $trade_bonus + $cog_bonus;
      $query1 = "update `bonus_result` SET
                        `trade_type` = '$trade_type',
                        `trade_bonus_round` = '$trade_bonus_round',
                        `trade_bonus` = '$trade_bonus',
                        `cog_bonus_round` = '$cog_bonus_round',
                        `cog_bonus` = '$cog_bonus',
                        `total_bonus` = '$total_bonus'
                        WHERE `id` = '$id'";
      $this->db->query($query1);
    }


    public function get_sys_time(){
      echo date('Y-m-d H:i:s');
    }
}


?>
