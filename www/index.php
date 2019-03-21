<?php

#########################################################################
#                                                                       #
# SAR2HTML 3.2.1                                                        #
#                                                                       #
# Written by Cem TAN                                               	#
# Mail address: tan.cem@gmail.com                                       #
#                                                                       #
#                                                                       #
# SAR based performance reporting tool. It produces html file and       #
# graphics in png format under plot directory                           #
#                                                                       #
#########################################################################
include('sarFILE/secure/SSH2.php');
include('sarFILE/secure/SFTP.php');
require('sarFILE/secure/bookmark.php' );

session_start();
$task = "";
if (isset($_POST['task'])) { $task = $_POST['task']; }
class OPTIONS {
	var $SA_Redhat_3 = 'b B c d I_SUM n_DEV n_EDEV n_SOCK P_ALL q r R v w W y';
		var $SA_Redhat_3_b = 'I/O Rates';
		var $SA_Redhat_3_B = 'Paging Statistics';
		var $SA_Redhat_3_c = 'Process Creation Activity';
		var $SA_Redhat_3_d = 'Disk I/O & Statistics';
		var $SA_Redhat_3_I_SUM = 'Interrupt Activity';
		var $SA_Redhat_3_n_DEV = 'Network I/O & Statistics';
		var $SA_Redhat_3_n_EDEV = 'Network Error Statistics';
		var $SA_Redhat_3_n_SOCK = 'Network Socket Statistics';
		var $SA_Redhat_3_P_ALL = 'Processor Activity';
		var $SA_Redhat_3_q = 'Process Queue';
		var $SA_Redhat_3_r = 'Memory & Swap Utilization';
		var $SA_Redhat_3_R = 'Memory Statistics';
		var $SA_Redhat_3_v = 'Kernel Tables';
		var $SA_Redhat_3_w = 'System Switching Activity';
		var $SA_Redhat_3_W = 'Swapping Statistics';
		var $SA_Redhat_3_y = 'TTY Device Activity';

	var $SA_Redhat_4 = 'b B c d I_SUM n_DEV n_EDEV n_SOCK P_ALL q r R v w W y';
		var $SA_Redhat_4_b = 'I/O Rates';
		var $SA_Redhat_4_B = 'Paging Statistics';
		var $SA_Redhat_4_c = 'Process Creation Activity';
		var $SA_Redhat_4_d = 'Disk I/O & Statistics';
		var $SA_Redhat_4_I_SUM = 'Interrupt Activity';
		var $SA_Redhat_4_n_DEV = 'Network I/O & Statistics';
		var $SA_Redhat_4_n_EDEV = 'Network Error Statistics';
		var $SA_Redhat_4_n_SOCK = 'Network Socket Statistics';
		var $SA_Redhat_4_P_ALL = 'Processor Activity';
		var $SA_Redhat_4_q = 'Process Queue';
		var $SA_Redhat_4_r = 'Memory & Swap Utilization';
		var $SA_Redhat_4_R = 'Memory Statistics';
		var $SA_Redhat_4_v = 'Kernel Tables';
		var $SA_Redhat_4_w = 'System Switching Activity';
		var $SA_Redhat_4_W = 'Swapping Statistics';
		var $SA_Redhat_4_y = 'TTY Device Activity';

	var $SA_Redhat_5 = 'b B c d I_SUM n_DEV n_EDEV n_NFS n_NFSD n_SOCK P_ALL q r R v w W y';
		var $SA_Redhat_5_b = 'I/O Rates';
		var $SA_Redhat_5_B = 'Paging Statistics';
		var $SA_Redhat_5_c = 'Process Creation Activity';
		var $SA_Redhat_5_d = 'Disk I/O & Statistics';
		var $SA_Redhat_5_I_SUM = 'Interrupt Activity';
		var $SA_Redhat_5_n_DEV = 'Network I/O & Statistics';
		var $SA_Redhat_5_n_EDEV = 'Network Error Statistics';
		var $SA_Redhat_5_n_NFS = 'NFS Statistics';
		var $SA_Redhat_5_n_NFSD = 'NFSD Statistics';
		var $SA_Redhat_5_n_SOCK = 'Network Socket Statistics';
		var $SA_Redhat_5_P_ALL = 'Processor Activity';
		var $SA_Redhat_5_q = 'Process Queue';
		var $SA_Redhat_5_r = 'Memory & Swap Utilization';
		var $SA_Redhat_5_R = 'Memory Statistics';
		var $SA_Redhat_5_v = 'Kernel Tables';
		var $SA_Redhat_5_w = 'System Switching Activity';
		var $SA_Redhat_5_W = 'Swapping Statistics';
		var $SA_Redhat_5_y = 'TTY Device Activity';

	var $SA_Redhat_6 = 'b B d I_SUM n_DEV n_EDEV n_NFS n_NFSD n_SOCK P_ALL q r R S v w W y';
		var $SA_Redhat_6_b = 'I/O Rates';
		var $SA_Redhat_6_B = 'Paging Statistics';
		var $SA_Redhat_6_d = 'Disk I/O & Statistics';
		var $SA_Redhat_6_I_SUM = 'Interrupt Activity';
		var $SA_Redhat_6_n_DEV = 'Network I/O & Statistics';
		var $SA_Redhat_6_n_EDEV = 'Network Error Statistics';
		var $SA_Redhat_6_n_NFS = 'NFS Statistics';
		var $SA_Redhat_6_n_NFSD = 'NFSD Statistics';
		var $SA_Redhat_6_n_SOCK = 'Network Socket Statistics';
		var $SA_Redhat_6_P_ALL = 'Processor Activity';
		var $SA_Redhat_6_q = 'Process Queue';
		var $SA_Redhat_6_r = 'Memory & Swap Utilization';
		var $SA_Redhat_6_R = 'Memory Statistics';
		var $SA_Redhat_6_S = 'Swap Utilization';
		var $SA_Redhat_6_v = 'Kernel Tables';
		var $SA_Redhat_6_w = 'System Switching Activity';
		var $SA_Redhat_6_W = 'Swapping Statistics';
		var $SA_Redhat_6_y = 'TTY Device Activity';

        var $SA_Redhat_7 = 'b B d n_DEV n_EDEV n_NFS n_NFSD n_SOCK P_ALL q r R H S v w W y';
                var $SA_Redhat_7_b = 'I/O Rates';
                var $SA_Redhat_7_B = 'Paging Statistics';
                var $SA_Redhat_7_d = 'Disk I/O & Statistics';
                var $SA_Redhat_7_H = 'Hugepage Utilization';
                var $SA_Redhat_7_n_DEV = 'Network I/O & Statistics';
                var $SA_Redhat_7_n_EDEV = 'Network Error Statistics';
                var $SA_Redhat_7_n_NFS = 'NFS Statistics';
                var $SA_Redhat_7_n_NFSD = 'NFSD Statistics';
                var $SA_Redhat_7_n_SOCK = 'Network Socket Statistics';
                var $SA_Redhat_7_P_ALL = 'Processor Activity';
                var $SA_Redhat_7_q = 'Process Queue';
                var $SA_Redhat_7_r = 'Memory & Swap Utilization';
                var $SA_Redhat_7_R = 'Memory Statistics';
                var $SA_Redhat_7_S = 'Swap Utilization';
                var $SA_Redhat_7_v = 'Kernel Tables';
                var $SA_Redhat_7_w = 'System Switching Activity';
                var $SA_Redhat_7_W = 'Swapping Statistics';
                var $SA_Redhat_7_y = 'TTY Device Activity';

	var $SA_Suse_8 = 'b B c d I_SUM n_DEV n_EDEV n_SOCK U_ALL q r R v w W y';
		var $SA_Suse_8_b = 'I/O Rates';
		var $SA_Suse_8_B = 'Paging Statistics';
		var $SA_Suse_8_c = 'Process Creation Activity';
		var $SA_Suse_8_d = 'Disk I/O & Statistics';
		var $SA_Suse_8_I_SUM = 'Interrupt Activity';
		var $SA_Suse_8_n_DEV = 'Network I/O & Statistics';
		var $SA_Suse_8_n_EDEV = 'Network Error Statistics';
		var $SA_Suse_8_n_SOCK = 'Network Socket Statistics';
		var $SA_Suse_8_U_ALL = 'Processor Activity';
		var $SA_Suse_8_q = 'Process Queue';
		var $SA_Suse_8_r = 'Memory & Swap Utilization';
		var $SA_Suse_8_R = 'Memory Statistics';
		var $SA_Suse_8_v = 'Kernel Tables';
		var $SA_Suse_8_w = 'System Switching Activity';
		var $SA_Suse_8_W = 'Swapping Statistics';
		var $SA_Suse_8_y = 'TTY Device Activity';

