<?php
$_SESSION["total_round"] = $total_round;
$_SESSION["value"] = $Value;
$_SESSION["price"] = $Price;
$_SESSION["volumn"] = $Volumn;
$_SESSION["V0"] = $V0;
$_SESSION["N"] = $N;
$_SESSION["sigma_v"] = $sigma_v;
$_SESSION["sigma_u"] = $sigma_u;
$_SESSION["sigma_e"] = $sigma_e;
$_SESSION["sigma_uH"] = $sigma_uH;
$_SESSION["round_mode"] = $mode;

?>

<?php if($_SESSION["username"]=="admin"):?>
    <button style="position:absolute;"><a href="../admin" style="text-decoration:none">Back to admin console</a></button>
<?php endif;?>
 <div id="container">
   <div id="cover" style=""></div>
   <div id="cover2" style="top:100px;"></div>
   <div id="cover3" style=""></div>

   <div id="tester_info"><h1> <?php echo $_SESSION["username"];?>的交易测试</h1></div>
   <?php if(($total_round-$test_num_left)==0):?>
     <h3 style="text-align:center;margin:15px auto">练习1轮:</h3>
   <?php else :?>
   <h3 style="text-align:center;margin:15px auto">轮次: <?php echo $total_round-$test_num_left;?>/<?php echo $total_round-1; ?></h3>
   <?php endif;?>
    <div id="valueChart" style="position: absolute;top: 50px;width:800px;height:400px;"></div>
    <!--<div id="priceChart" style="position: absolute;top: 200px;width:800px;height:200px;"></div>-->
    <div id="volumnChart" style="position: absolute;top: 350px;width:800px;height:200px;"></div>

    <div id="value_label" style="display:none;width: 100px;position: absolute;top: 125px;left: 900px;">In Period <?php echo count($Value);?> Value is <?php echo floor(end($Value)*100)/100;?> </div>
    <div id="price_label" style="display:none;width: 100px;position: absolute;top: 275px;left: 900px;">In Period <?php echo count($Price);?> Price is <?php echo floor(end($Price)*100)/100;?> </div>
    <div id="volumn_label" style="display:none;width: 100px;position: absolute;top: 425px;left: 900px;">In Period <?php echo count($Volumn);?> Volumn is <?php echo floor(end($Volumn));?> </div>

    <div id="round_gain" style="width: 150px;position: absolute;top: 200px;left: 980px;"></div>

    <div id="best_gain" style="display:none; width: 400px;position: absolute;top: 200px;left: 1000px;">
      <label>下一期您想：</label> <br />
      <input type="radio" name="q3" value="1" />买很多
      <input type="radio" name="q3" value="2" />买一点 <br />
      <input type="radio" name="q3" value="3" />卖很多
      <input type="radio" name="q3" value="4" />卖一点 <br />

      <button type="button" id="q3_btn" name="q3_btn" value="confirm" style="margin-top:25px;">提交
    </div>

    <div id="total_gain" style="display:none;width: 150px;position: absolute;top: 400px;left: 900px;"></div>
<!--
    <div id="Question" style="display:none;position: absolute;top: 550px;left:185px;font-size:18px">
      <form style="margin-top: 300px; margin-left: 1000px;">
        <input name="next" type="submit" style="display:none" value="Next Round!"/>
     </form>
-->
    <div>
      <form style="position:absolute;top: 500px; margin-left: 868px;">
        <input type="hidden" name="t0" value="<?php echo date('Y-m-d H:i:s');?>"/>
        <input type="hidden" name="t1" value="<?php echo date('Y-m-d H:i:s');?>"/>

        <?php if(($total_round-$test_num_left)==0):?>
        <button id="start_test" style="display:none;"><a href="rule_desp" style="color:#FFF;text-decoration:none;">下一步!</a></button>
         <?php else:?>
         <input name="next" type="submit" style="display:none" value="下一轮">
       <?php endif;?>
     </form>
        <div id="show_num" style="margin-top:10px;text-align:right"></div>
        <!--<label style="float:right">seconds till order finalizes!</label>-->
        <div class="timerShowContainer" id="timers" style="display:none;float:right;margin-right:5px;color:red;font-weight:bold">15</div>
    </div>
    <div class="timerShowContainer" id="timers2" style="display:none">21</div>
    <div class="timerShowContainer" id="volumn_level" style="display:none"></div>

    <audio id="bgAudio" style="display:none" autoplay loop>
       <source src="../../public/mp3/electricity.mp3" type="audio/mp3" />
       Your browser does not support the <audio> element.
   </audio>
 </div>

