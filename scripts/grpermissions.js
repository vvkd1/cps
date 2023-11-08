function selectMaster(mastergrid,type)
{
	if(type == "mastersub")
	{
		if(document.getElementById("mastersub1_" + mastergrid).style.display == "none"){
			document.getElementById("mastersub1_" + mastergrid).style.display = "block";
		}else{
			document.getElementById("mastersub1_" + mastergrid).style.display = "none";
			document.getElementById("mastersub2_" + mastergrid).style.display = "none";
			
			for(i = 1; i < 12; i++){
				if(i != 2){
				document.getElementById("Master_"+i+"_" + mastergrid).checked = false;
				}else{
					document.getElementById("Master_"+i+"_" + mastergrid).checked = false;
				}
			}
			for(j = 33; j <= 41; j++){			
				document.getElementById("Master_"+ j +"_" + mastergrid).checked = false;
				k = j + 10;
				document.getElementById("Master_"+ k +"_" + mastergrid).checked = false;
				l = j + 20;
				document.getElementById("Master_"+ l +"_" + mastergrid).checked = false;
			}
		}				
	}
	else
	{
		if(type == "mastersuball")
		{
			if(document.getElementById("Master_1_" + mastergrid).checked == true){
				document.getElementById("mastersub2_" + mastergrid).style.display = "block";		
				document.getElementById("Master_2_" + mastergrid).checked = false;
				for(i = 3; i <= 11; i++){
					document.getElementById("Master_"+i+"_" + mastergrid).checked = true;
				}
				for(j = 33; j <= 41; j++){			
					document.getElementById("Master_"+ j +"_" + mastergrid).checked = true;
					k = j + 10;
					document.getElementById("Master_"+ k +"_" + mastergrid).checked = true;
					l = j + 20;
					document.getElementById("Master_"+ l +"_" + mastergrid).checked = true;
				}
			}
			else{
				for(i = 3; i <= 11; i++){
					document.getElementById("Master_"+i+"_" + mastergrid).checked = false;
				}
				for(j = 33; j <= 40; j++){			
					document.getElementById("Master_"+ j +"_" + mastergrid).checked = false;
					k = j + 10;
					document.getElementById("Master_"+ k +"_" + mastergrid).checked = false;
					l = j + 20;
					document.getElementById("Master_"+ l +"_" + mastergrid).checked = false;
				}
				document.getElementById("mastersub2_" + mastergrid).style.display = "none";
			}
		}
		else if(type == "mastersubpart")
		{
			if(document.getElementById("Master_2_" + mastergrid).checked == true){
				document.getElementById("mastersub2_" + mastergrid).style.display = "block";					
				for(i = 1; i < 12; i++){
					if(i != 2){
					document.getElementById("Master_"+i+"_" + mastergrid).checked = false;
					}else{
						document.getElementById("Master_"+i+"_" + mastergrid).checked = true;
					}
				}
				for(j = 33; j <= 41; j++){			
					document.getElementById("Master_"+ j +"_" + mastergrid).checked = false;
					k = j + 10;
					document.getElementById("Master_"+ k +"_" + mastergrid).checked = false;
					l = j + 20;
					document.getElementById("Master_"+ l +"_" + mastergrid).checked = false;
				}
			}else{
			
			document.getElementById("mastersub2_" + mastergrid).style.display = "none";
			
			}
		}
	}
	
	
}




