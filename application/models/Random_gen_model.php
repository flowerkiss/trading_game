<?php
class Random_gen_model extends CI_Model {
    public function generateGaussianNoise($mu, $sigma){
        $TWO_PI = 2.0 * 3.14159265358979323846;
        $EPSILON = 0.000000000000000000000001;

        $RAND_MAX = getrandmax();

        /*
        static double $z0, $z1;
        static bool $generate;
        $generate = !$generate;

        if(!$generate)
            return $z1 * $sigma + $mu;
        */

        do {
            $u1 = rand() * (1.0/$RAND_MAX);
            $u2 = rand() * (1.0/$RAND_MAX);
        } while ( $u1 <= $EPSILON);

        $z0 = sqrt(-2.0 * log($u1)) * cos($TWO_PI * $u2);
        $z1 = sqrt(-2.0 * log($u1)) * cos($TWO_PI * $u2);

        return $z0 * $sigma + $mu;
    }

    public function generateRandomArrays($N, $V0, $sigma_v, $sigma_u, $sigma_e){
        $lamda = $sigma_v/2/$sigma_u;
        $beta = $sigma_u/$sigma_v;
        for($i=0; $i<$N; $i++){
          $v = $this->generateGaussianNoise(0, $sigma_v);
          $u = $this->generateGaussianNoise(0, $sigma_u);
          $e = $this->generateGaussianNoise(0, $sigma_e);
          if($i == 0){
            $V = $V0 + $v;
            $P = $V0 + $lamda*($beta*$v + $u);
            $Q = abs($beta*$v + $u + $e);
          }else{
            $V = $V + $v;
            $P = $V + $lamda*($beta*$v + $u);
            $Q = abs($beta*$v + $u + $e);
          }
          $result["Value"][$i] = $V;
          $result["Price"][$i] = $P;
          $result["Volumn"][$i] = $Q;
        }
        $result["Value"][$i] = $V + $this->generateGaussianNoise(0, $sigma_v);
        $result["V0"] = $V0;
        $result["N"] = $N;
        $result["sigma_v"] = $sigma_v;
        $result["sigma_u"] = $sigma_u;
        $result["sigma_e"] = $sigma_e;
        return $result;
    }

    public function generateFinalResult($VT,$VT_minu1, $sigma_v,$sigma_u, $sigma_e, $order){
        $lamda = $sigma_v/2/$sigma_u;
        $uT = $this->generateGaussianNoise(0, $sigma_u);
        $eT = $this->generateGaussianNoise(0, $sigma_e);
        $results["lamda"] = $lamda;
        $results["uT"] = $uT;
        $results["PT"] = $VT_minu1 + $lamda*($order + $uT);
        $results["QT"] = abs($order + $uT + $eT);
        $results["round_gain"] = $order * ($VT - $results["PT"]);
        $results["best_order"] = ($VT - $VT_minu1 - $lamda*$uT)/(2*$lamda);
        $results["best_gain"] = $results["best_order"]*($VT - $VT_minu1 - $lamda *($results["best_order"] + $uT));
        return $results;
    }

    public function get_test_num_left($user){
        if(isset($user)){
          $query = $this->db->get_where ( 'trading_test_user', array (
            'user' => $user
          ), 1, 0 );
          $result = $query->result();
          if(!isset($result[0])){
              $result[0]->test_num_left = 0;
          }
          $arr["test_num_left"] = $result[0]->test_num_left;
          $arr["total_gain"] = $result[0]->total_gain;
          return $arr;
        }
    }

    public function update_test_num_left($user, $total_gain){
        $userstate = $this->get_test_num_left($user);
        $recent_num = $userstate["test_num_left"];
        if($recent_num>0){
          $recent_num = $recent_num - 1;
          $query = "UPDATE `trading_test_user` SET `test_num_left` = $recent_num, `total_gain` = $total_gain WHERE `user`='$user'";
          $this->db->query($query);
        }
    }

    public function getPara(){
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
}

?>
