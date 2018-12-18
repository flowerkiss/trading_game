<div id="content_title" style="width:800px;text-align:left;margin:50px auto;">
  <h1 style="color:#FFF">第二组</h1>
  <h3 style="color:#FFF"> 这一组需要您先用2分钟记忆一些四位数，再在2分钟内回忆这些数字（按任意顺序）。如果最后抽中这一组，您每填对一个四位数，可获得10单位实验币。在这个测试中，请不要使用纸笔、手机、电脑等记录工具</div>


<div id="exp_area" style="margin:0px auto;width:350px;height:200px;">
  <div id="orginial_table" style="display:none;">
    <table border="1">
      <tr>
        <td>3118</td>
        <td>8418</td>
      </tr>
      <tr>
        <td>5565</td>
        <td>1904</td>
      </tr>
      <tr>
        <td>6446</td>
        <td>8056</td>
      </tr>
      <tr>
        <td>7534</td>
        <td>5450</td>
      </tr>
      <tr>
        <td>4098</td>
        <td>6809</td>
      </tr>
      <!--
      <tr>
        <td>帽子</td>
        <td>橘子</td>
      </tr>
    -->
    </table>
</div>

<div id="input_table" style="display:none;">
  <form action="process_cog_exp2" method="post">
  <table border="1">
    <tr>
      <td><input name="a1" type="text" /></td>
      <td><input name="a2" type="text" /></td>
    </tr>
    <tr>
      <td><input name="a3" type="text" /></td>
      <td><input name="a4" type="text" /></td>
    </tr>
    <tr>
      <td><input name="a5" type="text" /></td>
      <td><input name="a6" type="text" /></td>
    </tr>
    <tr>
      <td><input name="a7" type="text" /></td>
      <td><input name="a8" type="text" /></td>
    </tr>
    <tr>
      <td><input name="a9" type="text" /></td>
      <td><input name="a10" type="text" /></td>
    </tr>

    <tr style="display:none;">
      <td><input name="a11" type="text" /></td>
      <td><input name="a12" type="text" /></td>
    </tr>
  </table>
</div>
<div id="submit_answer"  style="display:none;">
  <input  type="submit" name="submit" value="提交"/>
</div>
</form>
</div>

<div id="start" style="width:500px;margin:20px auto;text-align:center">
  <?php if(!isset($_SESSION["cog_exp2_finished"])||$_SESSION["cog_exp2_finished"]==0):?>
   <div id="start_test" style="">
     <button>开始测试</button>
   </div>
   <div style="text-align:center;width:150px;color:#FFF;margin:0px auto;">剩余时间：
     <div id="timers" style="float:right;font-size:25px;margin:0px auto;background-color: #4A374A;text-align: center;width:50px;height:20px;color:#FFF;display:block">120</div>
   </div>
 <?php else:?>
   <div id="next_test" style="">
     <button><a href="cog_exp3" style="text-decoration:none;color:#FFF">下一步</a></button>
   </div>
 <?php endif;?>
</div>

<script>
var time_interval=1000;
var test_finished=0;
function timedCount()  {
    var tim=document.getElementById("timers");
    var time=parseInt(tim.innerHTML);
    document.getElementById("timers").innerHTML = time;

    startTime = new Date().getTime();
    endTime = startTime;
    if( t !=null && time==0){
      clearTimeout(t);
      if(test_finished==0){
        $("#orginial_table").html("");
        $("#input_table").show();
        test_finished = 1;
        $("#timers").html("120");
        $("#submit_answer").show();
        timedCount();
      }else{
        $("input[type=submit]").click;
        alert("时间到！已自动提交");
      }
      return;
    }
    time--;
    tim.innerHTML = time;
    t=setTimeout("timedCount()",1000)
}

function process_input(){

}


$(document).ready(function(){
   $("#start_test").click(function(){
     $("#start_test").hide();
     t=setTimeout("timedCount()",time_interval);
     $("#orginial_table").show();
   });

   $("#submit_answer").click(function(){
     $(this).hide();
     setTimeout("$('#next_test').show();",1000);
   });
});

</script>
