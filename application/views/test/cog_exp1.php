<div id="content_title" style="width:800px;text-align:left;margin:50px auto;">
  <h1 style="color:#FFF">第一组</h1>
  <h3 style="color:#FFF"> 需要您对颜色的变化做出反应。<br/>下面两个正方形，将随机变化颜色，请您在颜色相同时点击空格键。如果最后抽中这一组题目，将随机抽取10次颜色变化时您的判断计算这一组的收益，每次判断正确可获得10个实验币。</h3>
</div>

<?php if(!isset($_SESSION["cog_exp1_finished"])||$_SESSION["cog_exp1_finished"]==0):?>

<div id="exp_area" style="margin:0px auto;width:350px;height:200px;">
  <span id="rec1" style="background-color:red;width:150px;height:150px;float:left"></span>
  <span id="rec2" style="background-color:blue;width:150px;height:150px;margin-left:50px;float:left"></span>
</div>
<div style="text-align:center;width:150px;color:#FFF;margin:0px auto;">剩余轮次：
  <div id="timers" style="float:right;font-size:25px;margin:0px auto;background-color: #4A374A;text-align: center;width:50px;height:20px;color:#FFF;display:block">20</div><!--Trial Num -->
</div>
<div id="start" style="width:500px;margin:20px auto;text-align:center">
   <div id="start_trial">
     <button>开始练习（20轮）</button>
   </div>
   <div id="start_test" style="display:none;">
     <button>开始测试（180轮）</button>
   </div>
   <h3 style="color:#FFF">颜色相同时迅速按下空格键</h3>

   <div id="next_test" style="display:none;text-align:center;margin:0px auto;">
     <button>下一步</button>
   </div>
 <?php else:?>
   <div id="next_test" style="text-align:center;margin:0px auto;">
     <button>下一步</button>
   </div>
 <?php endif;?>

</div>

<script>
var ROUND_NUM = 180;
var t;
var time_interval = 1000;
var string = "red,blue,green,yellow,purple,white";
var color_options = string.split(",");
var rec1 = "red";
var rec2 = "blue";
var rec1_arr = new Array();
var rec2_arr = new Array();
var match_arr = new Array();
var input_arr = new Array();
var input_time_arr = new Array();
var error_arr = new Array();

var input = 0;
var startTime = new Date().getTime();
var endTime =0;
var test_finished = 0;
var key_free_flag = 0;
var macth = 0
var total_score = 0

function array_sum(arra){
  var result = 0;
  for(var i = 0; i < arra.length; i++) {
        result += arra[i];
  }
  return result
  ;
}

function timedCount()  {
    var tim=document.getElementById("timers");
    var time=parseInt(tim.innerHTML);
    document.getElementById("timers").innerHTML = time;
    rec1 = color_options[Math.round(Math.random()*(color_options.length-1))];  //随机抽取一个值
    rec2 = color_options[Math.round(Math.random()*(color_options.length-1))];  //随机抽取一个值

    rec1_arr.push(rec1);
    rec2_arr.push(rec2);
    if(rec1==rec2){
      setTimeout("process_input(1);",0.95*time_interval);
    }else{
      setTimeout("process_input(0);",0.95*time_interval);
    }
    if(time!=0){
      $("#rec1").css("background-color",rec1);
      $("#rec2").css("background-color",rec2);
    }else{
      $("#rec1").hide();
      $("#rec2").hide();
    }

    startTime = new Date().getTime();
    endTime = startTime;
    if( t !=null && time==0){
      clearTimeout(t);
      if(test_finished==0){
        rec1_arr = new Array();
        rec2_arr = new Array();
        match_arr = new Array();
        input_arr = new Array();
        input_time_arr = new Array();
        error_arr = new Array();
        $("#timers").text(ROUND_NUM);
        $("#start_test").show();
        test_finished = 1;
      }else{
        $("#next_test").show();
        var rec1_json = JSON.stringify(rec1_arr);
        var rec2_json = JSON.stringify(rec2_arr);
        var match_json = JSON.stringify(match_arr);
        var input_json = JSON.stringify(input_arr);
        var input_time_json = JSON.stringify(input_time_arr);
        var error_json = JSON.stringify(error_arr);
        total_score = array_sum(match_arr) - array_sum(error_arr);

        $.ajax({
             type: "POST",
             url: "../test/store_cog_exp1_data",
             data: {
                      "start_time":"",
                      "end_time" : "",
                      "rec1" : rec1_json,
                      "rec2" : rec2_json,
                      "match": match_json,
                      "input" : input_json,
                      "input_time" :input_time_json,
                      "error" : error_json,
                      "total_score" : total_score
                   },
             success: function (data) {
                alert("结果上传成功！");
             },
             error: function (msg) {
                 alert("load error! or Invalid User!");
             }
         });
      }

      return;
    }
    time--;
    tim.innerHTML = time;
    t=setTimeout("timedCount()",1000)
}

function process_input(match){
  var time_spend = endTime - startTime;
  input_arr.push(input);
  input_time_arr.push(time_spend);
  match_arr.push(match);
  if(input!=match){
    error_arr.push(1);
  }else{
    error_arr.push(0);
  }
  input=0;
  key_free_flag = 0;
}

$(document).ready(function(){
  $(document).keydown(function(e){
      if(!e) var e = window.event;
      if(e.keyCode==32&&key_free_flag==0){
          input = 1;//在这里写要改变的东西
          key_free_flag = 1;
          endTime = new Date().getTime();
      }
   });

   $("#start_trial").click(function(){
     $("#start_trial").hide();
     t=setTimeout("timedCount()",time_interval);
   });


   $("#start_test").click(function(){
     $("#start_test").hide();
     setTimeout("$('#rec1').show();$('#rec2').show()",200);
     t=setTimeout("timedCount()",time_interval);
   });

   $("#next_test").click(function(){
     location.href = "cog_exp2";
   });
});

</script>