<script>

var delay_sec = 20000;
var t=setTimeout("timedCount()",delay_sec);
var t2;
setTimeout("$('#best_gain').show();",2*delay_sec+2000);
document.getElementById("bgAudio").volume = 0;

var N = <?php echo $N;?>;
//var t=setTimeout("timedCount()",100);

function timedCount()  {
  //document.getElementById("value_label").style.display = "block";
  //document.getElementById("price_label").style.display = "block";
  //document.getElementById("volumn_label").style.display = "block";
  //document.getElementById("Question").style.display = "block";
    var tim=document.getElementById("timers");
    var time=parseInt(tim.innerHTML);
    document.getElementById("timers").innerHTML = time;
    if( t !=null && time==0){
      clearTimeout(t);
      $("input[name=order_num]").val(0);
      $("input[name=submit]").click();
      return;
    }
    time--;
    tim.innerHTML = time;
    t=setTimeout("timedCount()",1000)
    //t=setTimeout("timedCount()",200);
}

var value = new Array();
var price = new Array();
var volumn = new Array();
var index = new Array();
var sigma_uH = <?php echo $sigma_uH;?>;
var total_round = <?php echo $total_round;?>;
var round_mode = <?php echo $_SESSION["round_mode"];?>;
var voice_level = 0;
document.getElementById("bgAudio").volume = 0;
var voice_coef = 3;
<?php foreach($Value as $k => $v): ?>
  value.push(<?php echo floor($v*100)/100; ?>);
  index.push(<?php echo $k+1; ?>)
<?php endforeach; ?>

<?php foreach($Price as $k => $v): ?>
  price.push(<?php echo floor($v*100)/100; ?>);
<?php endforeach; ?>

<?php foreach($Volumn as $k => $v): ?>
  volumn.push(<?php echo floor($v); ?>);
<?php endforeach; ?>

var series_index = 0;

function timedCount2()  {
    var tim=document.getElementById("timers2");
    var time=parseInt(tim.innerHTML);
    var vol = volumn[series_index];
    if(vol<1.01)vol=1.01;
    //voice_level = Math.log(vol)/Math.log(voice_coef*sigma_uH);
    //voice_level = Math.min(1,Math.log(1+vol/(voice_coef*sigma_uH)));
    voice_level = Math.min(1, vol/(voice_coef*sigma_uH));


    document.getElementById("timers2").innerHTML = time;
    if( t !=null && time==0){
      clearTimeout(t2);
      return;
    }
    time--;
    tim.innerHTML = time;
    //t=setTimeout("timedCount2()",1000);

    if(round_mode == "0"){
      document.getElementById("bgAudio").volume = 0;
    }else{
      if(series_index < N){
           document.getElementById("bgAudio").volume = voice_level;
          // alert(N + ":" +series_index+":"+time);
      }else{
           document.getElementById("bgAudio").volume = 0;
           //alert("fadsf"+series_index);

      }
      if(round_mode == "1"){
        $("#volumnChart").hide();
      }
    }
    document.getElementById("volumn_level").innerHTML = voice_level;
    series_index++;
}

var ctx_value = echarts.init(document.getElementById('valueChart'));
//var ctx_price = echarts.init(document.getElementById('priceChart'));
var ctx_volumn = echarts.init(document.getElementById('volumnChart'));