	var $SA_Suse_9 = 'b B c d I_SUM n_DEV n_EDEV n_SOCK P_ALL q r R v w W y';
		var $SA_Suse_9_b = 'I/O Rates';
		var $SA_Suse_9_B = 'Paging Statistics';
		var $SA_Suse_9_c = 'Process Creation Activity';
		var $SA_Suse_9_d = 'Disk I/O & Statistics';
		var $SA_Suse_9_I_SUM = 'Interrupt Activity';
		var $SA_Suse_9_n_DEV = 'Network I/O & Statistics';
		var $SA_Suse_9_n_EDEV = 'Network Error Statistics';
		var $SA_Suse_9_n_SOCK = 'Network Socket Statistics';
		var $SA_Suse_9_P_ALL = 'Processor Activity';
		var $SA_Suse_9_q = 'Process Queue';
		var $SA_Suse_9_r = 'Memory & Swap Utilization';
		var $SA_Suse_9_R = 'Memory Statistics';
		var $SA_Suse_9_v = 'Kernel Tables';
		var $SA_Suse_9_w = 'System Switching Activity';
		var $SA_Suse_9_W = 'Swapping Statistics';
		var $SA_Suse_9_y = 'TTY Device Activity';

	var $SA_Suse_10 = 'b B c d I_SUM n_DEV n_EDEV n_NFS n_NFSD n_SOCK P_ALL q r R v w W y';
		var $SA_Suse_10_b = 'I/O Rates';
		var $SA_Suse_10_B = 'Paging Statistics';
		var $SA_Suse_10_c = 'Process Creation Activity';
		var $SA_Suse_10_d = 'Disk I/O & Statistics';
		var $SA_Suse_10_I_SUM = 'Interrupt Activity';
		var $SA_Suse_10_n_DEV = 'Network I/O & Statistics';
		var $SA_Suse_10_n_EDEV = 'Network Error Statistics';
		var $SA_Suse_10_n_NFS = 'NFS Statistics';
		var $SA_Suse_10_n_NFSD = 'NFSD Statistics';
		var $SA_Suse_10_n_SOCK = 'Network Socket Statistics';
		var $SA_Suse_10_P_ALL = 'Processor Activity';
		var $SA_Suse_10_q = 'Process Queue';
		var $SA_Suse_10_r = 'Memory & Swap Utilization';
		var $SA_Suse_10_R = 'Memory Statistics';
		var $SA_Suse_10_v = 'Kernel Tables';
		var $SA_Suse_10_w = 'System Switching Activity';
		var $SA_Suse_10_W = 'Swapping Statistics';
		var $SA_Suse_10_y = 'TTY Device Activity';

	var $SA_Suse_11 = 'b B d I_SUM n_DEV n_EDEV n_NFS n_NFSD n_SOCK P_ALL q r R S v w W y';
		var $SA_Suse_11_b = 'I/O Rates';
		var $SA_Suse_11_B = 'Paging Statistics';
		var $SA_Suse_11_d = 'Disk I/O & Statistics';
		var $SA_Suse_11_I_SUM = 'Interrupt Activity';
		var $SA_Suse_11_n_DEV = 'Network I/O & Statistics';
		var $SA_Suse_11_n_EDEV = 'Network Error Statistics';
		var $SA_Suse_11_n_NFS = 'NFS Statistics';
		var $SA_Suse_11_n_NFSD = 'NFSD Statistics';
		var $SA_Suse_11_n_SOCK = 'Network Socket Statistics';
		var $SA_Suse_11_P_ALL = 'Processor Activity';
		var $SA_Suse_11_q = 'Process Queue';
		var $SA_Suse_11_r = 'Memory & Swap Utilization';
		var $SA_Suse_11_R = 'Memory Statistics';
		var $SA_Suse_11_S = 'Swap Utilization';
		var $SA_Suse_11_v = 'Kernel Tables';
		var $SA_Suse_11_w = 'System Switching Activity';
		var $SA_Suse_11_W = 'Swapping Statistics';
		var $SA_Suse_11_y = 'TTY Device Activity';

        var $SA_Suse_12 = 'b B d n_DEV n_EDEV n_NFS n_NFSD n_SOCK P_ALL q r R H S v w W y';
                var $SA_Suse_12_b = 'I/O Rates';
                var $SA_Suse_12_B = 'Paging Statistics';
                var $SA_Suse_12_d = 'Disk I/O & Statistics';
                var $SA_Suse_12_H = 'Hugepage Utilization';
                var $SA_Suse_12_n_DEV = 'Network I/O & Statistics';
                var $SA_Suse_12_n_EDEV = 'Network Error Statistics';
                var $SA_Suse_12_n_NFS = 'NFS Statistics';
                var $SA_Suse_12_n_NFSD = 'NFSD Statistics';
                var $SA_Suse_12_n_SOCK = 'Network Socket Statistics';
                var $SA_Suse_12_P_ALL = 'Processor Activity';
                var $SA_Suse_12_q = 'Process Queue';
                var $SA_Suse_12_r = 'Memory & Swap Utilization';
                var $SA_Suse_12_R = 'Memory Statistics';
                var $SA_Suse_12_S = 'Swap Utilization';
                var $SA_Suse_12_v = 'Kernel Tables';
                var $SA_Suse_12_w = 'System Switching Activity';
                var $SA_Suse_12_W = 'Swapping Statistics';
                var $SA_Suse_12_y = 'TTY Device Activity';

	var $SA_HPUX_11 = 'a b c d Sm Mq Mu v w y';
		var $SA_HPUX_11_a = 'Use of File Access Routines';
		var $SA_HPUX_11_b = 'Buffer Activity';
		var $SA_HPUX_11_c = 'Statistics of System Calls';
		var $SA_HPUX_11_d = 'Disk I/O & Statistics';
		var $SA_HPUX_11_Sm = 'Number of System V Calls';
		var $SA_HPUX_11_Mq = 'Run & Swap Queue';
		var $SA_HPUX_11_Mu = 'Processor Activity';
		var $SA_HPUX_11_v = 'Kernel Tables';
		var $SA_HPUX_11_w = 'Swap & System Switching';
		var $SA_HPUX_11_y = 'TTY Device Activity';

	var $SA_HPUX_23 = 'a b c d Sm Mq Mu v w y';
		var $SA_HPUX_23_a = 'Use of File Access Routines';
		var $SA_HPUX_23_b = 'Buffer Activity';
		var $SA_HPUX_23_c = 'Statistics of System Calls';
		var $SA_HPUX_23_d = 'Disk I/O & Statistics';
		var $SA_HPUX_23_Sm = 'Number of System V Calls';
		var $SA_HPUX_23_Mq = 'Run & Swap Queue';
		var $SA_HPUX_23_Mu = 'Processor Activity';
		var $SA_HPUX_23_v = 'Kernel Tables';
		var $SA_HPUX_23_w = 'Swap & System Switching';
		var $SA_HPUX_23_y = 'TTY Device Activity';

	var $SA_HPUX_31 = 'a b c Rd H L Sm Mq Mu v w y';
		var $SA_HPUX_31_a = 'Use of File Access Routines';
		var $SA_HPUX_31_b = 'Buffer Activity';
		var $SA_HPUX_31_c = 'Statistics of System Calls';
		var $SA_HPUX_31_Rd = 'Disk I/O & Statistics';
		var $SA_HPUX_31_H = 'I/O Statistics & Utilization';
		var $SA_HPUX_31_L = 'I/O Service Statistics';
		var $SA_HPUX_31_Sm = 'Number of System V Calls';
		var $SA_HPUX_31_Mq = 'Run & Swap Queue';
		var $SA_HPUX_31_Mu = 'Processor Activity';
		var $SA_HPUX_31_v = 'Kernel Tables';
		var $SA_HPUX_31_w = 'Swap & System Switching';
		var $SA_HPUX_31_y = 'TTY Device Activity';

