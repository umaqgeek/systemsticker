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
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
$query_pel = "SELECT * FROM pelekat pel, pengguna pe, jenis_kenderaan jk, model_kenderaan mk 
WHERE pel.pe_id = pe.pe_id 
AND pel.jk_id = jk.jk_id 
AND pel.mk_id = mk.mk_id 
AND pel.pel_status = 1 ";
$pe = mysql_query($query_pel, $systemsticker_conn) or die(mysql_error());
$row_pe = mysql_fetch_assoc($pe);
$totalRows_pel = mysql_num_rows($pe);
?>
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
    
    <table border="1" cellpadding="5" cellspacing="0">
          <tr>
            <td>No.</td>
            <td>Apply Date</td>
            <td>Vehicle Registration No.</td>
            <td>License No.</td>
            <td>License Expired Date</td>
            <td>License Support Document</td>
            <td>Roadtax No.</td>
            <td>Roadtax Expired Date</td>
            <td>Roadtax Support Document</td>
            <td>Vehicle Type</td>
            <td>Model</td>
            <td colspan="2" align="center">Action</td>
          </tr>
          <?php if ($totalRows_pel > 0) { ?>
          <?php $i=1; do { ?>
            <tr>
              <td><?php echo $i++; ?>.&nbsp;</td>
              <td><?php echo $row_pe['pel_regdate']; ?></td>
              <td><?php echo $row_pe['pel_noplat']; ?></td>
              <td><?php echo $row_pe['pel_nolesen']; ?></td>
              <td><?php echo $row_pe['pel_lesentamat']; ?></td>
              <td><a target="_blank" href="assets/uploads/<?php echo $row_pe['pel_lesenimage']; ?>"><?php echo $row_pe['pel_lesenimage']; ?></a></td>
              <td><?php echo $row_pe['pel_noroadtax']; ?></td>
              <td><?php echo $row_pe['pel_roadtaxtamat']; ?></td>
              <td><a target="_blank" href="assets/uploads/<?php echo $row_pe['pel_roadtaximage']; ?>"><?php echo $row_pe['pel_roadtaximage']; ?></td>
            </td>
            
            <td><?php echo $row_pe['jk_desc']; ?></td>
              <td><?php echo $row_pe['mk_desc']; ?></td>
              <td><a href="detailView1.php?idd=<?php echo $row_pe['pel_id']; ?>">Detail</a></td>
              <td><?php 
			  $pel_status = $row_pe['pel_status']; 
			  $str = "[Not Approved]<br />Approve it ..";
			  if ($pel_status == 2) { $str = "[Approved]<br />Cancel approval .."; } ?>
              <a href="approveSticker.php?id=<?php echo $row_pe['pel_id']; ?>&pel_status=<?php echo $pel_status; ?>"><?php echo $str; ?></a>
              </td>
            </tr>
            <?php } while ($row_pe = mysql_fetch_assoc($pe)); ?>
          <?php } else { ?>
          <tr>
            <td colspan="13"><em>... No data ...</em></td>
          </tr>
          <?php } ?>
        </table>
    
     <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td align="center" valign="top"><hr />
      <h3><br>
    Alright Reserved</h3></td>
  </tr>
</table><!-- InstanceEnd -->