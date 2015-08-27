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
$colname_pel = "-1";
if (isset($_GET['idd'])) {
  $colname_pel = $_GET['idd'];
}
mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
$query_pel = sprintf("SELECT * FROM pelekat pel, pengguna pe, jenis_kenderaan jk, model_kenderaan mk, jenis_pengguna jp, bangsa ba, jantina ja, unit_tentera ut WHERE pel.pe_id = pe.pe_id  AND pel.jk_id = jk.jk_id  AND pel.mk_id = mk.mk_id  AND pe.jp_id = jp.jp_id  AND pe.ba_id = ba.ba_id  AND pe.ja_id = ja.ja_id  AND pe.ut_id = ut.ut_id   AND pel.pel_id = %s", GetSQLValueString($colname_pel, "int"));
$pel = mysql_query($query_pel, $systemsticker_conn) or die(mysql_error());
$row_pel = mysql_fetch_assoc($pel);
$totalRows_pel = mysql_num_rows($pel);
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
    <td align="center" valign="top"><a href="viewAdminStickers.php">View Stickers &amp; Approval</a> | <a href="report2.php">Report Total Approval</a> | <a href="reportAndStatistic.php">Report &amp; Statistic</a> | <a onclick="return confirm('Are you sure want to logout?');" href="<?php echo $logoutAction ?>">Log Out</a></td>
  </tr>
  <tr>
    <td height="400" align="center" valign="top"><!-- InstanceBeginEditable name="content" -->
      <table border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td align="center" valign="top"><table border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td colspan="3"><strong>BIODATA</strong></td>
            </tr>
            <tr>
              <td colspan="3"><hr /></td>
              </tr>
            <tr>
              <td><strong>Username</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pe_username']; ?></td>
            </tr>
            <tr>
              <td><strong>Full Name</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pe_fullname']; ?></td>
            </tr>
            <tr>
              <td><strong>Email</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pe_email']; ?></td>
            </tr>
            <tr>
              <td><strong>National ID / IC / Passport No.</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pe_idno']; ?></td>
            </tr>
            <tr>
              <td><strong>Rank / Resignation</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pe_jawatan']; ?></td>
            </tr>
            <tr>
              <td><strong>Address</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pe_alamat']; ?></td>
            </tr>
            <tr>
              <td><strong>Birth Date</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pe_tarikhlahir']; ?></td>
            </tr>
            <tr>
              <td><strong>Phone No.</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pe_telefon']; ?></td>
            </tr>
            <tr>
              <td><strong>Race</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['ba_desc']; ?></td>
            </tr>
            <tr>
              <td><strong>User Type</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['jp_desc']; ?></td>
            </tr>
            <tr>
              <td><strong>Gender</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['ja_desc']; ?></td>
            </tr>
            <tr>
              <td><strong>Military Unit</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['ut_desc']; ?></td>
            </tr>
            <tr>
              <td><strong>Registration Date</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pe_regdate']; ?></td>
            </tr>
          </table></td>
          <td align="center" valign="top"><table border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td colspan="3"><strong>STICKER INFORMATION</strong></td>
            </tr>
            <tr>
              <td colspan="3"><hr /></td>
              </tr>
            <tr>
              <td><strong>Vehicle Type</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['jk_desc']; ?></td>
            </tr>
            <tr>
              <td><strong>Apply Date</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pel_regdate']; ?></td>
            </tr>
            <tr>
              <td><strong>Expired Date</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pel_expireddate']; ?></td>
            </tr>
            <tr>
              <td><strong>Vehicle Registration No.</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pel_noplat']; ?></td>
            </tr>
            <tr>
              <td><strong>Vehicle Model</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['mk_desc']; ?></td>
            </tr>
            <tr>
              <td><strong>License No.</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pel_nolesen']; ?></td>
            </tr>
            <tr>
              <td><strong>License Expired Date</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pel_lesentamat']; ?></td>
            </tr>
            <tr>
              <td><strong>License Support Document</strong></td>
              <td><strong>:</strong></td>
              <td><a target="_blank" href="assets/uploads/<?php echo $row_pel['pel_lesenimage']; ?>"><?php echo $row_pel['pel_lesenimage']; ?></a></td>
            </tr>
            <tr>
              <td><strong>Roadtax No.</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pel_noroadtax']; ?></td>
            </tr>
            <tr>
              <td><strong>Roadtax Expired Date</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo $row_pel['pel_roadtaxtamat']; ?></td>
            </tr>
            <tr>
              <td><strong>Roadtax Support Document</strong></td>
              <td><strong>:</strong></td>
              <td><a target="_blank" href="assets/uploads/<?php echo $row_pel['pel_roadtaximage']; ?>"><?php echo $row_pel['pel_roadtaximage']; ?></a></td>
            </tr>
            <tr>
              <td><strong>Status</strong></td>
              <td><strong>:</strong></td>
              <td><?php echo ($row_pel['pel_status'] == 2) ? ("Approve") : ("Not Approve"); ?></td>
            </tr>
          </table></td>
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