var option_value = {
    tooltip: {
        trigger: 'axis',
    },
    xAxis:  {
        type: 'category',
        boundaryGap: false,
        data: index
    },
    yAxis: {
        type: 'value',
        boundaryGap: [0, '100%'],
        splitLine: {
            show: true
        },
        min : 'dataMin',
        max : 'dataMax',
        name : '价值(value) | 价格(price)',
        nameLocation : 'middle',
        nameGap : 40,
        nameRotate : 90,
        nameTextStyle : {
            fontSize : 20
        }
    },
    animationDuration: delay_sec,
    //animationDuration: 100,
    legend: {
        data : ['Value','Price'],
        x : 'left',
        orient : 'vertical',
        top : 60,
        left : 725
    },
    series: [{
        name: 'Value',
        type: 'line',
        showSymbol: false,
        hoverAnimation: false,
        data: value,
        color : ['#81b4df'],
        markPoint: { // markLine 也是同理
            data: [{
                coord: [20, Math.floor(10*value[value.length-1])/10],
                symbol  : 'pin'
            }],
            label:{
              normal:{
                testStyle:{
                  fontSize : 8
                }
              }
            }
        }
    },
    {
        name: 'Price',
        type: 'line',
        showSymbol: false,
        hoverAnimation: false,
        data: price,
        color : ['#FF0000'],
        markPoint: { // markLine 也是同理
            data: [{
                coord: [19, Math.floor(10*price[price.length-1])/10]
            }]
        }
    }
  ]
};

var option_price = {
    tooltip: {
        trigger: 'axis',
    },
    xAxis:  {
        type: 'category',
        boundaryGap: false,
        data: index
    },
    yAxis: {
        type: 'value',
        boundaryGap: [0, '100%'],
        splitLine: {
            show: true
        },
        min : 'dataMin',
        max : 'dataMax',
        name : 'Price',
        nameLocation : 'middle',
        nameGap : 25,
        nameRotate : 0,
        nameTextStyle : {
            fontSize : 16
        }
    },
    animationDuration: delay_sec,
    //animationDuration: 100,
    series: [{
        name: 'Price',
        type: 'line',
        showSymbol: false,
        hoverAnimation: false,
        data: price,
        color : ['#81b4df']
    }]
};

var  dataMax_volumn = 5*sigma_uH;
option_volumn = {
    tooltip: {
        trigger: 'axis',
    },
    xAxis:  {
        type: 'category',
        boundaryGap: false,
        data: index
    },
    yAxis: {
        type: 'value',
        boundaryGap: [0, '100%'],
        splitLine: {
            show: true
        },
        min : 'dataMin',
        max :  dataMax_volumn,
        name : '成交量',
        nameLocation : 'middle',
        nameGap : 40,
        nameRotate : 90,
        nameTextStyle : {
            fontSize : 20
        }
    },
    animationDuration: delay_sec,
    //animationDuration: 100,
    series: [{
        name: 'Volumn',
        type: 'line',
        step: 'start',
        showSymbol: false,
        hoverAnimation: false,
        data: volumn,
        color : ['#81b4df'],
        label: {
                normal: {
                    show: true,
                    position: 'top'
                }
              },
        markPoint: { // markLine 也是同理
            // data: [{
            //     coord: [19, Math.floor(10*volumn[volumn.length-1])/10]
            // }]
        }
    }]
};


//ctx_price.setOption(option_price);
setTimeout("ctx_value.setOption(option_value);",2000);
setTimeout("start_showing_volumn();",22000);
setTimeout("$('#cover2').hide()",20000);
setTimeout("addCover()",4000);

function addCover(){
  $("#cover").animate({width:"540px"},18000,'linear');
}

function start_showing_volumn(){
  setTimeout("ctx_volumn.setOption(option_volumn);",2000);
  t2=setInterval('timedCount2();',1000);
  setTimeout("$('#cover3').animate({width:'540px'},18000,'linear');",4000);
}

$(document).ready(function(){
  $("input[name=view_answer]").click(function(){
    $("#example_answer").show();
    $("input[name=next]").show();
  });

    $("input[name=next]").click(function(){
      //  refresh();
       window.location.reload();
    });

    $("#q3_btn").click(function(){
        if($('input:radio[name="q3"]:checked').val()){
          $(this).attr("disabled","disabled");
          $("input[name=q3]").attr("disabled","disabled");
          $.ajax({
               type: "GET",
               url: "../test/store_data",
               data: {
                      "test_type":"Joint",
                      "q1_answer": 0,
                      "q2_answer": 0,
                      "q3_answer":$("input[name=q3]:checked").val(),
                      "t0":$("input[name=t0]").val(),
                      "t1":$("input[name=t1]").val()
                     },
               success: function (data) {
                      $("input[name=next]").show();
               },
               error: function (msg) {
                   alert("load error! or Invalid User!");
               }
           });
           $("input[name=next]").show();
           $("#start_test").show();
        }else{
          alert("请选择后再提交！");
        }
    });
});

</script>
