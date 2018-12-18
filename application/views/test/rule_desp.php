  <div id="rule_desp" style="width:1000px;margin:50px auto; color:#FFF;text-align:center">
      <h3 style="padding:50px;text-align:left;line-height:30px;">在正式的股票投资决策中，您一共需要做出判断30轮刚才练习中的决策，每轮的市场类型是随机产生且相互独立的。每轮开始时，您都能够获得400实验币的初始财富，并收到该市场前20期的历史信息。请注意，在30轮实验的进行过程中，您将暂时不会收到每一轮判断正确与否的反馈。所有的实验都结束后，电脑会随机在这一部分抽取一轮，按照您的决策进行支付，作为您在这一环节的报酬。因此，请务必审慎决策，好像每一轮都会实现一般！</h3>
  <?php if($test_type=="Sequence"):?>
    <button>
      <a href="seqTest" style="color:#FFF;text-decoration:none;">开始测试!</a>
    </button>
  <?php endif;?>

  <?php if($test_type=="Joint"):?>
    <button>
      <a href="jointTest" style="color:#FFF;text-decoration:none;">开始测试!</a>
    </button>
  <?php endif;?>

  <?php if($test_type=="Sequence_vol_first"):?>
    <button>
      <a href="seqTest_vol_first" style="color:#FFF;text-decoration:none;">开始测试!</a>
    </button>
  <?php endif;?>

  </div>
