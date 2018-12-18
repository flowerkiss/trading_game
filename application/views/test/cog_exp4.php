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
			margin:75px 0px 15px 0px;
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
  <h1 style="color:#FFF">第四组</h1>
  <h3 style="color:#FFF"> 第四组共10题，请您根据实际情况作答。如果最后抽中这一组题目，您将获得100实验币。

</div>
<?php if(!isset($_SESSION["cog_exp4_finished"])||$_SESSION["cog_exp4_finished"]==0):?>

  <div id="questions">
      <form action="process_cog_exp4" method="post">
			<div class="question">
      	<div class="question_title">
        	1. 你是否容易分心？（例如背景噪音，其他人的交谈，等等。）
				</div>
      	<input name="q1_id" type="hidden" value="1">
            <label><input name="q1" type="radio" value="a" required="">A. 是 </label>
            <label><input name="q1" type="radio" value="b" required="">B. 有时  </label>
            <label><input name="q1" type="radio" value="c" required="">C. 不是  </label>
        	<br>
     </div>

		 <div class="question">
			 <div class="question_title">
				 2. 你工作或赴约迟到的频率是？
			 </div>
			 <input name="q2_id" type="hidden" value="2">
					 <label><input name="q2" type="radio" value="a" required="">A. 总是</label>
					 <label><input name="q2" type="radio" value="b" required="">B. 经常  </label>
					 <label><input name="q2" type="radio" value="c" required="">C. 有时  </label>
					 <label><input name="q2" type="radio" value="d" required="">D. 很少 </label>
					 <label><input name="q2" type="radio" value="e" required="">E. 几乎不 </label>
			 <br>
		</div>

		<div class="question">
			<div class="question_title">
				3. 你发现自己在工作时做白日梦的频率是？
			</div>
			<input name="q3_id" type="hidden" value="3">
					<label><input name="q3" type="radio" value="a" required="">A. 总是</label>
					<label><input name="q3" type="radio" value="b" required="">B. 经常  </label>
					<label><input name="q3" type="radio" value="c" required="">C. 有时  </label>
					<label><input name="q3" type="radio" value="d" required="">D. 很少 </label>
					<label><input name="q3" type="radio" value="e" required="">E. 几乎不 </label>
			<br>
	 </div>

	 <div class="question">
		 <div class="question_title">
			 4. 你是否会因为无法长时间集中注意力完成一个任务，而在任务之间来回切换？
		 </div>
		 <input name="q4_id" type="hidden" value="4">
				 <label><input name="q4" type="radio" value="a" required="">A. 是</label>
				 <label><input name="q4" type="radio" value="b" required="">B. 有时  </label>
				 <label><input name="q4" type="radio" value="c" required="">C. 不是  </label>
		 <br>
	</div>

	<div class="question">
		<div class="question_title">
			5. 你对于枯燥的、重复的任务处理得怎么样？
		</div>
		<input name="q5_id" type="hidden" value="5">
				<label><input name="q5" type="radio" value="a" required="">A. 我处理得还不错，我完成这样的任务没什么困难。</label><br />
				<label><input name="q5" type="radio" value="b" required="">B. 我处理得还可以，但是我时而需要休息一下。  </label><br />
				<label><input name="q5" type="radio" value="c" required="">C. 我受不了，它们无聊得要把我弄疯了。  </label>
		<br>
 </div>

 <div class="question">
 	<div class="question_title">
 		6. 在你和朋友打电话的时候，电视上开始播出你最喜欢的电视节目。你专注于谈话会有多困难？
 	</div>
 	<input name="q6_id" type="hidden" value="6">
 			<label><input name="q6" type="radio" value="a" required="">A. 极其困难</label>
 			<label><input name="q6" type="radio" value="b" required="">B. 很困难  </label>
 			<label><input name="q6" type="radio" value="c" required="">C. 有些困难  </label>
 			<label><input name="q6" type="radio" value="d" required="">D. 有点困难 </label>
 			<label><input name="q6" type="radio" value="e" required="">E. 一点也不困难 </label>
 	<br>
 </div>

 <div class="question">
 	<div class="question_title">
 		7. 当你阅读一本书或者杂志时，你发现自己在重复阅读或者跳过一段话的频率是？
 	</div>
 	<input name="q7_id" type="hidden" value="7">
 			<label><input name="q7" type="radio" value="a" required="">A. 总是</label>
 			<label><input name="q7" type="radio" value="b" required="">B. 经常  </label>
 			<label><input name="q7" type="radio" value="c" required="">C. 有时  </label>
 			<label><input name="q7" type="radio" value="d" required="">D. 很少 </label>
 			<label><input name="q7" type="radio" value="e" required="">E. 几乎不 </label>
 	<br>
 </div>


 <div class="question">
 	<div class="question_title">
 		8. 你是否有注意某些细节的癖好？（例如文档中的错别字）
 	</div>
 	<input name="q8_id" type="hidden" value="8">
 			<label><input name="q8" type="radio" value="a" required="">A. 是</label>
 			<label><input name="q8" type="radio" value="b" required="">B. 不是  </label>
  	<br>
 </div>

 <div class="question">
 	<div class="question_title">
 		9. 你容易失去耐心吗？
 	</div>
 	<input name="q9_id" type="hidden" value="9">
 			<label><input name="q9" type="radio" value="a" required="">A. 是</label>
 			<label><input name="q9" type="radio" value="b" required="">B. 有时  </label>
 			<label><input name="q9" type="radio" value="c" required="">C. 不是  </label>
 	<br>
 </div>


 <div class="question">
  <div class="question_title">
 	 10. 你在谈话时打断别人的频率是？ 
  </div>
  <input name="q10_id" type="hidden" value="10">
 		 <label><input name="q10" type="radio" value="a" required="">A. 总是</label>
 		 <label><input name="q10" type="radio" value="b" required="">B. 经常  </label>
 		 <label><input name="q10" type="radio" value="c" required="">C. 有时  </label>
 		 <label><input name="q10" type="radio" value="d" required="">D. 很少 </label>
 		 <label><input name="q10" type="radio" value="e" required="">E. 几乎不 </label>
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
  <button><a href="background">下一步</a></button>
</div>
</div>
<?php endif;?>