	var $SA_SunOS_9 = 'a b c d g k m p q u v w y';
		var $SA_SunOS_9_a = 'Use of File Access Routines';
		var $SA_SunOS_9_b = 'Buffer Activity';
		var $SA_SunOS_9_c = 'Statistics of System Calls';
		var $SA_SunOS_9_d = 'Disk I/O & Statistics';
		var $SA_SunOS_9_g = 'Paging Activities';
		var $SA_SunOS_9_k = 'Kernel Memory Allocation';
		var $SA_SunOS_9_m = 'Number of System V Calls';
		var $SA_SunOS_9_p = 'Page Statistics';
		var $SA_SunOS_9_q = 'Run & Swap Queue';
		var $SA_SunOS_9_u = 'Processor Activity';
		var $SA_SunOS_9_v = 'Kernel Tables';
		var $SA_SunOS_9_w = 'Swap & System Switching';
		var $SA_SunOS_9_y = 'TTY Device Activity';

	var $SA_SunOS_10 = 'a b c d g k m p q r u v w y';
		var $SA_SunOS_10_a = 'Use of File Access Routines';
		var $SA_SunOS_10_b = 'Buffer Activity';
		var $SA_SunOS_10_c = 'Statistics of System Calls';
		var $SA_SunOS_10_d = 'Disk I/O & Statistics';
		var $SA_SunOS_10_g = 'Paging Activities';
		var $SA_SunOS_10_k = 'Kernel Memory Allocation';
		var $SA_SunOS_10_m = 'Number of System V Calls';
		var $SA_SunOS_10_p = 'Page Statistics';
		var $SA_SunOS_10_q = 'Run & Swap Queue';
		var $SA_SunOS_10_r = 'Unused Memory & Swap';
		var $SA_SunOS_10_u = 'Processor Activity';
		var $SA_SunOS_10_v = 'Kernel Tables';
		var $SA_SunOS_10_w = 'Swap & System Switching';
		var $SA_SunOS_10_y = 'TTY Device Activity';

	var $SA_SunOS_11 = 'a b c d g k m p q r u v w y';
		var $SA_SunOS_11_a = 'Use of File Access Routines';
		var $SA_SunOS_11_b = 'Buffer Activity';
		var $SA_SunOS_11_c = 'Statistics of System Calls';
		var $SA_SunOS_11_d = 'Disk I/O & Statistics';
		var $SA_SunOS_11_g = 'Paging Activities';
		var $SA_SunOS_11_k = 'Kernel Memory Allocation';
		var $SA_SunOS_11_m = 'Number of System V Calls';
		var $SA_SunOS_11_p = 'Page Statistics';
		var $SA_SunOS_11_q = 'Run & Swap Queue';
		var $SA_SunOS_11_r = 'Unused Memory & Swap';
		var $SA_SunOS_11_u = 'Processor Activity';
		var $SA_SunOS_11_v = 'Kernel Tables';
		var $SA_SunOS_11_w = 'Swap & System Switching';
		var $SA_SunOS_11_y = 'TTY Device Activity';

	var $SA_Ubuntu_18 = 'b B d n_DEV n_EDEV n_NFS n_NFSD n_SOCK P_ALL q r H S v w W y';
                var $SA_Ubuntu_18_b = 'I/O Rates';
                var $SA_Ubuntu_18_B = 'Paging Statistics';
                var $SA_Ubuntu_18_d = 'Disk I/O & Statistics';
                var $SA_Ubuntu_18_H = 'Hugepage Utilization';
                var $SA_Ubuntu_18_n_DEV = 'Network I/O & Statistics';
                var $SA_Ubuntu_18_n_EDEV = 'Network Error Statistics';
                var $SA_Ubuntu_18_n_NFS = 'NFS Statistics';
                var $SA_Ubuntu_18_n_NFSD = 'NFSD Statistics';
                var $SA_Ubuntu_18_n_SOCK = 'Network Socket Statistics';
                var $SA_Ubuntu_18_P_ALL = 'Processor Activity';
                var $SA_Ubuntu_18_q = 'Process Queue';
                var $SA_Ubuntu_18_r = 'Memory & Swap Utilization';
                var $SA_Ubuntu_18_S = 'Swap Utilization';
                var $SA_Ubuntu_18_v = 'Kernel Tables';
                var $SA_Ubuntu_18_w = 'System Switching Activity';
                var $SA_Ubuntu_18_W = 'Swapping Statistics';
                var $SA_Ubuntu_18_y = 'TTY Device Activity';
}
class SPECIAL {
	var $SA_Redhat_3 = 'd n_DEV n_EDEV P_ALL';
	var $SA_Redhat_4 = 'd n_DEV n_EDEV P_ALL';
	var $SA_Redhat_5 = 'd n_DEV n_EDEV P_ALL';
	var $SA_Redhat_6 = 'd n_DEV n_EDEV P_ALL';
	var $SA_Redhat_7 = 'd n_DEV n_EDEV P_ALL';
	var $SA_Suse_8 = 'd n_DEV n_EDEV U_ALL';
	var $SA_Suse_9 = 'd n_DEV n_EDEV P_ALL';
	var $SA_Suse_10 = 'd n_DEV n_EDEV P_ALL';
	var $SA_Suse_11 = 'd n_DEV n_EDEV P_ALL';
	var $SA_Suse_12 = 'd n_DEV n_EDEV P_ALL';
	var $SA_HPUX_11 = 'd Mq Mu';
	var $SA_HPUX_23 = 'd Mq Mu';
	var $SA_HPUX_31 = 'Rd H L Mq Mu';
	var $SA_SunOS_9 = 'd';
	var $SA_SunOS_10 = 'd';
	var $SA_SunOS_11 = 'd';
	var $SA_Ubuntu_18 = 'd n_DEV n_EDEV P_ALL y';
}
class DEVICES {
	var $SA_d = 'Disk';
	var $SA_n_DEV = 'Nic';
	var $SA_n_EDEV = 'Nic';
	var $SA_P_ALL = 'Cpu';
	var $SA_U_ALL = 'Cpu';
	var $SA_Rd = 'Disk';
	var $SA_Mq = 'Cpu';
	var $SA_Mu = 'Cpu';
	var $SA_H = 'Hba';
	var $SA_L = 'Path';
	var $SA_y = 'Tty';
}

   switch( $task ) {
	default:
	   doForm("none","none");
   }

function doHead()
{
?>
	<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<link href="sarFILE/style.css" rel="stylesheet" type="text/css" media="screen">
	<script src="sarFILE/jquery-1.5.min.js" type="text/javascript"></script>
	<script src="sarFILE/tabcontent.js" type="text/javascript" ></script>
	<script language="Javascript">
		$(document).ready(function() {

		$('#password-clear').show();
		$('#passwd').hide();
	
		$('#password-clear').focus(function() {
		$('#password-clear').hide();
		$('#passwd').show();
		$('#passwd').focus();
		});
		$('#passwd').blur(function() {
		if($('#passwd').val() == '') {
		$('#password-clear').show();
		$('#passwd').hide();
		}
		});
	
		$('.default-value').each(function() {
		var default_value = this.value;
		$(this).focus(function() {
		if(this.value == default_value) {
		this.value = '';
		}
		});
		$(this).blur(function() {
		if(this.value == '') {
		this.value = default_value;
		}
		});
		});
	
		});
	</script>
	<script> 
	function toggle(devrow) { 
	 tr=document.getElementsByTagName('tr') 
	 for (i=0;i<tr.length;i++){ 
	  if (tr[i].getAttribute(devrow)){ 
	   if ( tr[i].style.display=='none' ){ 
	     tr[i].style.display = ''; 
	   } 
	   else { 
	    tr[i].style.display = 'none'; 
	   } 
	  } 
	 } 
	} 
	</script> 
	<style type="text/css">
		password-clear {
		display: none;
		}
	</style>


	</head>
	<body>
<?php
}


