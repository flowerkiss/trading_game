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

if(!isset($_SESSION["mode"])||$test_num_left==$total_round)$_SESSION["mode"]=rand(0,1);

//if(($test_num_left<=$total_round/2&&$_SESSION["mode"]==0)||($test_num_left>$total_round/2&&$_SESSION["mode"]==1)){
//    $_SESSION["round_mode"] = 1;
//}else{
//    $_SESSION["round_mode"] = 0;
//}
?>

<?php if($_SESSION["username"]=="admin"):?>
    <button style="position:absolute;"><a href="../admin" style="text-decoration:none">Back to admin console</a></button>
<?php endif;?>
 <div id="container">
   <div id="cover" style=""></div>
   <div id="cover2" style=""></div>

   <div id="tester_info"><h1> <?php echo $_SESSION["username"];?>'s Test</h1></div>
   <h3 style="text-align:center;margin:15px auto">Round: <?php echo $total_round+1-$test_num_left;?>/<?php echo $total_round; ?></h3>

    <div id="valueChart" style="position: absolute;top: 50px;width:800px;height:400px;"></div>
    <!--<div id="priceChart" style="position: absolute;top: 200px;width:800px;height:200px;"></div>-->
    <div id="volumnChart" style="position: absolute;top: 350px;width:800px;height:200px;"></div>

    <div id="value_label" style="display:none;width: 100px;position: absolute;top: 125px;left: 900px;">In Period <?php echo count($Value);?> Value is <?php echo floor(end($Value)*100)/100;?> </div>
    <div id="price_label" style="display:none;width: 100px;position: absolute;top: 275px;left: 900px;">In Period <?php echo count($Price);?> Price is <?php echo floor(end($Price)*100)/100;?> </div>
    <div id="volumn_label" style="display:none;width: 100px;position: absolute;top: 425px;left: 900px;">In Period <?php echo count($Volumn);?> Volumn is <?php echo floor(end($Volumn));?> </div>

    <div id="round_gain" style="width: 150px;position: absolute;top: 200px;left: 900px;"></div>

    <div id="best_gain" style="width: 150px;position: absolute;top: 300px;left: 900px;"></div>

    <div id="total_gain" style="display:none;width: 150px;position: absolute;top: 400px;left: 900px;"></div>

    <div id="Question" style="display:none;position: absolute;top: 550px;left:185px;font-size:18px">
      Given this information: How many units would you like to order in period <?php echo count($Value);?>?
        <input name="order_num" type="number" style="width:70px" value="0">
        <input name="submit" type="submit" value="Submit" />
        <input name="next" type="button" style="display:none" value="Next Round!"/>
        <div id="show_num" style="margin-top:10px;text-align:right"></div>
        <label style="float:right">seconds till order finalizes!</label>
        <div class="timerShowContainer" id="timers" style="float:right;margin-right:5px;color:red;font-weight:bold">15</div>
    </div>
    <div class="timerShowContainer" id="timers2" style="display:none">21</div>
    <div class="timerShowContainer" id="volumn_level" style="display:none"></div>

    <audio id="bgAudio" style="display:none" autoplay loop>
       <source src="../../public/mp3/electricity.mp3" type="audio/mp3" />
       Your browser does not support the <audio> element.
   </audio>
 </div>
<script>

var t=setTimeout("timedCount()",20000);
var N = <?php echo $N;?>;
//var t=setTimeout("timedCount()",100);

function timedCount()  {
  //document.getElementById("value_label").style.display = "block";
  //document.getElementById("price_label").style.display = "block";
  //document.getElementById("volumn_label").style.display = "block";
  document.getElementById("Question").style.display = "block";
    var tim=document.getElementById("timers");
    var time=parseInt(tim.innerHTML);
    document.getElementById("timers").innerHTML = time;
    if( t !=null && time==0){
      clearTimeout(t);
      $("input[name=order_num]").val(0);
      $("input[name=submit]").click();
      alert("Order Time Out!");

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
var test_num_left = <?php echo $test_num_left;?>;
var total_round = <?php echo $total_round;?>;
var mode = <?php echo $_SESSION["mode"];?>;
var round_mode = <?php echo $_SESSION["round_mode"];?>;
var voice_level = 0;
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

var t2=setTimeout("timedCount2()",100);
var series_index = 0;

function timedCount2()  {
    var tim=document.getElementById("timers2");
    var time=parseInt(tim.innerHTML);
    var vol = volumn[series_index];
    if(vol<1.01)vol=1.01;
    voice_level = Math.log(vol)/Math.log(100*sigma_uH);


    document.getElementById("timers2").innerHTML = time;
    if( t !=null && time==0){
      clearTimeout(t2);
      return;
    }
    time--;
    tim.innerHTML = time;
    t=setTimeout("timedCount2()",1000);
    //alert("test_num_left="+test_num_left+"<>"+"total_round="+total_round);
    // if((test_num_left<=total_round/2&&mode==0)||(test_num_left>total_round/2&&mode==1)){
    //   if(series_index<N){
    //       document.getElementById("bgAudio").volume = voice_level;
    //   }else{
    //       document.getElementById("bgAudio").volume = 0;
    //   }
    // }else{
    //     document.getElementById("bgAudio").volume = 0;
    // }
    if(round_mode == "1"){
      if(series_index<N){
           document.getElementById("bgAudio").volume = voice_level;
      }else{
           document.getElementById("bgAudio").volume = 0;
      }
    }else{
          document.getElementById("bgAudio").volume = 0;
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
        name : 'Value & Price',
        nameLocation : 'middle',
        nameGap : 40,
        nameRotate : 90,
        nameTextStyle : {
            fontSize : 20
        }
    },
    animationDuration: 20000,
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
    animationDuration: 20000,
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
        max : 'dataMax',
        name : 'Volumn',
        nameLocation : 'middle',
        nameGap : 40,
        nameRotate : 90,
        nameTextStyle : {
            fontSize : 20
        }
    },
    animationDuration: 20000,
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

ctx_value.setOption(option_value);
//ctx_price.setOption(option_price);
setTimeout("ctx_volumn.setOption(option_volumn)",1000);
setTimeout("$('#cover2').hide()",18000);
setTimeout("addCover()",2000);


function addCover(){
  $("#cover").animate({width:"540px"},18000,'linear');
}

$(document).ready(function(){
    $("input[name=submit]").click(function(){
       $(this).hide();
       $("input[name=order_num]").attr("disabled","disabled");
       clearTimeout(t);
       $("input[name=next]").show();
       var order = $("input[name=order_num]").val();
       $.ajax({
            type: "GET",
            url: "../test/store_data",
            data: {"order":order},
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                $("#round_gain").html("The return for this round is <font color='red'>" + data.round_gain + "</font>");
                $("#best_gain").html("The theoretically optimal order for this round is     <font color='green'>" + data.best_order + "</font>, <br>" + "by which the gain is <font color='green'>" + data.best_gain + "</font>" );

                $("#total_gain").html("The accumulated return is <font color='red'>" + data.total_gain + "</font>");
                // Play with returned data in JSON format
            },
            error: function (msg) {
                alert("load error! or Invalid User!");
            }
        });
    });

    $("input[name=next]").click(function(){
      //  refresh();
       window.location.reload();
    });
});

</script>
