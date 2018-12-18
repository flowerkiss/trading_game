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
			font-size:20px;
			text-align: center;
		}

		#questions{
			color:#FFF;
			font-size:16px;
			width:1024px;
			margin:0px auto
		}

		.question_title{
			margin-top:25px;
		}

		.question label{
			margin-left:10px;
			margin-bottom:15px;
		}

		.question_image{
			margin-top:15px;
			margin-bottom:15px;
		}

		input[type="submit"] {border:none;background:none;cursor:pointer;color:#FFF}
		</style>

	</head>
	<body>
		<h1>OC test</h1>
<?php if (!isset($_SESSION["oc_finished"])):?>
		<?php if($_SESSION["step"] ==1):?>
		<h3>以下有<?echo "6";?>道问题测试您的认知力，每个问题都存在<u>一个正确答案</u>。您每回答正确一个问题，我们会奖励您<?echo "1";?>块钱。</h3>

		<div id="questions">
				<form action="" method="post">
		<?php $i=1;
					$ans = "";
		foreach ($questions as $question): ?>

			<?php
				$question_images = explode(";",$question->question_images);
			?>
	    <div class="question">
				<div class="question_title">
					<?php echo $i.". ".$question->question_content;?>
				</div>
				<?php foreach ($question_images as $image):?>
					<?php if($image!=""):?>
						<img class="question_image" src="../../public/image/oc_image/<?php echo $image;?>"></img><br />
					<?php endif;?>
				<?php endforeach;?>
				<input name="<?php echo "q".$i."_id";?>" type="hidden" value="<?php echo $question->question_id;?>"/>
				<label><input name="<?php echo "q".$i;?>" type="radio" value="a" required/><?php echo "A. ".$question->choice_a;?> </label>
				<label><input name="<?php echo "q".$i;?>" type="radio" value="b" required/><?php echo "B. ".$question->choice_b;?> </label>
				<label><input name="<?php echo "q".$i;?>" type="radio" value="c" required/><?php echo "C. ".$question->choice_c;?> </label>
				<label><input name="<?php echo "q".$i;?>" type="radio" value="d" required/><?php echo "D. ".$question->choice_d;?> </label>
				</br>
			</div>

	  <?php
					$i++;
					$ans .= $question->right_answer;
					$_SESSION["ans"] = $ans;
	        endforeach;
		?>
		<button><input type="submit" value="提交"/></button>
		</form>
	 </div>

 <?php endif;?>


 <?php if($_SESSION["step"] ==2):?>
 <div id="questions2" style="width:1024px; margin:0px auto">
	 <h3>回答问题结束。</h3>
	 <h3>请就您的答题情况回答以下问题。您的答案如果正确则每道问题会获得<?php echo "2";?>元的额外奖励；如果回答错误则没有奖励。</h3>
	 <form action="" method="get">
		 <h3>1.您觉得在以上六道认知力问题中您回答对了几道？</h3>
		 <div style="margin:0px auto;text-align:center;">
		 <select name="right_num_by_tester" >
			 <?php
			 for($k=0;$k<=$total_question_num;$k++){
				 	echo "<option value =\"".$k."\">".$k."道</option>";
			 }
			 ?>
		 </select>
	 </div>
		 <h3>2.您觉得在答过这道题的人群中，您的答对题数会排名在多少？</h3>
		 <div style="margin:0px auto;text-align:center;color:#FFF">
			 <label><input name="rank_by_tester" type="radio" value="a" required/>A.前5% </label>
			 <label><input name="rank_by_tester" type="radio" value="b" required/>B.前5%-10%</label>
			 <label><input name="rank_by_tester" type="radio" value="c" required/>C.前10%-25% </label>
			 <label><input name="rank_by_tester" type="radio" value="d" required/>D.前25%-50%</label>
			 <label><input name="rank_by_tester" type="radio" value="e" required/>E.前50%-75%</label>
			 <label><input name="rank_by_tester" type="radio" value="f" required/>F.前75%-100%</label>
		 <br />
	 </div>
	 <div style="margin:30px auto;text-align:center;">
		 <button><input type="submit" value="提交"/></button>
	 </div>
		 </form>
	</div>
 <?php endif;?>

 <?php if($_SESSION["step"]>2&&!isset($_SESSION["oc_finished"])):?>
	 <h3>测试结果</h3>
	 <h3>6道认知问题您一共回答对了<?php echo $right_num;?>道，可获得<?php echo $right_num*1;?>元</h3>
	 <h3>2道判断问题您一共回答对了<?php echo $right_num2;?>道，可获得 <?php echo $right_num2*2;?>元</h3>
	 <button><a href="./exp_list">返回</a></button>
 <?php endif;?>
<?php endif; ?>

 <?php if(isset($_SESSION["oc_finished"])):?>
	 <h3>您已参加过该测试</h3>
	 <button><a href="./exp_list">返回</a></button>
 <?php endif;?>

 	 <div id="footer_nav"></div>
 </body>
</html>
