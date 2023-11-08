<div id="topdivlogo">
<div id="titlediv">
<?php
$sql = "select banklogo,chk_no_from,chk_no_to,chk_taken_from from tb_cps_settings";
$row_setting = $db->get_row($sql);	
if(!empty($row_setting->banklogo)): ?>					
<img src = "images/<?php echo $row_setting->banklogo; ?>" rel="" />	<br/>
<?php endif;?>
Cheque Personalization System</div>
<div class="welcomeuser" style="float:right; margin-right:30px; margin-top:16px;">Welcome <?php echo $_SESSION['admin_username']; ?></div>
<div class="topright-menu">
	<div id="moonmenu" class="sub" >
		<ul>

			<li id="home"><a href="home.php" >Home</a></li>
			<?php if($_SESSION['user_type']==2){ ?>
			<li id="dashboard"><a href="dashboard.php" >Dashboard</a></li>
			<?php } ?>
			<?php if($_SESSION['user_type']==2){
						echo '<li><a href="#" rel="dropmenu1_e">Masters</a></li>';

					}	
				?>

			<?php if($_SESSION['user_type']==0||$_SESSION['user_type']==2){ ?>
						
				<li><a href="#" rel="dropmenu2_e">Transaction</a></li>
				<li><a href="#" rel="dropmenu3_e">Reports</a></li>

			<?php } ?>			
			<?php
				if($_SESSION['user_type']==2){
				echo '<li><a href="#" rel="dropmenu4_e">Profile Management</a></li>';
				}
			?>
			
			<!-- bhavin start 09-12-14 CR1 -->
			
			<!--changesettings.php-->
			<!-- bhavin end -->
			<!--<li><a href="#" rel="dropmenu5_e">HELP</a></li>-->
			<?php if($_SESSION['user_type']==1){ ?>
			<li><a href="processreprintrequest.php">Reprint Requests</a></li>
			<li><a href="processsingleleaf.php">Reprint Single Leaf</a></li>
			<?php } ?>
			<li><a href="" rel="dropmenu6_e" <?php echo authentication_groups_pemissions("Admin","menu","Y");?> >Admin</a></li> 
			<li><a href="changepassword.php">Change password</a></li>
			<li><a href="help.php">Help</a></li>
			
			<li><a href="logout.php">Logout</a></li>
			<!--  <li><a href="#">Tools</a></li>-->                       
		</ul>
	</div>
