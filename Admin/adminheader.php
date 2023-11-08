<div id="topdivlogo">
<div id="titlediv">
<?php
$sql = "select banklogo,chk_no_from,chk_no_to,chk_taken_from from tb_cps_settings";
$row_setting = $db->get_row($sql);	
if(!empty($row_setting->banklogo)): ?>					
<img src = "../images/<?php echo $row_setting->banklogo; ?>" rel="" />	<br/>
<?php endif;?>	
Cheque Personalization System</div>
<div class="welcomeuser" style="float:right; margin-right:30px; margin-top:16px;">Welcome <?php echo $_SESSION['admin_username']; ?></div>
<div class="topright-menu">
	<div id="moonmenu" class="sub" >
		<ul>
			<li id="home"><a href="adminhome.php" >Home</a></li>
			<?php if($_SESSION['user_type']==0 || $_SESSION['user_type']==2) :?>
			<li><a href="#" rel="dropmenu1_e">Masters</a></li>
			<li><a href="#" rel="dropmenu2_e">Admin Menu</a></li>
			<?php endif;?>
			<li><a href="logoutadmin.php">Logout</a></li>                    
		</ul>
	</div>
</div>
</div>
	<div id="innerpage-maindiv">
    	<div class="clear">&nbsp;</div>
    	<div class="middle-maindiv">
        	<div class="middlesubdiv">        	  
        	  <!--1st drop down menu -->                                                   
                <div id="dropmenu1_e" class="dropmenudiv_e">
                    <a href="manage_accountholder.php" >Account Holder Master</a>                   
                </div>
				<div id="dropmenu2_e" class="dropmenudiv_e">
                    <a href="manage_CPSparameters.php" >CPS Parameters</a>  					
					<a href="manage_MapFields.php" >Mapping Parameters</a>
					<a href="manage_GrPermissions.php" >Group & Permissions</a>
                </div>
				
                <script type="text/javascript">
                //SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
                tabdropdown.init("moonmenu", 3)
                </script>
				
				<script type="text/javascript">
				
					var sPath = window.location.pathname;
					var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
					//alert(sPage);
					if(sPage == 'adminhome.php' || sPage == 'ADMINHOME.php')
					{
						document.getElementById('home').style.display = 'none';
					}

                </script>