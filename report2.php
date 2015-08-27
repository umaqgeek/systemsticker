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
    <td align="center" valign="top"><a href="viewAdminStickers.php">View Stickers &amp; Approval</a> | <a href="report2.php">Report Total Approval</a> | <a href="reportAndStatistic.php">Report &amp; Statistic</a> | <a onclick="return confirm('Are you sure want to logout?');" href="<?php echo $logoutAction ?>">Log Out</a></td>
  </tr>
  <tr>
    <td height="400" align="center" valign="top"><!-- InstanceBeginEditable name="content" -->
      <table border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td align="center" valign="top">
              <h3>Total Registered by Unit</h3>
              <p>
                  <?php
                  $sql = "SELECT * FROM unit_tentera";
                  $r1 = mysql_query($sql) or die(mysql_error());
                  $t1 = mysql_num_rows($r1);
                  $d1 = mysql_fetch_array($r1);
                  ?>
              <table border="1" cellpadding="5" cellspacing="0">
                  <tr>
                      <th>Unit</th>
                      <th>Total</th>
                  </tr>
                  <?php 
                  if ($t1 > 0) { 
                      do { 
                          $ut_id = $d1['ut_id'];
                          $sql2 = sprintf("SELECT * "
                                  . "FROM pengguna pe "
                                  . "WHERE pe.ut_id = '%s' ", $ut_id);
                          $r2 = mysql_query($sql2) or die(mysql_error());
                          $t2 = mysql_num_rows($r2);
                  ?>
                  <tr>
                      <td><?php echo $d1['ut_desc']; ?></td>
                      <td><?php echo $t2; ?></td>
                  </tr>
                  <?php } while ($d1 = mysql_fetch_array($r1)); } ?>
              </table>
              </p>
          </td>
          <td width="20px">&nbsp;</td>
          <td align="center" valign="top">
              <h3>Total Registered by Unit</h3>
              <p>
                  <?php
                  $sql = "SELECT * FROM unit_tentera";
                  $r1 = mysql_query($sql) or die(mysql_error());
                  $t1 = mysql_num_rows($r1);
                  $d1 = mysql_fetch_array($r1);
                  ?>
              <table border="1" cellpadding="5" cellspacing="0">
                  <tr>
                      <th rowspan="2">Unit</th>
                      <th colspan="2">Total</th>
                  </tr>
                  <tr>
                      <th>Approved</th>
                      <th>Not Approved</th>
                  </tr>
                  <?php 
                  if ($t1 > 0) { 
                      do { 
                          $ut_id = $d1['ut_id'];
                          $sql21 = sprintf("SELECT * "
                                  . "FROM pelekat pel, pengguna pe "
                                  . "WHERE pel.pe_id = pe.pe_id "
                                  . "AND pe.ut_id = '%s' "
                                  . "AND pel.pel_status = 1 ", $ut_id);
                          $r21 = mysql_query($sql21) or die(mysql_error());
                          $t21 = mysql_num_rows($r21);
                          $sql22 = sprintf("SELECT * "
                                  . "FROM pelekat pel, pengguna pe "
                                  . "WHERE pel.pe_id = pe.pe_id "
                                  . "AND pe.ut_id = '%s' "
                                  . "AND pel.pel_status <> 1 ", $ut_id);
                          $r22 = mysql_query($sql22) or die(mysql_error());
                          $t22 = mysql_num_rows($r22);
                  ?>
                  <tr>
                      <td><?php echo $d1['ut_desc']; ?></td>
                      <td><?php echo $t21; ?></td>
                      <td><?php echo $t22; ?></td>
                  </tr>
                  <?php } while ($d1 = mysql_fetch_array($r1)); } ?>
              </table>
              </p>
          </td>
        </tr>
      </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td align="center" valign="top"><hr />
      <h3><br>
    Alright Reserved</h3></td>
  </tr>
</table><!-- InstanceEnd -->