</div>
</div>
	<div id="innerpage-maindiv">
    	<div class="clear">&nbsp;</div>
    	<div class="middle-maindiv">
        	<div class="middlesubdiv">
        	  
        	  <!--1st drop down menu -->   
        	  <?php if($_SESSION['user_type']==2){ ?>
                <div id="dropmenu1_e" class="dropmenudiv_e">
                    <a href="manage_country.php" <?php echo authentication_groups_pemissions("country_master","menu","Y");?>>Country Master</a>
					<a href="manage_state.php" <?php echo authentication_groups_pemissions("state_master","menu","Y");?>>State/Province Master</a>
                    <a href="manage_cityplace.php" <?php echo authentication_groups_pemissions("city_master","menu","Y");?>>City Master</a>
					<a href="manage_suburb.php" <?php echo authentication_groups_pemissions("Suburb_master","menu","Y");?>>Location Master</a>
					<a href="bankmaster.php" <?php echo authentication_groups_pemissions("bank_master","menu","Y");?> >Bank Master</a>
                    <a href="manage_branches.php" <?php echo authentication_groups_pemissions("branch_master","menu","Y");?> >Branch Master</a>
					<a href="manage_transaction.php" <?php echo authentication_groups_pemissions("transaction_master","menu","Y");?> >Transaction Code Master</a>
					<a href="manage_chequeseries.php" <?php echo authentication_groups_pemissions("chkserise_master","menu","Y");?>>Cheque Series Master</a>
					<!--<a href="manage_customer.php">Customer Master</a>-->
                </div>
            	<?php } ?>
                
                <?php
				if($_SESSION['user_type']==0||$_SESSION['user_type']==2){ ?>
                <div id="dropmenu2_e" class="dropmenudiv_e">
                    <!-- <a href="uploadfile.php" <?php echo authentication_groups_pemissions("upload_file","menu","Y");?> >Upload & Print</a> -->
					 <a href="parsikupload.php" <?php echo authentication_groups_pemissions("upload_file","menu","Y");?> >Upload & Print With Text File</a>
					<a href="reprint.php" <?php //echo authentication_groups_pemissions("reprint_request","menu","Y");?> >Reprint Request</a>
					<!--<a href="personalprint.php" <?php //echo authentication_groups_pemissions("reprint_request","menu","Y");?> >Manual Print</a>-->
					<a href="personalprint.php" <?php //echo authentication_groups_pemissions("reprint_request","menu","Y");?> >Manual Print</a>
				</div>
				
                <div id="dropmenu3_e" class="dropmenudiv_e">
					<a href="printedreportdaywise.php" <?php echo authentication_groups_pemissions("printed_report","menu","Y");?> >Printed Report For The Day</a>
                    <a href="printedreport.php" <?php echo authentication_groups_pemissions("printed_report","menu","Y");?> >Printed Report For Selected Period</a>
					<!--<a href="printedreportdetailview.php" <?php echo authentication_groups_pemissions("printed_report","menu","Y");?> >Printed Report For The Day Detail View</a>
                    <a href="printedreportdetailview.php" <?php echo authentication_groups_pemissions("printed_report","menu","Y");?> >Printed Report For Selected Period Detail View</a>					
                    <a href="printpendingrequest.php" <?php echo authentication_groups_pemissions("pending_report","menu","Y");?> >Cheque Pending Request Report</a>-->
					<!--<a href="consolidatedreport.php" <?php echo authentication_groups_pemissions("accountwise_report","menu","Y");?> >Consolidated Report</a>-->
					<!--<a href="printedreportdetailview.php">Printed Report Of The Day / Detail View</a>-->
					<a href="reprintedreport.php">Reprint Report</a>
					<a href="report_type_customer.php">Customer Report</a>
                    <a href="outputfile.php">Output File</a>
                    <a href="parsikoutputfile.php">Output File via Text</a>
                    <a href="printingorder.php">Printing Order</a>
                </div>

                <?php } ?>

                <?php if($_SESSION['user_type']==2){ ?>
                <div id="dropmenu4_e" class="dropmenudiv_e">
                    <!--<a href="#">Change Password</a>-->
                    <a href="manage_useraccount.php" <?php echo authentication_groups_pemissions("manageuser_account","menu","Y");?>  >Manage User Account</a>
					<!--<a href="#" <?php //echo authentication_groups_pemissions("change_password","menu","Y");?>  >Change Password</a>-->
                    <!--<a href="adduserreprint.php">Add User RePrint Account</a>-->
                </div>
                <?php } ?>
				<div id="dropmenu5_e" class="dropmenudiv_e">
                    <a href="help.php">Help</a>
                    <a href="viewlicensedetails.php">View Licences Details</a>
                </div>
				<!-- bhavin start 09-12-14 CR1 -->
				<div id="dropmenu6_e" class="dropmenudiv_e">
                    <a href="backup.php">Backup</a>
                    <a href="tonersetting.php">Toner Setting</a>
                </div>
				<!-- bhavin end -->
				
				<script type="text/javascript">
                //SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
                tabdropdown.init("moonmenu", 3)
                </script>
				
				<script type="text/javascript">
				
					var sPath = window.location.pathname;
					var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
					//alert(sPage);
					if(sPage == 'home.php' || sPage == 'HOME.php')
					{
						document.getElementById('home').style.display = 'none';
					}

                </script>