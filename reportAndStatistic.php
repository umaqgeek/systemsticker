<!-- InstanceBegin template="/Templates/pageAdmin.dwt.php" codeOutsideHTMLIsLocked="false" --><?php require_once('Connections/systemsticker_conn.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php?error=2";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<style type="text/css">
.kepala {
	color: #999;
}
</style>

<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td align="center" valign="top"><h1>Sticker Management System<br><hr />
    </h1></td>
  </tr>
  <tr>
    <td align="center" valign="top"><a href="viewAdminStickers.php">View Stickers &amp; Approval</a> | <a href="reportAndStatistic.php">Report &amp; Statistic</a> | <a onclick="return confirm('Are you sure want to logout?');" href="<?php echo $logoutAction ?>">Log Out</a></td>
  </tr>
  <tr>
    <td height="400" align="center" valign="top"><!-- InstanceBeginEditable name="content" -->
    <script src="assets/js/Chart.js"></script>
      <table width="70%" border="0" cellpadding="5" cellspacing="0">
      	<tr>
          <td width="50%" align="left" valign="top"><h3>Approve / Not Approve</h3>
          <p><canvas id="canvas7"></canvas>&nbsp;</p></td>
          <td width="50%" align="left" valign="top"><h3>Total User Registered</h3>
          <p><canvas id="canvas8"></canvas>&nbsp;</p></td>
        </tr>
        <tr>
          <td>
              <h3>Full Graph</h3>
              <p><canvas id="canvasx"></canvas></p>
          </td>
          <td>
          	  <table cellpadding="5" cellspacing="0" border="1">
              	<tr>
                	<th rowspan="2">Car</th>
                    <th>Not Apply Sticker</th>
                    <th width="20px"><div style="background-color:rgba(0,0,220,0.8); width:100; height:10;"></div></th>
                </tr>
                <tr>
                	<th>Apply Sticker</th>
                    <th><div style="background-color:rgba(220,0,0,0.8); width:100; height:10;"></div></th>
                </tr>
                <tr>
                	<th rowspan="2">Motorcycle</th>
                    <th>Not Apply Sticker</th>
                    <th width="20px"><div style="background-color:rgba(0,220,0,0.8); width:100; height:10;"></div></th>
                </tr>
                <tr>
                	<th>Apply Sticker</th>
                    <th><div style="background-color:rgba(220,0,220,0.8); width:100; height:10;"></div></th>
                </tr>
              </table>
          </td>
        </tr>
        <tr>
          <td width="50%" align="left" valign="top"><h3>Army Unit</h3>
          <p><canvas id="canvas5"></canvas>&nbsp;</p></td>
          <td width="50%" align="left" valign="top"><h3>User Type</h3>
          <p><canvas id="canvas6"></canvas>&nbsp;</p></td>
        </tr>
        <tr>
          <td align="left" valign="top"><h3>License Expired and Not Expired</h3>
          <p><canvas id="canvas22"></canvas>&nbsp;</p></td>
          <td align="left" valign="top"><h3>Race</h3>
          <p><canvas id="canvas3"></canvas>&nbsp;</p></td>
        </tr>
        <tr>
          <td align="left" valign="top"><h3>Gender</h3>
          <p><canvas id="canvas4"></canvas>&nbsp;</p></td>
          <td align="left" valign="top"><h3>Vehicle Type</h3>
          <p><canvas id="canvas1"></canvas>&nbsp;</p></td>
        </tr>
        <tr>
          <td align="left" valign="top"><h3>Roadtax Expired and Not Expired</h3>
          <p><canvas id="canvas21"></canvas>&nbsp;</p></td>
          <td align="left" valign="top">&nbsp;</td>
        </tr>
      </table>
      
      <?php
	  $sqlx = 'SELECT * FROM unit_tentera ';
	  $rx = mysql_query($sqlx) or die(mysql_error());
	  $tx = mysql_num_rows($rx);
	  $dx = mysql_fetch_array($rx);
	  $lblx = '';
	  $valx11 = '';
	  $valx12 = '';
	  $valx2 = '';
	  $valx3 = '';
	  if ($tx > 0) {
		  do {
			  $unit = $dx['ut_desc'];
			  $ut_id = $dx['ut_id'];
			  $lblx .= '"'.$unit.'",';
			  $sqlx1 = sprintf("SELECT pe.pe_id 
							   FROM pengguna pe 
							   WHERE pe.ut_id = '%s' ", $ut_id);
			  $rx1 = mysql_query($sqlx1) or die(mysql_error());
			  $tx1 = mysql_num_rows($rx1);
			  $sqlx2 = sprintf("SELECT pe.pe_id 
							   FROM pengguna pe, pelekat pel 
							   WHERE pe.pe_id = pel.pe_id 
							   AND pe.ut_id = '%s' 
							   AND pel.jk_id = 1 ", $ut_id);
			  $rx2 = mysql_query($sqlx2) or die(mysql_error());
			  $tx2 = mysql_num_rows($rx2);
			  $sqlx3 = sprintf("SELECT pe.pe_id 
							   FROM pengguna pe, pelekat pel 
							   WHERE pe.pe_id = pel.pe_id 
							   AND pe.ut_id = '%s' 
							   AND pel.jk_id = 2 ", $ut_id);
			  $rx3 = mysql_query($sqlx3) or die(mysql_error());
			  $tx3 = mysql_num_rows($rx3);
			  $tak_mohon_kereta = $tx1 - $tx2;
			  $tak_mohon_motor = $tx1 - $tx3;
			  $mohon_kereta = $tx2;
			  $mohon_motor = $tx3;
			  $valx11 .= $tak_mohon_kereta.',';
			  $valx12 .= $tak_mohon_motor.',';
			  $valx2 .= $mohon_kereta.',';
			  $valx3 .= $mohon_motor.',';
		  } while ($dx = mysql_fetch_array($rx));
	  }
	  
	  $sql1 = 'SELECT jk.jk_desc, COUNT(*) AS kira FROM pelekat pel, jenis_kenderaan jk WHERE pel.jk_id = jk.jk_id GROUP BY pel.jk_id';
	  $r1 = mysql_query($sql1) or die(mysql_error());
	  $t1 = mysql_num_rows($r1);
	  $d1 = mysql_fetch_array($r1);
	  $lbl1 = '';
	  $val1 = '';
	  if ($t1 > 0) {
		  do {
			  $jk_desc = $d1['jk_desc'];
			  $kira = $d1['kira'];
			  $lbl1 .= '"' . $jk_desc . '",';
			  $val1 .= $kira . ',';
		  } while($d1 = mysql_fetch_array($r1));
	  }
	  
	  // roadtax not expired
	  $sql21 = 'SELECT * FROM pelekat WHERE DATE(pel_roadtaxtamat) >= DATE(NOW())';
	  $r21 = mysql_query($sql21) or die(mysql_error());
	  $t21 = mysql_num_rows($r21);
	  // roadtax expired
	  $sql22 = 'SELECT * FROM pelekat WHERE DATE(pel_roadtaxtamat) < DATE(NOW())';
	  $r22 = mysql_query($sql22) or die(mysql_error());
	  $t22 = mysql_num_rows($r22);
	  // license not expired
	  $sql23 = 'SELECT * FROM pelekat WHERE DATE(pel_lesentamat) >= DATE(NOW())';
	  $r23 = mysql_query($sql23) or die(mysql_error());
	  $t23 = mysql_num_rows($r23);
	  // license expired
	  $sql24 = 'SELECT * FROM pelekat WHERE DATE(pel_lesentamat) < DATE(NOW())';
	  $r24 = mysql_query($sql24) or die(mysql_error());
	  $t24 = mysql_num_rows($r24);
	  // graf
	  $lbl2 = '"Not Expired", "Expired"';
	  $val21 = $t21 . ', ' . $t22;
	  $val22 = $t23 . ', ' . $t24;
	  
	  $sql3 = 'SELECT ba.ba_desc, COUNT(*) AS kira FROM pengguna pe, bangsa ba WHERE pe.ba_id = ba.ba_id GROUP BY ba.ba_id';
	  $r3 = mysql_query($sql3) or die(mysql_error());
	  $t3 = mysql_num_rows($r3);
	  $d3 = mysql_fetch_array($r3);
	  $lbl3 = '';
	  $val3 = '';
	  if ($t3 > 0) {
		  do {
			  $ba_desc = $d3['ba_desc'];
			  $kira = $d3['kira'];
			  $lbl3 .= '"' . $ba_desc . '",';
			  $val3 .= $kira . ',';
		  } while($d3 = mysql_fetch_array($r3));
	  }
	  
	  // male
	  $sql41 = 'SELECT * FROM pengguna pe, jantina ja WHERE pe.ja_id = ja.ja_id AND ja.ja_id = 1';
	  $r41 = mysql_query($sql41) or die(mysql_error());
	  $t41 = mysql_num_rows($r41);
	  // female
	  $sql42 = 'SELECT * FROM pengguna pe, jantina ja WHERE pe.ja_id = ja.ja_id AND ja.ja_id = 2';
	  $r42 = mysql_query($sql42) or die(mysql_error());
	  $t42 = mysql_num_rows($r42);
	  $lbl4 = '"Male", "Female"';
	  $val4 = $t41 . ', ' . $t42;
	  
	  // report based on unit tentera
	  $sql5 = 'SELECT * FROM unit_tentera';
	  $r5 = mysql_query($sql5) or die(mysql_error());
	  $t5 = mysql_num_rows($r5);
	  $d5 = mysql_fetch_array($r5);
	  $lbl5 = '';
	  $val5 = '';
	  if ($t5 > 0) {
		  do {
			  $ut_id = $d5['ut_id'];
			  $ut_desc = $d5['ut_desc'];
			  $sql51 = sprintf("SELECT * FROM pelekat pel, pengguna pe WHERE pel.pe_id = pe.pe_id AND pe.ut_id = '%s' ", $ut_id);
			  $r51 = mysql_query($sql51) or die(mysql_error());
			  $t51 = mysql_num_rows($r51);
			  $lbl5 .= '"' . $ut_desc . '",';
			  $val5 .= $t51 . ',';
		  } while($d5 = mysql_fetch_array($r5));
	  }
	  
	  // report based on jenis pengguna
	  $sql6 = 'SELECT * FROM jenis_pengguna';
	  $r6 = mysql_query($sql6) or die(mysql_error());
	  $t6 = mysql_num_rows($r6);
	  $d6 = mysql_fetch_array($r6);
	  $lbl6 = '';
	  $val6 = '';
	  if ($t6 > 0) {
		  do {
			  $jp_id = $d6['jp_id'];
			  $jp_desc = $d6['jp_desc'];
			  $sql61 = sprintf("SELECT * FROM pelekat pel, pengguna pe WHERE pel.pe_id = pe.pe_id AND pe.jp_id = '%s' ", $jp_id);
			  $r61 = mysql_query($sql61) or die(mysql_error());
			  $t61 = mysql_num_rows($r61);
			  $lbl6 .= '"' . $jp_desc . '",';
			  $val6 .= $t61 . ',';
		  } while($d6 = mysql_fetch_array($r6));
	  }
          
          // report sticker belum approve
          $lbl7 = '"Not Approve"';
          $sql71 = 'SELECT * FROM pelekat WHERE pel_status = 1';
          $r71 = mysql_query($sql71) or die(mysql_error());
	  $t71 = mysql_num_rows($r71);
          $val7 = $t71;
          
          // report sticker sudah approve
          $lbl7 .= ',"Approve"';
          $sql72 = 'SELECT * FROM pelekat WHERE pel_status = 2 OR pel_status = 3';
          $r72 = mysql_query($sql72) or die(mysql_error());
	  $t72 = mysql_num_rows($r72);
          $val7 .= ',' . $t72;
          
          // report total user yang da register
          $sql8 = 'SELECT * FROM pengguna';
          $r8 = mysql_query($sql8) or die(mysql_error());
	  $t8 = mysql_num_rows($r8);
          $lbl8 = '"Total User"';
          $val8 = $t8;
	  ?>
      
      <script>
	  var barChartDatax = {
		labels : [<?php echo $lblx; ?>],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(0,0,220,0.8)",
				highlightFill: "rgba(0,0,220,0.75)",
				highlightStroke: "rgba(0,0,220,1)",
				data : [<?php echo $valx11; ?>]
			}, {
				fillColor : "rgba(220,0,0,0.5)",
				strokeColor : "rgba(220,0,0,0.8)",
				highlightFill: "rgba(220,0,0,0.75)",
				highlightStroke: "rgba(220,0,0,1)",
				data : [<?php echo $valx2; ?>]
			}, {
				fillColor : "rgba(0,220,0,0.5)",
				strokeColor : "rgba(0,220,0,0.8)",
				highlightFill: "rgba(0,220,0,0.75)",
				highlightStroke: "rgba(0,220,0,1)",
				data : [<?php echo $valx12; ?>]
			}, {
				fillColor : "rgba(220,0,220,0.5)",
				strokeColor : "rgba(220,0,220,0.8)",
				highlightFill: "rgba(220,0,220,0.75)",
				highlightStroke: "rgba(220,0,220,1)",
				data : [<?php echo $valx3; ?>]
			}
		]
	}
	  var barChartData1 = {
		labels : [<?php echo $lbl1; ?>],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(0,0,220,0.8)",
				highlightFill: "rgba(0,0,220,0.75)",
				highlightStroke: "rgba(0,0,220,1)",
				data : [<?php echo $val1; ?>]
			}
		]
	}
	var barChartData21 = {
		labels : [<?php echo $lbl2; ?>],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(0,0,220,0.8)",
				highlightFill: "rgba(0,0,220,0.75)",
				highlightStroke: "rgba(0,0,220,1)",
				data : [<?php echo $val21; ?>]
			}
		]
	}
	var barChartData22 = {
		labels : [<?php echo $lbl2; ?>],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(0,0,220,0.8)",
				highlightFill: "rgba(0,0,220,0.75)",
				highlightStroke: "rgba(0,0,220,1)",
				data : [<?php echo $val22; ?>]
			}
		]
	}
	var barChartData3 = {
		labels : [<?php echo $lbl3; ?>],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(0,0,220,0.8)",
				highlightFill: "rgba(0,0,220,0.75)",
				highlightStroke: "rgba(0,0,220,1)",
				data : [<?php echo $val3; ?>]
			}
		]
	}
	var barChartData4 = {
		labels : [<?php echo $lbl4; ?>],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(0,0,220,0.8)",
				highlightFill: "rgba(0,0,220,0.75)",
				highlightStroke: "rgba(0,0,220,1)",
				data : [<?php echo $val4; ?>]
			}
		]
	}
	var barChartData5 = {
		labels : [<?php echo $lbl5; ?>],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(0,0,220,0.8)",
				highlightFill: "rgba(0,0,220,0.75)",
				highlightStroke: "rgba(0,0,220,1)",
				data : [<?php echo $val5; ?>]
			}
		]
	}
	var barChartData6 = {
		labels : [<?php echo $lbl6; ?>],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(0,0,220,0.8)",
				highlightFill: "rgba(0,0,220,0.75)",
				highlightStroke: "rgba(0,0,220,1)",
				data : [<?php echo $val6; ?>]
			}
		]
	}
        var barChartData7 = {
		labels : [<?php echo $lbl7; ?>],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(0,0,220,0.8)",
				highlightFill: "rgba(0,0,220,0.75)",
				highlightStroke: "rgba(0,0,220,1)",
				data : [<?php echo $val7; ?>]
			}
		]
	}
        var barChartData8 = {
		labels : [<?php echo $lbl8; ?>],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(0,0,220,0.8)",
				highlightFill: "rgba(0,0,220,0.75)",
				highlightStroke: "rgba(0,0,220,1)",
				data : [<?php echo $val8; ?>]
			}
		]
	}
	window.onload = function(){
		var ctxx = document.getElementById("canvasx").getContext("2d");
		window.myBar = new Chart(ctxx).Bar(barChartDatax, {
			responsive : true
		});
		var ctx1 = document.getElementById("canvas1").getContext("2d");
		window.myBar = new Chart(ctx1).Bar(barChartData1, {
			responsive : true
		});
		var ctx21 = document.getElementById("canvas21").getContext("2d");
		window.myBar = new Chart(ctx21).Bar(barChartData21, {
			responsive : true
		});
		var ctx22 = document.getElementById("canvas22").getContext("2d");
		window.myBar = new Chart(ctx22).Bar(barChartData22, {
			responsive : true
		});
		var ctx3 = document.getElementById("canvas3").getContext("2d");
		window.myBar = new Chart(ctx3).Bar(barChartData3, {
			responsive : true
		});
		var ctx4 = document.getElementById("canvas4").getContext("2d");
		window.myBar = new Chart(ctx4).Bar(barChartData4, {
			responsive : true
		});
		var ctx5 = document.getElementById("canvas5").getContext("2d");
		window.myBar = new Chart(ctx5).Bar(barChartData5, {
			responsive : true
		});
		var ctx6 = document.getElementById("canvas6").getContext("2d");
		window.myBar = new Chart(ctx6).Bar(barChartData6, {
			responsive : true
		});
		var ctx7 = document.getElementById("canvas7").getContext("2d");
		window.myBar = new Chart(ctx7).Bar(barChartData7, {
			responsive : true
		});
		var ctx8 = document.getElementById("canvas8").getContext("2d");
		window.myBar = new Chart(ctx8).Bar(barChartData8, {
			responsive : true
		});
	}
	  </script>
      
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td align="center" valign="top"><hr />
      <h3><br>
    Alright Reserved</h3></td>
  </tr>
</table><!-- InstanceEnd -->