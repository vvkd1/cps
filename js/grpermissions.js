function selectMaster(mastergrid,type)
{
	
	if(type == "mastersub")
	{
		document.getElementById("mastersub1_" + mastergrid).style.display = "block";	
	}
	else
	{
		if(type == "mastersuball")
		{
			document.getElementById("mastersub2_" + mastergrid).style.display = "block";		
			document.getElementById("Master_2_" + mastergrid).checked = false;
			document.getElementById("Master_3_" + mastergrid).checked = true;
			document.getElementById("Master_4_" + mastergrid).checked = true;
			document.getElementById("Master_5_" + mastergrid).checked = true;
			document.getElementById("Master_6_" + mastergrid).checked = true;
			document.getElementById("Master_7_" + mastergrid).checked = true;
			document.getElementById("Master_8_" + mastergrid).checked = true;
			document.getElementById("Master_9_" + mastergrid).checked = true;
		}
		else if(type == "mastersubpart")
		{
			document.getElementById("mastersub2_" + mastergrid).style.display = "block";		
			document.getElementById("Master_1_" + mastergrid).checked = false;
			document.getElementById("Master_3_" + mastergrid).checked = false;
			document.getElementById("Master_4_" + mastergrid).checked = false;
			document.getElementById("Master_5_" + mastergrid).checked = false;
			document.getElementById("Master_6_" + mastergrid).checked = false;
			document.getElementById("Master_7_" + mastergrid).checked = false;
			document.getElementById("Master_8_" + mastergrid).checked = false;
			document.getElementById("Master_9_" + mastergrid).checked = false;
		}
	}
}

function selectTranactions(transgrid)
{
	document.getElementById("Tranactionssub1_" + transgrid).style.display = "block";
	if(document.getElementById("Tranactions_0_" + transgrid).checked == true){
		document.getElementById("Tranactions_1_" + transgrid).checked = true;
	}
}

function selectreport(reportgrid,type)
{			
	if(type == "reportsub")
	{
		document.getElementById("reportssub1_" + reportgrid).style.display = "block";	
	}
	else
	{
		if(type == "reportsuball")
		{
			document.getElementById("reportssub2_" + reportgrid).style.display = "block";		
			document.getElementById("Reports_3_" + reportgrid).checked = true;
			document.getElementById("Reports_4_" + reportgrid).checked = true;
			document.getElementById("Reports_5_" + reportgrid).checked = true;
			document.getElementById("Reports_6_" + reportgrid).checked = true;
			document.getElementById("Reports_2_" + reportgrid).checked = false;
			
		}
		else if(type == "reportsubpart")
		{
			document.getElementById("reportssub2_" + reportgrid).style.display = "block";		
			document.getElementById("Reports_3_" + reportgrid).checked = false;
			document.getElementById("Reports_4_" + reportgrid).checked = false;
			document.getElementById("Reports_5_" + reportgrid).checked = false;
			document.getElementById("Reports_6_" + reportgrid).checked = false;
			document.getElementById("Reports_1_" + reportgrid).checked = false;
			
		}
	}
}

function selectuser(usergrid,type)//usersuball
{
	if(type == "usersub")
	{
		document.getElementById("usersub1_" + usergrid).style.display = "block";	
	}
	else
	{
		if(type == "usersuball")
		{
			document.getElementById("usersub2_" + usergrid).style.display = "block";		
			document.getElementById("User_3_" + usergrid).checked = true;
			document.getElementById("User_4_" + usergrid).checked = true;
			document.getElementById("User_5_" + usergrid).checked = true;
			document.getElementById("User_2_" + usergrid).checked = false;
			
		}
		else if(type == "usersubpart")
		{
			document.getElementById("usersub2_" + usergrid).style.display = "block";
			document.getElementById("User_3_" + usergrid).checked = false;
			document.getElementById("User_4_" + usergrid).checked = false;
			document.getElementById("User_5_" + usergrid).checked = false;
			document.getElementById("User_1_" + usergrid).checked = false;
			
		}
	}
}
function selectAdmin(adminid)
{
	document.getElementById("Admin1_" + adminid).style.display = "block";
}

function setall()
{
	var grpcount = document.getElementById("grcount").value;
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
		if(document.getElementById("Tranactions_1_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "upload_file" + "-" + "Y" + "-" + "Y" + "-" + "Y" +",";
		if(document.getElementById("Reports_3_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "printed_report" + "-" + "Y" + "-" + "Y"  + "-"+ "Y" + ",";
		if(document.getElementById("Reports_4_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "pending_report" + "-" + "Y" + "-" + "Y" + "-"+ "Y" + ",";
		if(document.getElementById("Reports_5_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "accountwise_report" + "-" + "Y" + "-" + "Y" + "-"+ "Y" + ",";
		if(document.getElementById("Reports_6_" + idarry[i]).checked == true)
			alldata = alldata + idarry[i] + "-" + "print_preview" + "-" + "Y" + "-" + "Y" + "-"+ "Y" + ",";
		if(document.getElementById("User_3_" + idarry[i]).checked == true){
			alldata = alldata + idarry[i] + "-" + "adduser_account" + "-";
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
	}
	alert(alldata);
	document.getElementById("allselectdata").value = alldata;
}