function doForm($getplot,$gethost)
{       
	$OPTIONS = new OPTIONS();
	$SPECIAL = new SPECIAL();
	$DEVICES = new DEVICES();
	$task = "";
	$plot = "";
	$host = "";
	$sdate = "";
	$edate = "";
	$delete = "";
	$decision = "";
	$ipaddr = "";
	$userna = "root";
	$passwd = "";
	if (isset($_GET['plot'])) { $plot = $_GET['plot']; }
	if (isset($_POST['sdate'])) { $sdate = $_POST['sdate']; }
	if (isset($_POST['edate'])) { $edate = $_POST['edate']; }
	if (isset($_POST['plot'])) { $plot = $_POST['plot']; }
	if (isset($_POST['host'])) { $host = $_POST['host']; }
	if (isset($_POST['decision'])) { $decision = $_POST['decision']; }
	if (isset($_POST['ipaddr'])) { $ipaddr = $_POST['ipaddr']; } else { $ipaddr = "IP Address"; }
	if (isset($_POST['userna'])) { $userna = $_POST['userna']; }
	if (isset($_POST['passwd'])) { $passwd = $_POST['passwd']; }
	if (isset($_POST['task'])) { $task = $_POST['task']; }
	if ($getplot != "none") { $plot = $getplot; }
	if ($gethost != "none") { $host = $gethost; }
	if( $userna == "User Name [root]" ) {
		$userna="root";
	}
	doHead(); 
?>
	<div id="wrapper">
	<div class="menu">
        <div align="center">
	<span style='font-size:8pt;font-family:"Arial","sans-serif";font-weight:bold;text-align:center' align="center">sar2html Ver 3.2.1</span>
	<br>
	<span style='font-size:7pt;font-family:"Arial","sans-serif";text-align:center' align="center">(<a href="https://sourceforge.net/p/sar2html/donate/" target="_blank">Donate</a> if you like!)</span></div>
	<br>
	<ul class="ulan">
<?php 
	    if ( ! $host == "" ) {
              echo "<li style=\"width: -moz-calc(50% - 13px);width: -webkit-calc(50% - 13px);width: calc(50% - 13px);\"><a href=\"index.php?plot=NEW\">New</a></li>";
	      if ( $plot != ""  &&  $plot != "NEW" ) { echo "<li style=\"width: -moz-calc(50% - 13px);width: -webkit-calc(50% - 13px);width: calc(50% - 13px);\"><a href=\"index.php\">$plot</a>"; }
	      else { echo "<li style=\"width: -moz-calc(50% - 13px);width: -webkit-calc(50% - 13px);width: calc(50% - 13px);\"><a href=\"index.php\">OS</a>"; }
	   } else {
              echo "<li style=\"width: -moz-calc(50% - 2px);width: -webkit-calc(50% - 2px);width: calc(50% - 2px);\"><a href=\"index.php?plot=NEW\">New</a></li>";
	      if ( $plot != ""  &&  $plot != "NEW" ) { echo "<li style=\"width: -moz-calc(50% - 2px);width: -webkit-calc(50% - 2px);width: calc(50% - 2px);\"><a href=\"index.php\">$plot</a>"; }
	      else { echo "<li style=\"width: -moz-calc(50% - 2px);width: -webkit-calc(50% - 2px);width: calc(50% - 2px);\"><a href=\"index.php\">OS</a>"; }
	   }
?>
            <ul class="ulbn">
                  <li style="font-weight:normal"><a href="index.php?plot=HPUX">HP-UX</a></li>
                  <li style="font-weight:normal"><a href="index.php?plot=LINUX">Linux</a></li>
                  <li style="font-weight:normal"><a href="index.php?plot=SUNOS">SunOS</a></li>
            </ul>
        </li>
<?php 
	if ( ! $host == "" ) {
		echo "<li style=\"width:20px\"><a href=\"index.php?delete=OK&host=$host\">&times;</a></li>"; 
	}
?>
	</ul>
	<br>
<?php
	if (isset($_POST['decision'])) { 
		$delhost = $_POST['delhost'];
		if( $decision == "Yes" ) {
			$command = "./sar2html -e " . $delhost . " y";
			exec($command);
			$host = "";
		}
	}
	if (isset($_GET['delete'])) { 
	  $delhost = $_GET['host'];
?>
	  <form action="index.php" method="post" enctype="multipart/form-data">
<?php
	  echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
	  echo "<input type=\"hidden\" name=\"delhost\" value=\"$delhost\">";
	  echo "<input type=\"hidden\" name=\"host\" value=\"\">";
	  echo "<div style=\"height:50px\">";
	  echo "<span style='font-size:9pt;font-family:\"Arial\",\"sans-serif\";font-weight:bold;color:#bb2200'><br><br>Are you sure to delete following host?<br><font style=\"color:black\">$delhost</font></span>";
	  echo "</div>";
?>
	  <input type="submit" name="decision" value="Yes" class="button" style="width:50%" />
	  <input type="submit" name="decision" value="No" class="button" style="width:50%" />
	  </form>
<?php
	} elseif( $plot == "NEW" ) {
?>
	  <br>
	  <ul class="tabs" data-persist="true">
	    <li><a href="#Upload">Upload new report</a></li>
	    <li><a href="#Capture">Capture new report</a></li>
   	  </ul>
	  <div class="tabcontents">
	    <div id="Upload">
	      <div style="margin-top:14px;margin-bottom:44px">
	  	<form action="index.php" method="post" enctype="multipart/form-data">
	  	<input name="ufile" type="file" id="ufile" size="100%" style="width:100%;height: 20px; font-size: 9pt; background-color: #F8F8F8; border-width: 1px; text-align: left;color:#993"/>
	  	<input type="submit" name="Submit" value="Upload report" class="button" style="width:50%;float:right;">
	  	<input type="hidden" name="task" value="addreport">
	  	<input type="hidden" name="plot" value="NEW">
	  	</form>
	      </div>
<?php
		if( $task == "addreport") {
?>
		  <div class="container">
		  <span style='font-size:9pt;font-family:"Arial","sans-serif";'>Downloading sar2ascii report<br></span>
<?php
		  if (isset($_POST['ufile'])) { $ufile = $_POST['ufile']; }
		  if( $ufile != "none" )
		  {
			$command ="./sar2html";
			$uploaddir = 'sarDATA/uPLOAD/';
			$uploadfile = $uploaddir . basename($_FILES['ufile']['name']);
			if (move_uploaded_file($_FILES['ufile']['tmp_name'], $uploadfile)) {
			   $command ="./sar2html -d " . $uploadfile;
			   exec($command,$host);
			   $command ="./sar2html -o " . $uploadfile;
			   exec($command,$plot);
			   $command ="./sar2html -m " . $uploadfile;
			   exec($command,$host);
			   $plot = current($plot);
			   $host = current($host);
		  	   echo "</div>";
			   echo "<form METHOD=POST ACTION=\"index.php\">";
			   echo "<input type=\"submit\" name=\"GoPlotting\" value=\"Go to Plotting Page\" class=\"button\" style=\"width:50%;float:right\"/>";
			   echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
			   echo "<input type=\"hidden\" name=\"host\" value=\"$host\">";
			   echo "</form>";
			} else {
			   echo "<span style='font-size:9pt;font-family:\"Arial\",\"sans-serif\";'>Error: Unable to upload file</span>";
		  	   echo "</div>";
			   echo "<form METHOD=POST ACTION=\"index.php\">";
			   echo "<input type=\"submit\" name=\"GoBack\" value=\"Go Back\" class=\"button\" style=\"width:50%;float:right\"/>";
			   echo "<input type=\"hidden\" name=\"plot\" value=\"NEW\">";
			   echo "</form>";
			}
		  }
		}
?>
	    </div>
	    <div id="Capture">
	      <div style="margin-top:14px;margin-bottom:14px;">
	  	<form action="index.php" method="post" enctype="multipart/form-data">
		<input name="ipaddr" type="text" id="ipaddr" size="100%" value="IP Address" class="input_text">
		<input name="userna" type="text" id="userna" size="100%" value="User Name [root]" class="input_text">
		<input type="text" id="password-clear" size="100%" value="Password" class="input_text">
		<input name="passwd" type="password" id="passwd" size="100%" value="" autocomplete="off" class="input_text">
		<input type="hidden" name="task" value="addhost">
		<input type="hidden" name="plot" value="NEW">
		<input type="submit" name="Submit" value="Capture report" class="button" style="width:50%;float:right">
		</form>
	      </div>
		<br>
		<br>
<?php
		if(filter_var($ipaddr, FILTER_VALIDATE_IP) && $ipaddr != "" && $userna != "" && $passwd != "") {
		  echo "<div class=\"container\">";
		  echo "<span style='font-size:9pt;font-family:\"Arial\",\"sans-serif\";'>Uploading sar2ascii to $ipaddr:/usr/bin</span><br>";
		  $sftp = new Net_SFTP("$ipaddr");
		  if (!$sftp->login("$userna", "$passwd")) {
		    exit('Login Failed');
		  }

		  $sftp->put('/usr/bin/sar2ascii', 'sarFILE/sar2ascii', NET_SFTP_LOCAL_FILE);
		  echo "<span style='font-size:9pt;font-family:\"Arial\",\"sans-serif\";'>Running sar2asciii</span><br>";
		  $ssh = new Net_SSH2("$ipaddr");
		  if (!$ssh->login("$userna", "$passwd")) {
		    exit('Login Failed');
		  }
		  $ssh->setTimeout(3000);
		  $dresponse = $ssh->exec('rm -rf /tmp/sar2html*');
		  $dresponse = trim($ssh->exec('uname -s'));
		  if ( $dresponse == "HP-UX" )
		  {
			$response = $ssh->exec('sh /usr/bin/sar2ascii');
		  } else {
			$response = $ssh->exec('bash /usr/bin/sar2ascii');
		  }
		  $logger = '<pre>' . htmlspecialchars($response) . '</pre>';
		  echo "<span style='font-size:9pt;font-family:\"Arial\",\"sans-serif\";'>$logger</span>";
		  echo "<span style='font-size:9pt;font-family:\"Arial\",\"sans-serif\";'>Loading report</span><br>";
		  $rfile = explode(".tar.gz", $response);
		  $rfile = explode("/", $rfile[0]);
		  $rfile = trim($rfile[2]) . ".tar.gz";
		  $command = "pwd";
		  $lfile = exec($command);
		  $lfile = $lfile . "/sarDATA/uPLOAD/" . $rfile;
		  $ffile = "sarDATA/uPLOAD/" . $rfile;
		  $rfile = "/tmp/" . $rfile;
		  echo "</div>";


		  if ($sftp->get($rfile, $lfile)) {
		    $command ="./sar2html -d " . $ffile;
		    exec($command,$host);
		    $command ="./sar2html -o " . $ffile;
		    exec($command,$plot);
		    $command ="./sar2html -m " . $ffile;
		    exec($command,$host);
		    $plot = current($plot);
		    $host = current($host);
		    echo "<form METHOD=POST ACTION=\"index.php\">";
		    echo "<input type=\"submit\" name=\"GoPlotting\" value=\"Go to Plotting Page\" class=\"button\" style=\"width:50%;float:right\"/>";
		    echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
		    echo "<input type=\"hidden\" name=\"host\" value=\"$host\">";
		    echo "</form>";
		  } else {
		    echo "Error: Unable to upload file";
		    echo "<form METHOD=POST ACTION=\"index.php\">";
		    echo "<input type=\"submit\" name=\"GoBack\" value=\"Go Back\" class=\"button\" />";
		    echo "<input type=\"hidden\" name=\"plot\" value=\"NEW\">";
		    echo "</form>";
		  }

		}
?>
	    </div>
	  </div>
<?php


	} elseif( $plot != "" ) {
	  echo "<div style=\"height:100px; vertical-align: top;\">";
	  // HOST SELECTION
	  echo "<form METHOD=POST ACTION=\"index.php\">";
	  echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
	  echo "<select class=\"select_text\" name=host onchange=\"this.form.submit();\">";
	  if ( $host == "" ) { echo "<option value=null selected>Select Host</option>";}
	  $command ="./sar2html -r " . $plot;
	  exec($command,$RELEASE);
	  foreach($RELEASE as $os)
	  {
	  	$os = rtrim($os);
	  	$os = rtrim($os);
		if ($os == $host) { echo "<option value=$os selected>$os</option>"; 
		} else { echo "<option value=$os>$os</option>"; }
	  }
	  echo "</select>";
	  echo "</form>";

	  if ( ! $host == "" ) {
	   $osver = explode("/", $host);
	   $osver = "SA_" . $osver[0];
	   $option = $OPTIONS->$osver . "\n";
	   $spec = $SPECIAL->$osver . "\n";
	   $option = rtrim($option);
	   $spec = rtrim($spec);
	   $arroption = explode(" ", $option);
	   $arrspec = explode(" ", $spec);
	  }

	  // START DATE SELECTION
	  echo "<form METHOD=POST ACTION=\"index.php\">";
	  echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
	  echo "<input type=\"hidden\" name=\"host\" value=\"$host\">";
	  echo "<select class=\"select_text\" name=sdate onchange=\"this.form.submit();\">";
	  $rvalue = "0";
	  if ( $host == "" ) { echo "<option value=null selected>Select Host First</option>";}
	  else
	  {
	    echo "<option value=null selected>Select Start Date</option>";
	    $command ="./sar2html -l " . $host;
	    exec($command,$STARTDATE);
	    foreach($STARTDATE as $sdates)
	    {
	       $sdates = rtrim($sdates);
	       if ($sdates == $sdate) { echo "<option value=$sdates selected>$sdates</option>"; 
	       } else { echo "<option value=$sdates>$sdates</option>"; }
	    }
	 }
	 echo "</select>";
	 if ( ! $host == "" ) {
	   $loption = "";
	   foreach($arroption as $soption)
	   {
	        $soption = rtrim($soption);
		if ( ! $sdate == "" ) { 
			if (isset($_POST[$soption])) { 
			  echo "<input type=\"hidden\" name=\"$soption\" value=\"CHECKED\">";
			  if ( in_array($soption,$arrspec) ) {
				$DEVS = "";
				$devcommand = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${soption}.1* | awk -F-- '{ print $2 }' | sort -g"; /* modified by James Kenney */
				exec($devcommand,$DEVS);
			        $devvar = "SA_$soption";
			        $devtitle = $DEVICES->$devvar . "\n";
	   			foreach($DEVS as $dev) {
	  	    	                $dev = rtrim($devtitle)."_".rtrim($dev);
					if (isset($_POST[$dev])) { 
						echo "<input type=\"hidden\" name=\"$dev\" value=\"CHECKED\">";
					}
				}
			  }
			}
		} else {
			echo "<input type=\"hidden\" name=\"$soption\" value=\"CHECKED\">";
			if ( in_array($soption,$arrspec) ) {
				$DEVS = "";
				$devcommand = "ls sarDATA/" . $host . "/report/ | grep ^" . $soption . ".1 | awk -F-- '{ print $2 }' | sort -g";
				exec($devcommand,$DEVS);
			        $devvar = "SA_$soption";
			        $devtitle = $DEVICES->$devvar . "\n";
	   			foreach($DEVS as $dev) {
	  	    	                $dev = rtrim($devtitle)."_".rtrim($dev);
					echo "<input type=\"hidden\" name=\"$dev\" value=\"CHECKED\">";
				}
			}
		}
	   }
	 }
	 echo "</form>";

	 // END DATE SELECTION
	 echo "<form METHOD=POST ACTION=\"index.php\">";
	 echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
	 echo "<input type=\"hidden\" name=\"host\" value=\"$host\">";
	 echo "<input type=\"hidden\" name=\"sdate\" value=\"$sdate\">";
	 echo "<select class=\"select_text\" name=edate onchange=\"this.form.submit();\">";
	 if (!isset($_POST['sdate'])) { echo "<option value=null selected>Select Start Date First</option>";}
	 else
	 {
	   echo "<option value=null selected>Select End Date</option>";
	   $command ="./sar2html -l " . $host . " " . $sdate;
	   exec($command,$ENDDATE);
	   foreach($ENDDATE as $edates)
	   #while( list(,$edates) = each($ENDDATE) ) 
	   {
	     $edates = rtrim($edates);
	     if ($edates == $edate) { echo "<option value=$edates selected>$edates</option>"; 
	     } else { echo "<option value=$edates>$edates</option>"; }
	   }
	 }
	 if (isset($_POST['sdate'])) { 
	   $loption = "";
	   foreach($arroption as $soption)
	   #while( list(,$soption) = each($loption) ) 
	   {
	        $soption = rtrim($soption);
		if (isset($_POST[$soption])) { 
		  echo "<input type=\"hidden\" name=\"$soption\" value=\"CHECKED\">";
		  if ( in_array($soption,$arrspec) ) {
			$DEVS = "";
			$devcommand = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${soption}.1* | awk -F-- '{ print $2 }' | sort -g"; /* modified by James Kenney */
			exec($devcommand,$DEVS);
			$devvar = "SA_$soption";
			$devtitle = $DEVICES->$devvar . "\n";
	   		foreach($DEVS as $dev) {
	  	    	        $dev = rtrim($devtitle)."_".rtrim($dev);
				if (isset($_POST[$dev])) { 
					echo "<input type=\"hidden\" name=\"$dev\" value=\"CHECKED\">";
				}
			}
		  }
		}
	   }
	 }
	 echo "</select>";
	 echo "</form>";
	 echo "</div>";
	}



	if( $edate != "" ) {
?>
	  <div></div>
	  <ul class="tabs" data-persist="true">
	     	<li><a href="#Navigator">Navigator</a></li>
<?php
		 $loption = "";
		 $devcollect = "";
	   	 foreach($arrspec as $kopt)
		 #while( list(,$kopt) = each($loption) ) 
		 {
	            $kopt = rtrim($kopt);
			$devvar = "SA_$kopt";
			$devtitle = $DEVICES->$devvar . "\n";
			$devtitle = rtrim($devtitle);
			if (! preg_match("/$devtitle/","$devcollect")) { 
			  $devcollect = "$devcollect,$devtitle";
			  echo "<li><a href=\"#$devtitle\">$devtitle</a></li>"; 
			}
		 }
?>
   	  </ul>
	  <div class="tabcontents">
	    <div id="Navigator">
<?php
		 echo "<form METHOD=POST ACTION=\"index.php\">";
		 echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
		 echo "<input type=\"hidden\" name=\"host\" value=\"$host\">";
		 echo "<input type=\"hidden\" name=\"sdate\" value=\"$sdate\">";
		 echo "<input type=\"hidden\" name=\"edate\" value=\"$edate\">";
		 $loption = "";
		 foreach($arroption as $soption)
		 {
	  	   $soption = rtrim($soption);
		   echo "<input type=\"hidden\" name=\"$soption\" value=\"CHECKED\">";
		 }
	   	 foreach($arrspec as $soption)
		 {
			$DEVS = "";
			$devcommand = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${soption}.1* | awk -F-- '{ print $2 }' | sort -g"; /* modified by James Kenney */
			exec($devcommand,$DEVS);
			$devvar = "SA_$soption";
			$devtitle = $DEVICES->$devvar . "\n";
	   	 	foreach($DEVS as $kdev) {
	  	    	  $kdev = rtrim($devtitle)."_".rtrim($kdev);
			  if (isset($_POST[$kdev])) { echo "<input type=\"hidden\" name=\"$kdev\" value=\"CHECKED\">";}
			}
		 }
		 echo "<input type=\"submit\" name=\"option\" value=\"All\" class=\"button\" style=\"width:50%\">";
		 echo "</form>";
		 echo "<form METHOD=POST ACTION=\"index.php\">";
		 echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
		 echo "<input type=\"hidden\" name=\"host\" value=\"$host\">";
		 echo "<input type=\"hidden\" name=\"sdate\" value=\"$sdate\">";
		 echo "<input type=\"hidden\" name=\"edate\" value=\"$edate\">";
		 $loption = "";
		 foreach($arrspec as $soption)
		 {
			$DEVS = "";
			$devcommand = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${soption}.1* | awk -F-- '{ print $2 }' | sort -g"; /* modified by James Kenney */
			exec($devcommand,$DEVS);
			$devvar = "SA_$soption";
			$devtitle = $DEVICES->$devvar . "\n";
	   	 	foreach($DEVS as $kdev) {
	  	    	  $kdev = rtrim($devtitle)."_".rtrim($kdev);
			  if (isset($_POST[$kdev])) { echo "<input type=\"hidden\" name=\"$kdev\" value=\"CHECKED\">";}
			}
		 }
		 echo "<input type=\"submit\" name=\"option\" value=\"None\" class=\"button\" style=\"width:50%\">";
		 echo "</form>";
		 echo "<div style=\"float:left;display:inline-block;width:100%;\">";
		 echo "<form METHOD=POST ACTION=\"index.php\">";
		 echo "<table width=\"100%\" cellspacing=0 cellpadding=0 bgcolor=\"#F8F8F8\" style='border:1px solid #E2E2E2;border-collapse:collapse;font-size: 9px;'>";
		 echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
		 echo "<input type=\"hidden\" name=\"host\" value=\"$host\">";
		 echo "<input type=\"hidden\" name=\"sdate\" value=\"$sdate\">";
		 echo "<input type=\"hidden\" name=\"edate\" value=\"$edate\">";
		 $loption = "";
		 foreach($arroption as $soption)
		 #while( list(,$soption) = each($loption) ) 
		 {
	  	        $soption = rtrim($soption);
			$opt = str_replace("_", " ", $soption);
			echo "<tr style='border:1px solid #E2E2E2;font-size: 9px;'>";
			echo "<td width=\"10%\" style=\"border:1px solid #E2E2E2;font-size: 9px;\">";
			if (isset($_POST[$soption])) { 
				echo "<input type=\"checkbox\" name=\"$soption\" value=\"CHECKED\" CHECKED  class=\"cbox\"/>";
			} else {
				echo "<input type=\"checkbox\" name=\"$soption\" value=\"\" class=\"cbox\"/>";
			}
			echo "</td>";
			echo "<td width=\"20%\" style=\"border:1px solid #E2E2E2;font-size: 9px;\">";
			echo "<span style='font-size:9pt;font-family:\"Arial\",\"sans-serif\";color:black;'>$opt</span>";
			echo "</td>";
			echo "<td width=\"70%\" style=\"border:1px solid #E2E2E2;font-size: 9px;\">";
	   		$expopt = $osver . "_" . $soption;
	   		$ept = $OPTIONS->$expopt;
			echo "<a href=\"#chapter_$soption\" style='font-size:8pt;font-family:\"Arial\",\"sans-serif\";color:#bb2200;height:26px'>$ept</a>";
			echo "</td>";
			echo "</tr>";
		 }
		 echo "</table>";
		 $loption = "";
		 foreach($arrspec as $soption)
		 {
			$DEVS = "";
			$devcommand = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${soption}.1* | awk -F-- '{ print $2 }' | sort -g"; /* modified by James Kenney */
			exec($devcommand,$DEVS);
			$devvar = "SA_$soption";
			$devtitle = $DEVICES->$devvar . "\n";
	   	 	foreach($DEVS as $kdev) {
	  	    	  $kdev = rtrim($devtitle)."_".rtrim($kdev);
			  if (isset($_POST[$kdev])) { echo "<input type=\"hidden\" name=\"$kdev\" value=\"CHECKED\">";}
			}
		 }
?>
		 <input type="submit" name="report" value="Plot" class="button" style="width:50%;float:right;font-weight:bold;color:black">
		 </form>
		 </div>
	      </div>
<?php
//DEVICE OPTIONS
		 $loption = "";
		 $devcollect = "";
	   	 foreach($arrspec as $soption)
		 {
			$soption = rtrim($soption);
			$devvar = "SA_$soption";
			$devtitle = $DEVICES->$devvar . "\n";
			$devtitle = rtrim($devtitle);
			if (! preg_match("/$devtitle/","$devcollect")) {
			   $devcollect = "$devcollect,$devtitle";
			   echo "<div id=\"$devtitle\">";
			   if ( $plot == "LINUX" && $soption == "d") { 
			     $devcommand = "cd sarDATA/${host}/report && LC_ALL=C grep -F -l ${sdate} d.1* | awk -F--dev '{ print $2 }' | sort -n | sed 's/^/dev/g'"; /* modified by James Kenney */
			   } else {
			     $devcommand = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${soption}.1* | awk -F-- '{ print $2 }' | sort -g"; /* modified by James Kenney */
			   }
			   $devrun = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${soption}.1* | awk -F-- '{ print $2 }' | wc -l"; /* modified by James Kenney */
			   $DEVSRUN = "";
			   exec($devrun,$DEVSRUN);
			   $devnumber = $DEVSRUN[0];
			   $devline = $devnumber/9;
			   $round = explode(".", $devline);
			   $devline = $round[0];
			   $devround = $devline*9;
			   if ( $devround != $devnumber ) { $devline += 1; }
			   $lineheight = $devline*20;

			   echo "<form METHOD=POST ACTION=\"index.php\">";
			   echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
			   echo "<input type=\"hidden\" name=\"host\" value=\"$host\">";
			   echo "<input type=\"hidden\" name=\"sdate\" value=\"$sdate\">";
			   echo "<input type=\"hidden\" name=\"edate\" value=\"$edate\">";
			   $zoption = "";
	   	 	   foreach($arroption as $koption)
			   {
	  	    		$koption = rtrim($koption);
				if (isset($_POST[$koption])) { 
				  echo "<input type=\"hidden\" name=\"$koption\" value=\"CHECKED\">";
				}
			   }
	   	 	   foreach($arrspec as $eoption)
			   {
				$kDEVS = "";
				$eoption = rtrim($eoption);
				$kdevcommand = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${eoption}.1* | awk -F-- '{ print $2 }' | sort -g"; /* modified by James Kenney */
				exec($kdevcommand,$kDEVS);
				$edevvar = "SA_$eoption";
				$edevtitle = $DEVICES->$edevvar . "\n";
	   	 	   	foreach($kDEVS as $kdev) {
	  	    		   $kdev = rtrim($edevtitle)."_".rtrim($kdev);
				   if ( $eoption == $soption ) { echo "<input type=\"hidden\" name=\"$kdev\" value=\"CHECKED\">";}
				     else { if (isset($_POST[$kdev])) { echo "<input type=\"hidden\" name=\"$kdev\" value=\"CHECKED\">";}}
				}
			   }
			   echo "<input type=\"submit\" name=\"option\" value=\"All\" class=\"button\">";
			   echo "</form>";

			   echo "<form METHOD=POST ACTION=\"index.php\">";
			   echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
			   echo "<input type=\"hidden\" name=\"host\" value=\"$host\">";
			   echo "<input type=\"hidden\" name=\"sdate\" value=\"$sdate\">";
			   echo "<input type=\"hidden\" name=\"edate\" value=\"$edate\">";
			   $duplicate = "";
			   $toption = "";
		 	   foreach($arroption as $noption)
			   {
	  	    		$noption = rtrim($noption);
				if (isset($_POST[$noption])) { 
				  echo "<input type=\"hidden\" name=\"$noption\" value=\"CHECKED\">";
				}
			   }
	   	 	   foreach($arrspec as $foption)
			   {
				$foption = rtrim($foption);
				$fdevvar = "SA_$foption";
				$fdevtitle = $DEVICES->$fdevvar . "\n";
				if ( $foption != $soption ) { 
				  $DEVS = "";
				  $fdevcommand = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${foption}.1* | awk -F-- '{ print $2 }' | sort -g"; /* modified by James Kenney */
				  exec($fdevcommand,$DEVS);
		 		  foreach($DEVS as $dev) {
	  	    	   	   $dev = rtrim($fdevtitle)."_".rtrim($dev);
				   if ( $fdevtitle != $duplicate ) {
				    if (isset($_POST[$dev])) { echo "<input type=\"hidden\" name=\"$dev\" value=\"CHECKED\">";}}
				  }
				} else { $duplicate = $fdevtitle; }
			   }
			   echo "<input type=\"submit\" name=\"option\" value=\"None\" class=\"button\">";
			   echo "</form>";


			   echo "<form METHOD=POST ACTION=\"index.php\">";
			   echo "<input type=\"submit\" name=\"option\" value=\"Set\" class=\"button\" style=\"width:50%;float:top;\">";
		 	   echo "<div style=\"float:left;display:inline-block;width:100%;margin-bottom:0px;\">";
		           echo "<table width=\"100%\" cellspacing=0 cellpadding=0 bgcolor=\"#F8F8F8\" style='border:1px solid #E2E2E2;border-collapse:collapse;font-size: 9px;'>";
			   echo "<input type=\"hidden\" name=\"plot\" value=\"$plot\">";
			   echo "<input type=\"hidden\" name=\"host\" value=\"$host\">";
			   echo "<input type=\"hidden\" name=\"sdate\" value=\"$sdate\">";
			   echo "<input type=\"hidden\" name=\"edate\" value=\"$edate\">";
			   $counter = 1;
			   $loop = 0;
			   $DEVS = "";
			   exec($devcommand,$DEVS);
			   $rowdiv = "";
		 	   foreach($DEVS as $dev) {
	  	    	   	$dev = rtrim($devtitle)."_".rtrim($dev);
				if ( $counter == 10 ) {
					$counter = 1;
					$loop = 1;
				}
				if ( $counter == 1 && $loop == 1 ) {
					$loop = 0;
				}
				$counter += 1;
				if ( $rowdiv == "" ) { echo "<tr style='border:1px solid #E2E2E2;font-size: 9px;'>"; }
				echo "<td width=\"10%\" style=\"border:1px solid #E2E2E2;font-size: 9px;\">";
				if (isset($_POST[$dev])) { 
				  echo "<input type=\"checkbox\" name=\"$dev\" value=\"CHECKED\" CHECKED class=\"cbox\"'/>";
				} else {
				  echo "<input type=\"checkbox\" name=\"$dev\" value=\"\" class=\"cbox\"'/>";
				}
				echo "</td>";
				echo "<td width=\"40%\" style=\"border:1px solid #E2E2E2;font-size: 9px;\">";
				echo "<span style='font-size:9pt;font-family:\"Arial\",\"sans-serif\";color:black;'>$dev</span>";
				echo "</td>";
				 if ( $rowdiv == "OK" ) 
				 { 
					echo "</tr>"; 
					$rowdiv = "";
				 } else { $rowdiv = "OK"; }
			   }
		 	   echo "</table>";
		 	   echo "</div>";
			   $goption = "";
		 	   foreach($arroption as $hoption)
			   {
	  	    	        $hoption = rtrim($hoption);
				if (isset($_POST[$hoption])) { 
				  echo "<input type=\"hidden\" name=\"$hoption\" value=\"CHECKED\">";
				}
			   }
	   	 	   foreach($arrspec as $goption)
			   {
				$goption = rtrim($goption);
				$gdevvar = "SA_" . $goption;
				$gdevtitle = $DEVICES->$gdevvar . "\n";
				if ( $goption != $soption ) { 
				  $gDEVS = "";
				  $gdevcommand = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${goption}.1* | awk -F-- '{ print $2 }' | sort -g"; /* modified by James Kenney */
				  exec($gdevcommand,$gDEVS);
		 	   	  foreach($gDEVS as $gdev) {
	  	    	   	   $gdev = rtrim($gdevtitle)."_".rtrim($gdev);
				   if ( $gdevtitle != $devtitle ) {
				    if (isset($_POST[$gdev])) { echo "<input type=\"hidden\" name=\"$gdev\" value=\"CHECKED\">";}}
				  }
				}
			   }
			   echo "</form>";
			}
	    		echo "</div>";
		    #}
		 }
		}


	?>
	  </div>
	</div>
	<div class="graphics">
<?php
	echo "<table width=\"100%\" border=\"0\" id=\"table\" CELLPADDING=\"0\" CELLSPACING=\"0\" bgcolor=\"white\">";
	if (isset($_POST['report'])) { 
	  $command ="./sar2html -p $host $sdate $edate 2> /dev/null";
	  if (exec($command)) {
		$calpos = 100;
		$calpag = 1;
		$firstpag = 1;
		$itemrem = "";
		$pdf = new PDF_Bookmark();
		$pdf->AddPage();
		$pdf->SetFont('Helvetica','','18');
		$pdf->SetFillColor(255,250,250);
		$pdf->SetDrawColor(64,0,0);
		$pdf->SetLineWidth(.1);
		$pdf->SetTextColor(128,0,0);
		$date = date('m/d/Y h:i:s a', time());
		$pdf->Cell(0,15,"sar2html",1,1,'C',true);
		$pdf->SetFont('Helvetica','','10');
		$pdf->SetTextColor(64,0,0);
		$pdf->Cell(50,5,"Report Generation Time: ",0,0,'L');
		$pdf->SetTextColor(0);
		$pdf->Cell(0,5,"$date",0,1,'L');
		$pdf->SetTextColor(64,0,0);
		$pdf->Cell(50,5,"Hostname: ",0,0,'L');
		$pdf->SetTextColor(0);
		$pdf->Cell(0,5,"$host",0,1,'L');
		$pdf->SetTextColor(64,0,0);
		$pdf->Cell(50,5,"Time Interval: ",0,0,'L');
		$pdf->SetTextColor(0);
		$pdf->Cell(0,5,"$sdate - $edate",0,1,'L');
		$pdf->SetTextColor(128,0,0);
		$pdf->Ln();
	 	$loption = "";
	   	foreach($arroption as $soption) 
	 	#while( list(,$soption) = each($loption) ) 
	 	{
		  $DEVS = "";
		  $DIVS = "";
		  $divrun = "";
	  	  $soption = rtrim($soption);
		  $firstdev = "";
		  if (isset($_POST[$soption])) { 
		   if ( in_array($soption,$arrspec) ) {
			$divopt = "";
			$divrun = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${soption}.* | awk -F-- '{ print $1 }' | sort | grep -v ^$ | uniq"; /* modified by James Kenney */
   			exec($divrun,$DIVS);
			$devvar = "SA_" . $soption;
			$devtitle = $DEVICES->$devvar . "\n";
	   		foreach($DIVS as $div) {
			 $DEVS = "";
			 $devcommand = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${soption}.1* | awk -F-- '{ print $2 }' | grep -v ^$ | sort -g"; /* modified by James Kenney */
   			 exec($devcommand,$DEVS);
	   		 foreach($DEVS as $dev) {
	  	    	  $namedev = rtrim($devtitle)."_".rtrim($dev);
			  if (isset($_POST[$namedev])) { 
			   $divarray = explode(".", $div);
			   $divhead = $divarray[0];
			   $divhead = "_$divhead";
			   $divhead = "$osver$divhead";
			   $expo = $OPTIONS->$divhead . "\n";
			   if ( $itemrem != $expo) { 
				$itemrem = $expo;
				if ( $calpos != 100 ) {
				  	if ( $calpos != 10 ) { $pdf->AddPage(); }
					$pdf->Cell(0,5,"$expo",0,1,'L');
					$calpos = 14;
					$calpag = 1;
					$firstpag = 0;
				} else {
					$pdf->Cell(0,91,"$expo",0,1,'L');
				}
				$pdf->Bookmark("$expo");
			   }
			   echo "<tr>";
			   echo "<td colspan=\"3\" valign=\"top\">";
			   echo "<p align=\"center\">";
			   if ( $firstdev == "" )
			   {
			     echo "<a name=\"chapter_$soption\"><img border=\"0\" src=\"sarDATA/$host/$sdate-$edate/images/$div--$dev.png\" width=\"630\" height=\"350\"></a>";
			     $firstdev = "OK";
			   } else {
			     echo "<img border=\"0\" src=\"sarDATA/$host/$sdate-$edate/images/$div--$dev.png\" width=\"630\" height=\"350\">";
			   }
			   $pdf->Image("sarDATA/$host/$sdate-$edate/images/$div--$dev.png",20,$calpos,167,93,'png');
			   if ( $firstpag==1 ) { $piccount = 2; } else { $piccount = 3; }
			   if ( $calpag<$piccount ) {
				$calpos = $calpos + 93;
				$calpag = $calpag + 1;
			   } else { 
				$pdf->AddPage();
				$calpos = 10;
				$calpag = 1;
				$firstpag = 0;
			   }
			   echo "</tr>";
			   echo "<tr>";
			   echo "<td width=\"787\" valign=\"top\" colspan=\"3\">&nbsp;</td>";
			   echo "</tr>";
			  }
			 }
			}
		    } else {
			$divopt = "";
			$divrun = "cd sarDATA/${host}/report/ && LC_ALL=C grep -F -l ${sdate} ${soption}.* | sort -g"; /* modified by James Kenney */
   			exec($divrun,$DIVS);
	   		foreach($DIVS as $div) {
		   	#while( list(,$div) = each($DIVS) ) {
	  	  	   $div = rtrim($div);
			   $divarray = explode(".", $div);
			   $divhead = $divarray[0];
			   $divhead = "_$divhead";
			   $divhead = "$osver$divhead";
			   $expo = $OPTIONS->$divhead . "\n";
			   if ( $itemrem != $expo) { 
				$itemrem = $expo;
				if ( $calpos != 100 ) {
				  	if ( $calpos != 10 ) { $pdf->AddPage(); }
					$pdf->Cell(0,5,"$expo",0,1,'L');
					$calpos = 14;
					$calpag = 1;
					$firstpag = 0;
				} else {
					$pdf->Cell(0,91,"$expo",0,1,'L');
				}
				$pdf->Bookmark("$expo");
			   }
			   echo "<tr>";
			   echo "<td colspan=\"3\" valign=\"top\">";
			   echo "<p align=\"center\">";
			   echo "<a name=\"chapter_$soption\"><img border=\"0\" src=\"sarDATA/$host/$sdate-$edate/images/$div.png\" width=\"630\" height=\"350\"></a>";
			   $pdf->Image("sarDATA/$host/$sdate-$edate/images/$div.png",20,$calpos,167,93,'png');
			   if ( $firstpag==1 ) { $piccount = 2; } else { $piccount = 3; }
			   if ( $calpag<$piccount ) {
				$calpos = $calpos + 93;
				$calpag = $calpag + 1;
			   } else { 
				$pdf->AddPage();
				$calpos = 10;
				$calpag = 1;
				$firstpag = 0;
			   }
			   echo "</tr>";
			   echo "<tr>";
			   echo "<td width=\"787\" valign=\"top\" colspan=\"3\">&nbsp;</td>";
			   echo "</tr>";
			}
		    }
		   }
		 }
		$repdate = date('Y.m.d', time());
		list($osinf,$hostinf) = explode("/", $host, 2);
		$command ="if [ ! -d sarDATA/" . $host . "/" . $sdate . "-" . $edate . "/sar2pdf ]; then mkdir sarDATA/" . $host . "/" . $sdate . "-" . $edate . "/sar2pdf; fi";
		exec($command);
	 	$pdf->Output("sarDATA/$host/$sdate-$edate/sar2pdf/sar2html-$hostinf-$repdate.pdf", 'F');
		echo "<a href=\"sarDATA/$host/$sdate-$edate/sar2pdf/sar2html-$hostinf-$repdate.pdf\" style=\"font-size: 8pt;font-family:\"Arial\",\"sans-serif\">Download report as PDF</a>";
	  } else {
	  	echo "Unexpected Error";
	  	echo "<form METHOD=POST ACTION=\"index.php\">";
	  	echo "<input type=\"submit\" value=\"OK\" style=\"width:70;height: 20px; font-size: 9pt\" /></td>";
	  	echo "</form>";
	  }
	} else {
		echo "<b><u><span style='font-size:10pt;font-family:\"Arial\",\"sans-serif\"'>COLLECTING SAR DATA</b></u></span>";
		echo "<br><span style='font-size:8pt;font-family:\"Arial\",\"sans-serif\"'><br>";
		echo "1. Use sar2ascii to generate a report:";
		echo "<UL>";
		echo "<LI>Download following tool to collect sar data from servers: <a href=\"sarFILE/sar2ascii.tar\">sar2ascii.tar</a>.";
		echo "<LI>Untar it on the server which you will examine performance data.";
		echo "<LI>For HPUX servers run \"sh sar2ascii\".";
		echo "<LI>For Linux or Sun Solaris servers run \"bash sar2ascii\".";
		echo "<LI>It will create the report with name sar2html-hostname-date.tar.gz under /tmp directory.";
		echo "<LI>Click \"NEW\" button, browse and select the report, click \"Upload report\" button to upload the data.";
		echo "<LI>Or simply type \"sar2html -m {sar2html report}\" at command prompt.";
		echo "</UL>";
		echo "2. Use built in report generator:";
		echo "<UL>";
		echo "<LI>Click \"NEW\" button, enter ip address of host, user name and password and click \"Capture report\" button.";
		echo "<LI>Or simply type \"sar2html -a [host ip] [user name] [password]\" at command prompt.";
		echo "</UL>";
		echo "NOTE: If sar data is not available even it is installed you need to add following lines to crontab:<br>";
		echo "HP-UX:";
		echo "<UL>";
		echo "0,10,20,30,40,50 * * * * /usr/lbin/sa/sa1<br>";
		echo "5 18 * * * /usr/lbin/sa/sa2 -A<br>";
		echo "</UL>";
		echo "SOLARIS:";
		echo "<UL>";
		echo "0,10,20,30,40,50 * * * * /usr/lib/sa/sa1<br>";
		echo "5 18 * * * /usr/lib/sa/sa2 -A<br>";
		echo "</UL>";
		echo "</span>";

		echo "<br><b><u><span style='font-size:10pt;font-family:\"Arial\",\"sans-serif\"'>INSTALLATION</b></u></span>";
		echo "<br><span style='font-size:8pt;font-family:\"Arial\",\"sans-serif\"'>";
		echo "<UL>";
		echo "<LI>Plotting tools, sar2html and index.php only run on Linux server.<br>";
		echo "<LI>HPUX 11.11, 11.23, 11,31, Redhat 3, 4, 5, 6, 7, Suse 8, 9, 10, 11, 12, Ubuntu 18  and Solaris 5.9, 5.10 are supported for reporting.<br>";
		echo "<LI>Install Apache2, Php5, Expect and GnuPlot with png support (Suse11 is recommended. It provides gnuplot with native png support.)<br>";
		echo "<LI>Edit php.ini file and set:<br>";
		echo "`upload_max_filesize` to 2GB.<br>";
		echo "`post_max_size` to 80MB.<br>";
		echo "<LI>Extract sar2html.tar.gz under root directory of your web server or create subdirectory for it.";
		echo "<LI>Run `./sar2html -c` in order to configure sar2html. You need to know apache user and group for setup." ;
		echo "<LI>Open http://[IP ADDRESS OF WEB SERVER]/index.php" ;
		echo "<LI>Now it is ready to work." ;
		echo "</UL>";
		echo "</span>";
	}

	echo "</table>";
	echo "</body>";
	echo "</html>";





}
?>
</div>
</div>
