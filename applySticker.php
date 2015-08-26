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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	// document license
	$img1 = "";
	$uploads_dir = 'assets/uploads';
	$pel1 = $_FILES["pel_lesenimage"];
	if ($pel1["error"] == 0) {
		$tmp_name = $pel1["tmp_name"];
		$name = $pel1["name"];
		if (move_uploaded_file($tmp_name, $uploads_dir."/".$name)) {
			$img1 = $name;
		} else {
			die("<script>location.href='applySticker.php?error=1';</script>");
		}
	}
	
	// document roadtax
	$img2 = "";
	$uploads_dir = 'assets/uploads';
	$pel2 = $_FILES["pel_roadtaximage"];
	if ($pel2["error"] == 0) {
		$tmp_name = $pel2["tmp_name"];
		$name = $pel2["name"];
		if (move_uploaded_file($tmp_name, $uploads_dir."/".$name)) {
			$img2 = $name;
		} else {
			die("<script>location.href='applySticker.php?error=1';</script>");
		}
	}
	
	$sql = sprintf("SELECT * FROM pelekat WHERE pe_id = %s AND jk_id = %s ", 
				   GetSQLValueString($_POST['pe_id'], "int"),
				   GetSQLValueString($_POST['jk_id'], "int"));
	$r1 = mysql_query($sql) or die("<script>location.href='applySticker.php?error=1';</script>");
	$t1 = mysql_num_rows($r1);
	if ($t1 > 0) {
		die("<script>location.href='applySticker.php?error=2&sql=".$sql."';</script>");
	}
	
  $insertSQL = sprintf("INSERT INTO pelekat (pe_id, jk_id, pel_regdate, pel_expireddate, pel_noplat, mk_id, pel_nolesen, pel_lesentamat, pel_lesenimage, pel_noroadtax, pel_roadtaxtamat, pel_roadtaximage, pel_status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['pe_id'], "int"),
                       GetSQLValueString($_POST['jk_id'], "int"),
                       GetSQLValueString($_POST['pel_regdate'], "date"),
                       GetSQLValueString(date("Y-m-d H:i:s"), "date"),
                       GetSQLValueString($_POST['pel_noplat'], "text"),
                       GetSQLValueString($_POST['mk_id'], "int"),
                       GetSQLValueString($_POST['pel_nolesen'], "text"),
                       GetSQLValueString($_POST['pel_lesentamat'], "date"),
                       GetSQLValueString($img1, "text"),
                       GetSQLValueString($_POST['pel_noroadtax'], "text"),
                       GetSQLValueString($_POST['pel_roadtaxtamat'], "date"),
                       GetSQLValueString($img2, "text"),
					   GetSQLValueString($_POST['pel_status'], "int"));

  mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
  $Result1 = mysql_query($insertSQL, $systemsticker_conn) or die("<script>location.href='applySticker.php?error=1';</script>");

  $insertGoTo = "viewStickers.php";
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php
$colname_pe = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_pe = $_SESSION['MM_Username'];
}
mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
$query_pe = sprintf("SELECT * FROM pengguna WHERE pe_username = %s", GetSQLValueString($colname_pe, "text"));
$pe = mysql_query($query_pe, $systemsticker_conn) or die(mysql_error());
$row_pe = mysql_fetch_assoc($pe);
$totalRows_pe = mysql_num_rows($pe);

mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
$query_jk = "SELECT * FROM jenis_kenderaan";
$jk = mysql_query($query_jk, $systemsticker_conn) or die(mysql_error());
$row_jk = mysql_fetch_assoc($jk);
$totalRows_jk = mysql_num_rows($jk);

mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
$query_mk = "SELECT * FROM model_kenderaan";
$mk = mysql_query($query_mk, $systemsticker_conn) or die(mysql_error());
$row_mk = mysql_fetch_assoc($mk);
$totalRows_mk = mysql_num_rows($mk);
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
    <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap">Vehicle Type</td>
          <td align="left" valign="top" nowrap="nowrap">:</td>
          <td align="left" valign="top"><select name="jk_id">
            <?php 
