<div style="margin:0px auto;text-align:center">
<div id="secton2">
  <h3 style="color:#FFF;">第二部分：认知测试</h3>
  <ul style="color:#FFF;width:200px; text-align:left;margin:0px auto">
    <li><label class="score">第一组成绩:</label> <?php echo $score1*10;?> 实验币</li>
    <li><label class="score">第二组成绩:</label><?php echo $score2*10;?> 实验币</li>
    <li><label class="score">第三组成绩:</label><?php echo $score3*10;?> 实验币</li>
    <li><label class="score">第四组成绩:</label><?php echo $score4;?>实验币</li>
  </ul>
</div>
<script language="javascript" type="text/javascript">

    function logout(){
//        if (confirm("您确定要退出控制面板吗？"))
            top.location = "../login";
         return false;
    }
var rand = <?php echo $rand;?>;
var total_num = 3;
$("ul li").eq(rand%4).css({"color":"red","font-weight":"bold"})
$("tr").eq(rand%total_num + 1).css({"color":"red","font-weight":"bold"})
</script>
  <h3 style="color:#FFF;">实验结束</h3>
  <h3 style="color:#FFF;">请不要关闭网页！请在座位上举手示意主试，并准备好支付宝或微信的二维码。</h3>
<button onclick="logout()" style="width: 150px;
margin: 10px auto;
outline: none;
padding: 10px;
font-size: 13px;
color: #fff;
text-shadow:1px 1px 1px;
border-radius: 4px;
background-color: #4a77d4;
border: 1px solid #3762bc;
cursor:pointer;">退出</button>
</div>
