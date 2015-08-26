<!-- InstanceBegin template="/Templates/pageUser.dwt.php" codeOutsideHTMLIsLocked="false" --><?php require_once('Connections/systemsticker_conn.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];
?>
<?php
$maxRows_pe = 10;
$pageNum_pe = 0;
if (isset($_GET['pageNum_pe'])) {
  $pageNum_pe = $_GET['pageNum_pe'];
}
$startRow_pe = $pageNum_pe * $maxRows_pe;

$colname_pe = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_pe = $_SESSION['MM_Username'];
}
mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
$query_pe = sprintf("SELECT * FROM pelekat pel, pengguna pe, jenis_kenderaan jk, model_kenderaan mk WHERE pel.pe_id = pe.pe_id  AND pel.jk_id = jk.jk_id  AND pel.mk_id = mk.mk_id  AND pe.pe_username = %s", GetSQLValueString($colname_pe, "text"));
$query_limit_pe = sprintf("%s LIMIT %d, %d", $query_pe, $startRow_pe, $maxRows_pe);
$pe = mysql_query($query_limit_pe, $systemsticker_conn) or die(mysql_error());
$row_pe = mysql_fetch_assoc($pe);

if (isset($_GET['totalRows_pe'])) {
  $totalRows_pe = $_GET['totalRows_pe'];
} else {
  $all_pe = mysql_query($query_pe);
  $totalRows_pe = mysql_num_rows($all_pe);
}
$totalPages_pe = ceil($totalRows_pe/$maxRows_pe)-1;

$queryString_pe = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_pe") == false && 
        stristr($param, "totalRows_pe") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_pe = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_pe = sprintf("&totalRows_pe=%d%s", $totalRows_pe, $queryString_pe);
?>
<!-- InstanceEndEditable -->
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td align="center" valign="top"><h1>Sticker Management System<br><hr />
    </h1></td>
  </tr>
  <tr>
    <td align="center" valign="top"><a href="applySticker.php">Apply Sticker</a> | <a href="viewStickers.php">View Stickers Application</a> | <a onclick="return confirm('Are you sure want to logout?');" href="<?php echo $logoutAction ?>">Log Out</a></td>
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
            <td>Status Approval</td>
            <td>Action</td>
          </tr>
          <?php if ($totalRows_pe > 0) { ?>
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
              <td><?php echo ($row_pe['pel_status'] == 1) ? ("Not Approve") : ("Approve"); ?></td>
              <td><a onclick="return confirm('Are you sure?');" href="deleteSticker.php?id=<?php echo $row_pe['pel_id']; ?>">Delete</a></td>
            </tr>
            <?php } while ($row_pe = mysql_fetch_assoc($pe)); ?>
          <?php } else { ?>
          <tr>
            <td colspan="14"><em>... No data ...</em></td>
          </tr>
          <?php } ?>
        </table>
        <br />
        <table border="0">
          <tr>
            <td><?php if ($pageNum_pe > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_pe=%d%s", $currentPage, 0, $queryString_pe); ?>">First</a>
                <?php } // Show if not first page ?></td>
            <td><?php if ($pageNum_pe > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_pe=%d%s", $currentPage, max(0, $pageNum_pe - 1), $queryString_pe); ?>">Previous</a>
                <?php } // Show if not first page ?></td>
            <td><?php if ($pageNum_pe < $totalPages_pe) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_pe=%d%s", $currentPage, min($totalPages_pe, $pageNum_pe + 1), $queryString_pe); ?>">Next</a>
                <?php } // Show if not last page ?></td>
            <td><?php if ($pageNum_pe < $totalPages_pe) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_pe=%d%s", $currentPage, $totalPages_pe, $queryString_pe); ?>">Last</a>
                <?php } // Show if not last page ?></td>
          </tr>
        </table>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td align="center" valign="top"><hr />
      <h3><br>
    Alright Reserved</h3></td>
  </tr>
</table>
<!-- InstanceEnd -->