function selectTranactions(transgrid,type)
{
	if(type == "tranactionsub")
	{
		if(document.getElementById("Tranactions_0_" + transgrid).checked == true){
			document.getElementById("Tranactionssub1_" + transgrid).style.display = "block";
			for(i = 1; i <= 4; i++){
				document.getElementById("Tranactions_"+i+"_" + transgrid).checked = false;
			}
		}else{
			document.getElementById("Tranactionssub1_" + transgrid).style.display = "none";
			document.getElementById("Tranactionssub2_" + transgrid).style.display = "none";
			for(i = 1; i <= 4; i++){
				document.getElementById("Tranactions_"+i+"_" + transgrid).checked = true;
			}
		}
	}
	else
	{
		if(type == "tranactionsuball")
		{
			if(document.getElementById("Tranactions_1_" + transgrid).checked == true){
				document.getElementById("Tranactionssub2_" + transgrid).style.display = "block";		
				document.getElementById("Tranactions_3_" + transgrid).checked = true;
				document.getElementById("Tranactions_4_" + transgrid).checked = true;
				document.getElementById("Tranactions_2_" + transgrid).checked = false;
			}
			else{
				document.getElementById("Tranactionssub2_" + transgrid).style.display = "none";		
				document.getElementById("Tranactions_3_" + transgrid).checked = false;
				document.getElementById("Tranactions_4_" + transgrid).checked = false;
				document.getElementById("Tranactions_2_" + transgrid).checked = false;
			}
		}
		else if(type == "tranactionsubpart")
		{
			if(document.getElementById("Tranactions_2_" + transgrid).checked == true){
				document.getElementById("Tranactionssub2_" + transgrid).style.display = "block";		
				document.getElementById("Tranactions_3_" + transgrid).checked = false;
				document.getElementById("Tranactions_4_" + transgrid).checked = false;
				document.getElementById("Tranactions_1_" + transgrid).checked = false;
			}else{
				document.getElementById("Tranactionssub2_" + transgrid).style.display = "none";		
			}
		}
	}
}

function selectreport(reportgrid,type)
{			
	if(type == "reportsub")
	{
		
		if(document.getElementById("Reports_0_" + reportgrid).checked == true){
			document.getElementById("reportssub1_" + reportgrid).style.display = "block";
			for(i = 1; i <= 6; i++){
				document.getElementById("Reports_"+i+"_" + reportgrid).checked = false;
			}
		}else{
			document.getElementById("reportssub1_" + reportgrid).style.display = "none";
			document.getElementById("reportssub2_" + reportgrid).style.display = "none";
			for(i = 1; i <= 6; i++){
				document.getElementById("Reports_"+i+"_" + reportgrid).checked = true;
			}
		}
	}
	else
	{
		if(type == "reportsuball")
		{
			if(document.getElementById("Reports_1_" + reportgrid).checked == true){
				document.getElementById("reportssub2_" + reportgrid).style.display = "block";
				for(i = 3; i <= 6; i++){
					document.getElementById("Reports_"+i+"_" + reportgrid).checked = true;
				}
				document.getElementById("Reports_2_" + reportgrid).checked = false;
			}else{
				document.getElementById("reportssub2_" + reportgrid).style.display = "none";		
				for(i = 2; i <= 6; i++){
					document.getElementById("Reports_"+i+"_" + reportgrid).checked = false;
				}
			}
			
		}
		else if(type == "reportsubpart")
		{
			if(document.getElementById("Reports_2_" + reportgrid).checked == true){
				document.getElementById("reportssub2_" + reportgrid).style.display = "block";	
				
				for(i = 1; i <= 6; i++){
					if(i != 2){
					document.getElementById("Reports_"+i+"_" + reportgrid).checked = false;
					}
				}				
			}
			else{
				document.getElementById("reportssub2_" + reportgrid).style.display = "none";	
			}
			
		}
	}
}

