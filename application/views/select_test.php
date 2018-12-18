<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Test</title>
<style>
html{
    width: 100%;
    height: 100%;
    overflow: hidden;
    font-style: sans-serif;
}
body{
    width: 100%;
    height: 100%;
    font-family: 'Open Sans',sans-serif;
    margin: 0;
    background-color: #4A374A;
}

#content{
  margin:100px auto;
  text-align: center;
}

a{
  text-decoration: none;
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

h1{
  color:#FFF;
}

h3,h3{
  color:#FFF;
  margin:auto;
}
</style>
</head>
<body>
<div id="content">
  <h1>点击按钮开始练习</h1>

  <?php if($test_type == "Sequence"):?>
        <h3 style="width:800px;text-align:center">
          下面是股票投资决策的练习轮，一共1轮。决策包含（1）买还是卖的决策；（2）繁忙市场还是冷清市场的判断。您将先收到前20期股票的价格、价值的历史信息，以及第21期的价值信息，然后决策下一期应该“买”或者“卖”；再然后收到前20期交易量的历史信息，然后判断是“繁忙市场”或者“冷清市场”。请注意，这一轮结束后不会告知您判断的得到对错，只是为了让您熟悉接下来的正式任务。点击“开始”进行练习。
        </h3>
        <a href="../test/seqTest">开始练习</a>
  <?php endif;?>

  <?php if($test_type == "Joint"):?>
        <h3 style="width:800px;text-align:center">
          下面是股票投资决策的练习轮，一共1轮。您将先收到前20期股票的价格、价值和交易量的历史信息，然后决策下一期应该“买很多”、“买一点”、“卖很多”、“卖一点”。请注意，这一轮结束后不会告知您判断的得到对错，只是为了让您熟悉接下来的任务。点击“开始”进行练习。</h5>
        </h3>
        <a href="../test/jointTest">开始练习</a>
  <?php endif;?>

  <?php if($test_type == "Sequence_vol_first"):?>
        <h3 style="width:800px;text-align:center">
          下面是股票投资决策的练习轮，一共1轮。决策包含（1）繁忙市场还是冷清市场的判断；（2）买还是卖的决策。您将先收到前20期交易量的历史信息，然后判断是“繁忙市场”或者“冷清市场”；再然后收到前20期股票的价格、价值的历史信息，以及第21期的价值信息，然后决策下一期应该“买”或者“卖”。请注意，这一轮结束后不会告知您判断的得到对错，只是为了让您熟悉接下来的正式任务。点击“开始”进行练习。
        </h3>
        <a href="../test/seqTest_vol_first">开始练习</a>
  <?php endif;?>

</div>
</body>
</html>
