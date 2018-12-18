<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <title>Admin</title>
</head>
<body>
  <div id="admin">
        <h1>Admin</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/formsubmit'); ?>
        <form method="post">
            <label>Total Round:</label>
            <input type="number" required="required" placeholder="Total Round" name="total_round" value="<?php echo $total_round; ?>" style="margin:10px;"></input><br>

            <label>N:</label>
            <input type="number" required="required" placeholder="N" name="N" value="<?php echo $N; ?>" style="margin:10px;"></input><br>
            <label>V0:</label>
            <input type="number" required="required" placeholder="V0" name="V0" value="<?php echo $V0; ?>"></input><br/>
            <label>&sigma;<sub>v</sub>:</label>
            <input type="number" required="required" placeholder="sigma_v" name="sigma_v" value="<?php echo $sigma_v; ?>"></input><br/>
            <label>&sigma;<sub>uL</sub>:</label>
            <input type="number" required="required" placeholder="sigma_uL" name="sigma_uL" value="<?php echo $sigma_uL; ?>"></input>
             <label>&sigma;<sub>uH</sub>:</label>
            <input type="number" required="required" placeholder="sigma_uH" name="sigma_uH" value="<?php echo $sigma_uH; ?>"></input><br/>
            <label>&sigma;<sub>e</sub>:</label>
            <input type="number" required="required" placeholder="sigma_e" name="sigma_e" value="<?php echo $sigma_e; ?>"></input><br/>

            <label>Sound Bit:(e.g. input "1010101010" means every other round has sound for 10 rounds)</label><br />
            <p>0 Means Graph only for volumn</p>
            <p>1 Means Sound only for volumn</p>
            <p>2 Means Graph and Sound for volumn</p>

            <input type="text" required="required" style="width:300px;" placeholder="1111100000" name="sound_bit" value="<?php echo $sound_bit; ?>"></input><br/>
                <br /><br />
            <label>Test Type:</label>
            <select name="test_type" value="">
            <?php if($test_type=="Sequence"):?>
              <option value ="Sequence" selected>Sequence</option>
              <option value ="Joint">Joint</option>
              <option value ="Sequence_vol_first">Sequence_vol_first</option>
            <?php endif;?>
            <?php if($test_type=="Joint"):?>
              <option value ="Sequence" >Sequence</option>
              <option value ="Joint" selected>Joint</option>
              <option value ="Sequence_vol_first">Sequence_vol_first</option>
            <?php endif;?>
            <?php if($test_type=="Sequence_vol_first"):?>
              <option value ="Sequence" >Sequence</option>
              <option value ="Joint">Joint</option>
              <option value ="Sequence_vol_first" selected>Sequence_vol_first</option>
            <?php endif;?>

            </select>
            <br />
          <!-- 3.7->3.8新增 -->
            <label>Voice Document:</label>
            <select name="voice_type" value="">
              <option value ="traffic" >traffic</option>
              <option value ="shopping_mall" >shopping mall</option>
              <option value ="bus_stop" >bus stop</option>
              <option value ="lobby" selected>lobby</option>
              <option value ="electricity" >electricity</option>
              <option value ="exchange" >exchange</option>
            </select>

           <div id="voice" style="margin:10px;color:#EEE;text-align:center">
            <label style="color:#000;">lobby:</label><br />
           	<audio id="bgAudio" style="margin:10px auto" loop controls>
           		 <source src="../public/mp3/lobby.mp3" type="audio/mp3" />
           		 Your browser does not support the <audio> element.
            </audio>
           </div>

            <script>
              $("document").ready(function(){
                $("select[name=voice_type]").change(function(){
                  $("#voice label").text($(this).val());
                  $("#bgAudio").attr("src","../public/mp3/" + $(this).val() + ".mp3");
                });

                $("select[name=voice_type]").find("option[value = <?php echo $voice_type;?>]").attr("selected", "selected");
                $("select[name=loudness_mapping_type]").find("option[value = <?php echo $voice_loudness_mapping_type;?>]").attr("selected", "selected");

                $("#voice label").text("<?php echo $voice_type;?>");
                $("#bgAudio").attr("src","../public/mp3/<?php echo $voice_type;?>.mp3");
              });
            </script>
            <!-- 新增结束-->

            <br />

            <!-- 3.8->3.9新增 -->
              <label>Loudness Mapping:</label>
              <select name="loudness_mapping_type" value="">
                <option value ="log_mode1" >log_mode1</option>
                <option value ="log_mode2" >log_mode2</option>
                <option value ="linear_mode1" >linear_mode1</option>
                <option value ="linear_mode2" >linear_mode2</option>
                <option value ="exp_mode1" >exp_mode1</option>
                <option value ="exp_mode2" >exp_mode2</option>
              </select>

              <br />
            <!-- 新增结束-->

            <input class="but" type="submit" name="submit" value="Save" onclick="">

              <!--
            <button id="start_test">
                <a href="./test/seqTest"> Start Test!</a>
            </button>
          -->
          <!--  <button action="admin/logout">Logout</button>!-->
        <!--    <button class="but" type="submit">登录</button> -->
        </form>
    </div>
</body>
</html>