function selectuser(usergrid,type)
{
	if(type == "usersub")
	{
		if(document.getElementById("usersub1_" + usergrid).style.display == "none"){
			document.getElementById("usersub1_" + usergrid).style.display = "block";
		}else{
			document.getElementById("usersub1_" + usergrid).style.display = "none";
			document.getElementById("usersub2_" + usergrid).style.display = "none";
			
			for(i = 1; i < 4; i++){
				if(i != 2){
				document.getElementById("User_"+i+"_" + usergrid).checked = false;
				}else{
					document.getElementById("User_"+i+"_" + usergrid).checked = false;
				}
			}
			for(j = 33; j <= 34; j++){			
				document.getElementById("User_"+ j +"_" + usergrid).checked = false;
				k = j + 10;
				document.getElementById("User_"+ k +"_" + usergrid).checked = false;
				l = j + 20;
				document.getElementById("User_"+ l +"_" + usergrid).checked = false;
			}
		}	
	}
	else
	{
		if(type == "usersuball")
		{			
			if(document.getElementById("User_1_" + usergrid).checked == true){
				document.getElementById("usersub2_" + usergrid).style.display = "block";		
				document.getElementById("User_2_" + usergrid).checked = false;
				for(i = 3; i <= 4; i++){
					document.getElementById("User_"+i+"_" + usergrid).checked = true;
				}
				for(j = 33; j <= 34; j++){			
					document.getElementById("User_"+ j +"_" + usergrid).checked = true;
					k = j + 10;
					document.getElementById("User_"+ k +"_" + usergrid).checked = true;
					l = j + 20;
					document.getElementById("User_"+ l +"_" + usergrid).checked = true;
				}
			}
			else{
				for(i = 3; i <= 4; i++){
					document.getElementById("User_"+i+"_" + usergrid).checked = false;
				}
				for(j = 33; j <= 34; j++){			
					document.getElementById("User_"+ j +"_" + usergrid).checked = false;
					k = j + 10;
					document.getElementById("User_"+ k +"_" + usergrid).checked = false;
					l = j + 20;
					document.getElementById("User_"+ l +"_" + usergrid).checked = false;
				}
				document.getElementById("usersub2_" + usergrid).style.display = "none";
			}
			
		}
		else if(type == "usersubpart")
		{			
			if(document.getElementById("User_2_" + usergrid).checked == true){
				document.getElementById("usersub2_" + usergrid).style.display = "block";

				for(j = 33; j <= 34; j++){			
					document.getElementById("User_"+ j +"_" + usergrid).checked = false;
					k = j + 10;
					document.getElementById("User_"+ k +"_" + usergrid).checked = false;
					l = j + 20;
					document.getElementById("User_"+ l +"_" + usergrid).checked = false;
				}
				
				for(i = 1; i <= 5; i++){
					if(i != 2){
					document.getElementById("User_"+i+"_" + usergrid).checked = false;
					}else{
						document.getElementById("User_"+i+"_" + usergrid).checked = true;
					}
				}
				
			}else{
			
			document.getElementById("usersub2_" + usergrid).style.display = "none";
			
			}
			
		}
	}
}
function selectAdmin(adminid)
{
	if(document.getElementById("Admin_0_" + adminid).checked == true){
		document.getElementById("Admin1_" + adminid).style.display = "block";
	}else{
		document.getElementById("Admin1_" + adminid).style.display = "none";
		document.getElementById("Admin_22_" + adminid).checked = false
		document.getElementById("Admin_32_" + adminid).checked = false
		document.getElementById("Admin_42_" + adminid).checked = false
	}
}

function selectRemoveDup(removedupid)
{
	document.getElementById("RemoveDup1_" + removedupid).style.display = "block";
}

