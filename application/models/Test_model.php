<?php
class Test_model extends CI_Model {

    public function readquestions(){
      $query = "SELECT * FROM `trading_game2`.`cog_exp3_question`";
      $questions = $this->db->query($query)->result();
      return $questions;
    }

    public function checkExp1testFinished($id){
      $flag=0;
      $query = "SELECT `finish_flag` FROM `trading_game2`.`cog_exp1_result` WHERE `test_id` = '$id'";
      $questions = $this->db->query($query)->result();
      if(isset($questions[0])){
        $flag = $questions[0]->finish_flag;
      }
      return $flag;
    }

    public function checkExp2testFinished($id){
      $flag=0;
      $query = "SELECT `finish_flag` FROM `trading_game2`.`cog_exp2_result` WHERE `test_id` = '$id'";
      $questions = $this->db->query($query)->result();
      if(isset($questions[0])){
        $flag = $questions[0]->finish_flag;
      }
      return $flag;
    }

    public function checkExp3testFinished($id){
      $flag=0;
      $query = "SELECT `finish_flag` FROM `trading_game2`.`cog_exp3_result` WHERE `test_id` = '$id'";
      $questions = $this->db->query($query)->result();
      if(isset($questions[0])){
        $flag = $questions[0]->finish_flag;
      }
      return $flag;
    }

    public function checkExp4testFinished($id){
      $flag=0;
      $query = "SELECT `finish_flag` FROM `trading_game2`.`cog_exp4_result` WHERE `test_id` = '$id'";
      $questions = $this->db->query($query)->result();
      if(isset($questions[0])){
        $flag = $questions[0]->finish_flag;
      }
      return $flag;
    }

    public function checkBackgroundFinished($id){
      $flag=0;
      $query = "SELECT `finish_flag` FROM `trading_game2`.`background_result` WHERE `test_id` = '$id'";
      $questions = $this->db->query($query)->result();
      if(isset($questions[0])){
        $flag = $questions[0]->finish_flag;
      }
      return $flag;
    }

    public function saveResult($para){

    }

    public function getAllResult($id){
      $query = "SELECT `total_score`,`finish_flag` FROM `trading_game2`.`cog_exp1_result` WHERE `test_id` = '$id'";
      $questions = $this->db->query($query)->result();
      if(isset($questions[0])&&$questions[0]->finish_flag==1){
        $results["score1"] = $questions[0]->total_score;
      }else{
        $results["score1"] = 0;
      }

      $query = "SELECT `score`,`finish_flag` FROM `trading_game2`.`cog_exp2_result` WHERE `test_id` = '$id'";
      $questions = $this->db->query($query)->result();
      if(isset($questions[0])&&$questions[0]->finish_flag==1){
        $results["score2"] = $questions[0]->score;
      }else{
        $results["score2"] = 0;
      }

      $query = "SELECT `right_num`,`finish_flag` FROM `trading_game2`.`cog_exp3_result` WHERE `test_id` = '$id'";
      $questions = $this->db->query($query)->result();
      if(isset($questions[0])&&$questions[0]->finish_flag==1){
        $results["score3"] = $questions[0]->right_num;
      }else{
        $results["score3"] = 0;
      }

      $query = "SELECT `finish_flag` FROM `trading_game2`.`cog_exp4_result` WHERE `test_id` = '$id'";
      $questions = $this->db->query($query)->result();
      if(isset($questions[0])){
        $results["score4"] = $questions[0]->finish_flag * 100;
      }else{
        $results["score4"] = 0;
      }

      return $results;
    }
}
