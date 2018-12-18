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
			color:#FFF;
		}
		h1{
			color:#FFF;
			text-align: center;
		}
		#start_phone{box-shadow:0 0 20px 0 #000000;}
		</style>

	</head>
	<body>
		<h1></h1>
<div id="header" style="margin:0px auto">
  <div id="header_nav" class="navbar-fixed-top">
  	<div id="header_container">
	  	<div id="header_logo">
	  	</div>
	  	<div id="header_link">

	  	</div>
  	</div>
  </div>
 </div>

 <div id="intro_title"><h1>第二部分 认知测试</h1></div>
 <div id="introduction_content" style="margin:0px auto; width:800px;color:#DDD;text-align:center">
	 <h3>下面进入第二部分，一共包含四组题目，最后将随机抽取一组题目，按照您的表现进行支付。</h3>
 </div>
 <button id="next">下一步</button>
 <br />
 <button id="skip" style="display:none">跳过</button>

<script>


 $(document).ready(function(){
     $("#next").click(function(){
					location.href = "../test/cog_exp1";
					});
		 $("#skip").click(function(){
					location.href = "../test/background";
		 });
});
</script>

 <div id="footer_nav"></div>
 </body>
</html>