function setall()
{
	var grpids = document.getElementById("grid").value;
	var idarry = new Array();
	idarry = grpids.split(",");		
	var alldata = "";
	var i;
	for(i = 0; i < idarry.length; i++)
	{
		if(document.getElementById("Master_3_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "bank_master" + "-";
			if(document.getElementById("Master_33_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_43_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_53_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		if(document.getElementById("Master_4_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "branch_master" + "-";
			if(document.getElementById("Master_34_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_44_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_54_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		if(document.getElementById("Master_5_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "country_master" + "-";
			if(document.getElementById("Master_35_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_45_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_55_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		if(document.getElementById("Master_6_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "state_master" + "-";
			if(document.getElementById("Master_36_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_46_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_56_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		if(document.getElementById("Master_7_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "city_master" + "-";
			if(document.getElementById("Master_37_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_47_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_57_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";	
		}
		if(document.getElementById("Master_8_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "Suburb_master" + "-";
			if(document.getElementById("Master_38_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_48_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_58_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		if(document.getElementById("Master_9_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "transaction_master" + "-";
			if(document.getElementById("Master_39_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_49_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_59_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		if(document.getElementById("Master_10_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "chkserise_master" + "-";
			if(document.getElementById("Master_40_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_50_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_60_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		if(document.getElementById("Master_11_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "map_field" + "-";
			if(document.getElementById("Master_41_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_51_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Master_61_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		if(document.getElementById("Tranactions_3_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "upload_file" + "-" + "Y" + "-" + "Y" + "-" + "Y" +",";
		if(document.getElementById("Tranactions_4_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "reprint_request" + "-" + "Y" + "-" + "Y" + "-" + "Y" +",";
		if(document.getElementById("Reports_3_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "printed_report" + "-" + "Y" + "-" + "Y"  + "-"+ "Y" + ",";
		if(document.getElementById("Reports_4_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "pending_report" + "-" + "Y" + "-" + "Y" + "-"+ "Y" + ",";
		if(document.getElementById("Reports_5_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "accountwise_report" + "-" + "Y" + "-" + "Y" + "-"+ "Y" + ",";
		if(document.getElementById("Reports_6_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "print_preview" + "-" + "Y" + "-" + "Y" + "-"+ "Y" + ",";
		if(document.getElementById("User_3_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "manageuser_account" + "-";
			if(document.getElementById("User_33_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("User_43_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("User_53_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		if(document.getElementById("User_4_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "change_password" + "-";
			if(document.getElementById("User_34_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("User_44_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("User_54_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		if(document.getElementById("Admin_0_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "Admin" + "-";
			if(document.getElementById("Admin_22_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Admin_32_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("Admin_42_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}
		/*if(document.getElementById("RemoveDup_0_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "Remove_Dup" + "-";
			if(document.getElementById("RemoveDup_11_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("RemoveDup_21_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += "-";
			if(document.getElementById("RemoveDup_31_" + idarry[i]).checked == true){
				alldata += "Y";
			}else{
				alldata += "N";
			};
			alldata += ",";
		}*/
	}
	document.getElementById("allselectdata").value = alldata;
}

function mastersubselect(mastergrid,parentid,id,type)
{
	document.getElementById("Master_2_" + mastergrid).checked = true;
	document.getElementById("Master_1_" + mastergrid).checked = false;
	if(type == "selectchild"){
		for(i = 0; i < id; i++){
			if(document.getElementById("Master_"+ parentid +"_" + mastergrid).checked == true){
				document.getElementById("Master_"+ id +"_" + mastergrid).checked = true;
				id = id + 10;
				document.getElementById("Master_"+ id +"_" + mastergrid).checked = true;
				id = id + 10;
				document.getElementById("Master_"+ id +"_" + mastergrid).checked = true;
			}else{
				document.getElementById("Master_"+ id +"_" + mastergrid).checked = false;
				id = id+10;
				document.getElementById("Master_"+ id +"_" + mastergrid).checked = false;
				id = id+10;
				document.getElementById("Master_"+ id +"_" + mastergrid).checked = false;
			}
			i = id;
		}
	}
	else if(type == "selectparent"){
		document.getElementById("Master_"+ parentid +"_" + mastergrid).checked = true;
	}	
}

function profilesubselect(profilegrid,parentid,id,type)
{
	document.getElementById("User_2_" + profilegrid).checked = true;
	document.getElementById("User_1_" + profilegrid).checked = false;
	if(type == "selectchild"){
		for(i = 0; i < id; i++){
			if(document.getElementById("User_"+ parentid +"_" + profilegrid).checked == true){
				document.getElementById("User_"+ id +"_" + profilegrid).checked = true;
				id = id + 10;
				document.getElementById("User_"+ id +"_" + profilegrid).checked = true;
				id = id + 10;
				document.getElementById("User_"+ id +"_" + profilegrid).checked = true;
			}else{
				document.getElementById("User_"+ id +"_" + profilegrid).checked = false;
				id = id+10;
				document.getElementById("User_"+ id +"_" + profilegrid).checked = false;
				id = id+10;
				document.getElementById("User_"+ id +"_" + profilegrid).checked = false;
			}
			i = id;
		}
	}
	else if(type == "selectparent"){
		document.getElementById("User_"+ parentid +"_" + profilegrid).checked = true;
	}	
}


