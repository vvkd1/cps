<?php
	$sqlfootersettings = "select poweredby from tb_cps_settings";
	$poweredby = $db->get_var($sqlfootersettings);	
?>

<div style="width:100%; height:41px; float:left; padding-top:17px" align="center" class="name" >
	Powered by :- <?php echo $poweredby;$db->closeDb(); ?>
</div>
	