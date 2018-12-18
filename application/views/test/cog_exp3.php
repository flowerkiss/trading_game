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
  <h1 style="color:#FFF">第三组</h1>
  <h3 style="color:#FFF"> 共10题。如果最后抽中这一组题目，您每答对一题，将获得10元实验币的支付。
</div>
<?php if(!isset($_SESSION["cog_exp3_finished"])||$_SESSION["cog_exp3_finished"]==0):?>

  <div id="questions">
      <form action="process_cog_exp3" method="post">
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
          <img class="question_image" src="../../public/image/cog_exp3_image/<?php echo $image;?>"></img><br />
        <?php endif;?>
      <?php endforeach;?>
      <input name="<?php echo "q".$i."_id";?>" type="hidden" value="<?php echo $question->question_id;?>"/>

      <?php if(isset($question->choice_a)):?>
      <label><input name="<?php echo "q".$i;?>" type="radio" value="a" required/><?php echo "A. ".$question->choice_a;?> </label>
      <?php endif;?>

      <?php if(isset($question->choice_b)):?>
      <label><input name="<?php echo "q".$i;?>" type="radio" value="b" required/><?php echo "B. ".$question->choice_b;?> </label>
      <?php endif;?>

      <?php if($question->choice_c!=""):?>
      <label><input name="<?php echo "q".$i;?>" type="radio" value="c" required/><?php echo "C. ".$question->choice_c;?> </label>
      <?php endif;?>


      <?php if($question->choice_d!=""):?>
      <label><input name="<?php echo "q".$i;?>" type="radio" value="d" required/><?php echo "D. ".$question->choice_d;?> </label>
      <?php endif;?>


      <?php if($question->choice_e!=""):?>
      <label><input name="<?php echo "q".$i;?>" type="radio" value="e" required/><?php echo "E. ".$question->choice_e;?> </label>
      <?php endif;?>

      </br>
    </div>

  <?php
        $i++;
        $ans .= $question->right_answer;
        $_SESSION["ans"] = $ans;
        endforeach;
  ?>
  <input type="submit"  name="submit" value="提交" style="margin-bottom:50px;padding:20px 40px; font-size:20px;cursor:pointer"/>
  </form>
 </div>

<?php else:?>
<div style="width:800px;margin:0px auto">
<h3>提交成功</h3>
<div id="next_test">
  <button><a href="cog_exp4">下一步</a></button>
</div>
</div>
<?php endif;?>
