<?php
class Admin_model extends CI_Model {

    public function readInitConfig(){
      $query = $this->db->get_where('config', array (
        'config_type' => "init_para"
      ), 1, 0 );
      $result = $query->result();
      if (is_object($result[0])) {
            $arr = (array)($result[0]);
      }else {
            $arr = &$result[0];
      }
      return $arr;
    }

    public function saveConfig($para){
      $total_round = $para["total_round"];
      $N = $para["N"];
      $V0 = $para["V0"];
      $sigma_v = $para["sigma_v"];
      $sigma_uL = $para["sigma_uL"];
      $sigma_uH = $para["sigma_uH"];
      $sigma_e = $para["sigma_e"];
      $sound_bit = $para["sound_bit"];
      $test_type = $para["test_type"];
      $voice_type = $para["voice_type"];
      $loudness_mapping_type = $para["loudness_mapping_type"];

      $query = "UPDATE `config` SET `total_round` = $total_round,
                                    `N` = $N,
                                    `V0` = $V0,
                                    `sigma_v` = $sigma_v,
                                    `sigma_uL` = $sigma_uL,
                                    `sigma_uH` = $sigma_uH,
                                    `sigma_e` = $sigma_e,
                                    `sound_bit` = '$sound_bit',
                                    `test_type` = '$test_type',
                                    `voice_type` = '$voice_type',
                                    `loudness_mapping_type` = '$loudness_mapping_type'
                WHERE `config_type`='init_para'";//3.7->3.8新增

      $query2 = "UPDATE `trading_test_user` SET
                        `test_num_left` = $total_round,
                        `total_gain` = 0
                         WHERE `user` = 'admin'";

      $query3 = "DELETE FROM `trading_record` WHERE `user` = 'admin';";

      $this->db->query($query);
      $this->db->query($query2);
      $this->db->query($query3);
    }

}