do {  
?>
            <option value="<?php echo $row_jk['jk_id']?>" ><?php echo $row_jk['jk_desc']?></option>
            <?php
} while ($row_jk = mysql_fetch_assoc($jk));
?>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap">Vehicle Registration No.</td>
          <td align="left" valign="top" nowrap="nowrap">:</td>
          <td align="left" valign="top"><input type="text" name="pel_noplat" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap">Vehicle Model</td>
          <td align="left" valign="top" nowrap="nowrap">:</td>
          <td align="left" valign="top"><select name="mk_id">
            <?php 
do {  
?>
            <option value="<?php echo $row_mk['mk_id']?>" ><?php echo $row_mk['mk_desc']?></option>
            <?php
} while ($row_mk = mysql_fetch_assoc($mk));
?>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap">License No.</td>
          <td align="left" valign="top" nowrap="nowrap">:</td>
          <td align="left" valign="top"><input type="text" name="pel_nolesen" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap">License Expired Date</td>
          <td align="left" valign="top" nowrap="nowrap">:</td>
          <td align="left" valign="top"><input type="date" name="pel_lesentamat" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap">License Support Document</td>
          <td align="left" valign="top" nowrap="nowrap">:</td>
          <td align="left" valign="top"><label>
            <input type="file" name="pel_lesenimage" id="pel_lesenimage" />
          </label></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap">Roadtax No.</td>
          <td align="left" valign="top" nowrap="nowrap">:</td>
          <td align="left" valign="top"><input type="text" name="pel_noroadtax" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap">Roadtax Expired Date</td>
          <td align="left" valign="top" nowrap="nowrap">:</td>
          <td align="left" valign="top"><input type="date" name="pel_roadtaxtamat" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap">Roadtax Support Document</td>
          <td align="left" valign="top" nowrap="nowrap">:</td>
          <td align="left" valign="top"><label>
            <input type="file" name="pel_roadtaximage" id="pel_roadtaximage" />
          </label></td>
        </tr>
        <tr valign="baseline">
          <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
          <td align="left" valign="top" nowrap="nowrap">&nbsp;</td>
          <td align="left" valign="top"><input type="submit" value="Apply" /></td>
        </tr>
        <tr valign="baseline">
          <td colspan="3" align="left" valign="top" nowrap="nowrap"><?php
			if (isset($_GET['error'])) {
				echo "<span style=\"color:#F00\"><em>";
				$er = $_GET['error'];
				if ($er == 1) {
					echo "Apply failed!";
				}
				if ($er == 2) {
					echo "You already apply for that vehicle type!";
				}
				echo "</em></span>";
			}
			?>&nbsp;</td>
          </tr>
      </table>
      <input type="hidden" name="pe_id" value="<?php echo $row_pe['pe_id']; ?>" />
      <input type="hidden" name="pel_regdate" value="<?php echo date('Y-m-d H:i:s'); ?>" />
      <input type="hidden" name="pel_status" value="1" />
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
    
    <?php
    $pe_id = $row_pe['pe_id'];
    $sql = sprintf("SELECT * FROM pelekat WHERE pe_id = '%s' AND pel_status = 2 ", $pe_id);
    $record1 = mysql_query($sql) or die(mysql_error());
    $total1 = mysql_num_rows($record1);
    if ($total1 > 0) {
        $sql = sprintf("UPDATE pelekat SET pel_status = 3 WHERE pe_id = '%s' ", $pe_id);
        mysql_query($sql) or die(mysql_error());
        echo "<script>alert('Your application has been approved!');location.href='viewStickers.php';</script>";
    }
    ?>
    
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td align="center" valign="top"><hr />
      <h3><br>
    Alright Reserved</h3></td>
  </tr>
</table>
<!-- InstanceEnd -->