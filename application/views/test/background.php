<!DOCTYPE html>
	<head>
	<meta charset=utf-8>
		<title></title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="../../public/js/Chart.bundle.min.js"></script>
		<script type="text/javascript" src="../../public/js/echarts.min.js"></script>
		<style type="text/css">

    caption {
        font-size:20px;
				font-weight:bold;
		}
		table {
			text-align: center;
		}

		table{border-collapse:collapse;border-bottom:1px solid #ccc}
    tr.first{border-top:1px solid #ccc;border-bottom:1px solid #ccc}
		td{padding:10px 50px;}
		html{
		    font-style: sans-serif;
        overflow:scroll;
		}
		body{
		    font-family: 'Open Sans',sans-serif;
		    margin: 0;
		    background-color: #4A374A;
        height:2000px;
		}

    h3{
      color:#FFF;

    }
		#container{
			background-color: #EEE;
			width:80%;
			margin:0px auto;
			font-family: 'Open Sans',sans-serif;
		}

		#cover{
			position: absolute;
			width: 1px;
			height: 391px;
			background-color: #EEE;
			z-index: 999;
			top: 100px;
			margin-left: 81px;
		}

		#cover2{
			position: absolute;
			width: 70px;
			height: 500px;
			background-color: #EEE;
			z-index: 999;
			top: 50px;
			margin-left: 660px;
		}

		#tester_info h1{
			margin:0px auto;
			text-align: center;
		}
		input[name=submit],input[name=next],.submit,button,input[type=button]{
		    width: 150px;
		    margin-bottom: 10px;
		    outline: none;
		    padding: 10px;
		    font-size: 13px;
		    color: #fff;
		    text-shadow:1px 1px 1px;
		    border-radius: 4px;
				background-color: #4a77d4;
		    border: 1px solid #3762bc;
				cursor:pointer
		}
		input[name=order_num]{
		    width: 50px;
		    min-height: 20px;
		    background-color: #FFF;
		    border: 1px solid #3762bc;
		    color: #000;
		    padding: 9px 14px;
		    font-size: 15px;
		    line-height: normal;
		    border-radius: 5px;
		    margin: 10px 0px;
				border-top: 1px solid #312E3D;
		    border-left: 1px solid #312E3D;
		    border-right: 1px solid #312E3D;
		    border-bottom: 1px solid #56536A;
		}

		table{
			text-align: center;
			margin:50px auto;
			color: #FFF;
		}


		caption{
			margin: 20px;
			text-shadow:0.5px 0.5px 0.5px;
		}

		#questions{
			color:#FFF;
			font-size:20px;
			width:800px;
			margin:0px auto
		}

		.question_title{
			margin:50px 0px 15px 0px;
		}

		.question label{
			margin-left:10px;
			margin-bottom:25px;
		}

		.question_image{
			margin-top:15px;
			margin-bottom:15px;
		}

    .question{
      margin-bottom: 30px;
    }

		a{
			color:#FFF;
			text-decoration: none;
		}
</style>
	</head>
	<body>
<div id="header">
  <div id="header_nav" class="navbar-fixed-top">
  	<div id="header_container">
	  	<div id="header_logo">
	  	</div>
	  	<div id="header_link">

	  	</div>
  	</div>
  </div>
 </div>


<div id="content_title" style="width:800px;text-align:left;margin:50px auto;">
  <h1 style="color:#FFF">第三部分 背景调查</h1>
  <h3 style="color:#FFF"> 请按您的实际情况回答以下问题。
</div>
<?php if(!isset($_SESSION["background_finished"])||$_SESSION["background_finished"]==0):?>

  <div id="questions">
      <form action="process_background" method="post">
			<div class="question">
      	<div class="question_title">
        	1. 性别
				</div>
      	<input name="q1_id" type="hidden" value="1">
            <label><input name="q1" type="radio" value="男" required="">男 </label>
            <label><input name="q1" type="radio" value="女" required="">女  </label>
          	<br>
     </div>

		 <div class="question">
			 <div class="question_title">
				 2. 年龄：
			 </div>
			 <input name="q2_id" type="hidden" value="2">
			 <input name="q2" type="text" value="" required="" onKeyUp="value=value.replace(/[^\d]/g,'')">
			 <br>
		</div>

		<div class="question">
			<div class="question_title">
				3. 你目前是:
			</div>
			<input name="q3_id" type="hidden" value="">
					<label><input name="q3" type="radio" value="a" required="">A. 本科 </label>
					<label><input name="q3" type="radio" value="b" required="">B. 硕士  </label>
					<label><input name="q3" type="radio" value="c" required="">C. 博士  </label>
			<br>
	 </div>

	 <div class="question">
		 <input name="q4_1_id" type="hidden" value="4">
		 <div class="question_title">
			4.	你现就读于哪个系
		 </div>
		 <input name="q4_1" type="text" value="" required="">
		 <input name="q4_2_id" type="hidden" value="2">
		 <div class="question_title">
			哪个年级
		 </div>
		 <input name="q4_2" type="text" value="" required="">
	</div>

 <div class="question">
 	<div class="question_title">
 		5. 您父亲的教育水平是？
 	</div>
 	<input name="q5_id" type="hidden" value="5">
 			<label><input name="q5" type="radio" value="a" required="">A. 初中及以下</label>
 			<label><input name="q5" type="radio" value="b" required="">B. 职业高中  </label>
 			<label><input name="q5" type="radio" value="c" required="">C. 专科  </label>
 			<label><input name="q5" type="radio" value="d" required="">D. 本科 </label>
 			<label><input name="q5" type="radio" value="e" required="">E. 硕士以上学历 </label>
 	<br>
 </div>

 <div class="question">
 	<div class="question_title">
 		6. 您母亲的教育水平是？
 	</div>
 	<input name="q6_id" type="hidden" value="5">
 			<label><input name="q6" type="radio" value="a" required="">A. 初中及以下</label>
 			<label><input name="q6" type="radio" value="b" required="">B. 职业高中  </label>
 			<label><input name="q6" type="radio" value="c" required="">C. 专科  </label>
 			<label><input name="q6" type="radio" value="d" required="">D. 本科 </label>
 			<label><input name="q6" type="radio" value="e" required="">E. 硕士以上学历 </label>
 	<br>
 </div>


 <div class="question">
 	<div class="question_title">
 		7. 您有没有股票投资经验？
 	</div>
 	<input name="q7_id" type="hidden" value="7">
 			<label><input name="q7" type="radio" value="a" required="">A. 完全没有</label>
 			<label><input name="q7" type="radio" value="b" required="">B. 有一点  </label>
 			<label><input name="q7" type="radio" value="c" required="">C. 经验很丰富  </label>
 	<br>
 </div>

 <div class="question">
  <div class="question_title">
 	 8. 您有没有模拟炒股或者分析证券的经历？
  </div>
  <input name="q8_id" type="hidden" value="7">
 		 <label><input name="q8" type="radio" value="a" required="">A. 完全没有</label>
 		 <label><input name="q8" type="radio" value="b" required="">B. 有一点  </label>
 		 <label><input name="q8" type="radio" value="c" required="">C. 经验很丰富  </label>
  <br>
 </div>

 <input type="submit"  name="submit" value="提交" style="margin-bottom:50px;padding:20px 40px; font-size:20px;cursor:pointer"/>
 </form>
</div>


</div>

<?php else:?>
<div style="width:800px;margin:0px auto">
<h3>提交成功</h3>
<div id="next_test">
  <button><a href="final_result">下一步</a></button>
</div>
</div>
<?php endif;?>
