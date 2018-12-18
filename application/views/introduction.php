<!DOCTYPE html>
	<head>
	<meta charset=utf-8>
		<title></title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="../../public/js/Chart.bundle.min.js"></script>
		<script type="text/javascript" src="../../public/js/echarts.min.js"></script>
    <style>
		html{
		    width: 100%;
		    font-style: sans-serif;
		}
		body{
		    width: 100%;
		    font-family: 'Calibri';
		    margin: 0;
		    background-color: #4A374A;
				font-size:20px;
		}

		h1{
		    font-size: 2em;
		    margin: 0.67em 0;
				color: #fff;
		    text-shadow:0 0 10px;
		    letter-spacing: 1px;
		    text-align: center;
		}

		button{
			width: 300px;
	    min-height: 20px;
	    display: block;
	    background-color: #4a77d4;
	    border: 1px solid #3762bc;
	    color: #fff;
	    padding: 9px 14px;
	    font-size: 15px;
	    line-height: normal;
	    border-radius: 5px;
	    margin: 20px auto;
			cursor:pointer;
		}

		a{
			color:#FFF;
			text-decoration: none;
		}

		#header_logo{
			margin:0px auto;
			text-align: center;
			color: #fff;
			text-shadow:0 0 10px;
			letter-spacing: 1px;
		}

		b{
			color:#FFF;
		}
		p{
			padding:5px;
		}
		td{
			width:150px;
			border:solid 1px #FFF;
			padding:2px 5px;
		}
		h3,h3{
			color:#FFF
		}
		#start_phone{box-shadow:0 0 20px 0 #000000;}
		</style>

	</head>
	<body>
		<h1>第一部分 交易测试</h1>
<div id="header" style="margin:0px auto">
  <div id="header_nav" class="navbar-fixed-top">
  	<div id="header_container">
	  	<div id="header_logo">
        <?php //echo "Welcome to the trading test ".$_SESSION["username"];
					echo "欢迎您参加测试。 测试者".$_SESSION["username"];

				?>
	  	</div>
	  	<div id="header_link">

	  	</div>
  	</div>
  </div>
 </div>
 <div id="introduction_content" style="margin:0px auto; width:800px;color:#DDD;text-align:center">
	 <h3>下面是练习环节，帮助您熟悉市场类型的判断标准。</h3>
 </div>
<div id="example_video" style="display:none;margin:10px auto;color:#EEE;text-align:center">
	<h3>Please watch the experiment video.</h3>
	<h3>请您观看视频示例。</h3>

	<video id="video" style="margin:10px auto;width:600px;height:400" controls>
		 <source src="../../public/video/experiment_video.mov" type="" />
		 Your browser does not support the <video> element.
 </video>
</div>
<div id="adjust_volumn" style="margin:10px auto;color:#EEE;text-align:center">
	<h3>请戴上耳机，点击图标，试听音频，把系统音量调节到舒适的水平。</h3>
	<h3>把音量调节到舒适的水平之后，请保持音量不变，便于统一判断标准。</h3>
  <p><img id="start_phone" src="../../public/image/headphone.png"  alt="headphone" style="width:100px;height:100px;" /></p>
	<audio id="bgAudio" style="margin:10px auto" loop>
		 <source src="../../public/mp3/electricity.mp3" type="audio/mp3" />
		 Your browser does not support the <audio> element.
 </audio>
</div>
<h3 style="width:800px;font-size:16px;text-align:center;margin:auto">本次练习环节首先是市场类型的练习轮，一共6轮，每轮之后系统会告诉您这一轮市场是繁忙市场还是冷清市场，帮助您增加正式练习判断的准确率。点击“下一步”进行练习。</h3>
<button id="finished_adjust_volumn">下一步</button>

<button id="start_trial" style="display:none;margin-bottom:100px;cursor:pointer"><a style="width:100%;height:100%" href="../test/seqTest">Start Test!</button>
<script>
function fadeintro(){
		$("#example_video h3").hide(1000);
		$("#start_trial").show();
}

 $(document).ready(function(){
     $("#finished_adjust_volumn").click(function(){
          $("#adjust_volumn").hide();
					$(this).hide();
					//$("#example_video").show();
					t=setTimeout("fadeintro()",10);
					location.href = "../test/examples";
					});

		audio = document.getElementById("bgAudio");
		audio.volumn= 0.3;
		$("#start_phone").toggle(function(){
			audio.play();
		},function(){
			audio.pause();
		});
});
</script>

 <div id="footer_nav"></div>
 </body>
</html>
