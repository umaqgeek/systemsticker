<?php require_once('Connections/systemsticker_conn.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO pengguna (pe_username, pe_password, pe_fullname, pe_email, pe_idno, pe_jawatan, pe_alamat, pe_tarikhlahir, pe_telefon, jp_id, ba_id, ja_id, ut_id, pe_regdate, pe_status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['pe_username'], "text"),
                       GetSQLValueString($_POST['pe_password'], "text"),
                       GetSQLValueString($_POST['pe_fullname'], "text"),
                       GetSQLValueString($_POST['pe_email'], "text"),
                       GetSQLValueString($_POST['pe_idno'], "text"),
                       GetSQLValueString($_POST['pe_jawatan'], "text"),
                       GetSQLValueString($_POST['pe_alamat'], "text"),
                       GetSQLValueString($_POST['pe_tarikhlahir'], "date"),
                       GetSQLValueString($_POST['pe_telefon'], "text"),
                       GetSQLValueString($_POST['jp_id'], "int"),
                       GetSQLValueString($_POST['ba_id'], "int"),
                       GetSQLValueString($_POST['ja_id'], "int"),
                       GetSQLValueString($_POST['ut_id'], "int"),
                       GetSQLValueString($_POST['pe_regdate'], "date"),
                       GetSQLValueString($_POST['pe_status'], "int"));

  mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
  $Result1 = mysql_query($insertSQL, $systemsticker_conn) or die("<script>location.href='register.php?error=3';</script>");

  $insertGoTo = "register.php?success=1";
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
$query_jp = "SELECT * FROM jenis_pengguna";
$jp = mysql_query($query_jp, $systemsticker_conn) or die(mysql_error());
$row_jp = mysql_fetch_assoc($jp);
$totalRows_jp = mysql_num_rows($jp);

mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
$query_ba = "SELECT * FROM bangsa";
$ba = mysql_query($query_ba, $systemsticker_conn) or die(mysql_error());
$row_ba = mysql_fetch_assoc($ba);
$totalRows_ba = mysql_num_rows($ba);

mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
$query_ja = "SELECT * FROM jantina";
$ja = mysql_query($query_ja, $systemsticker_conn) or die(mysql_error());
$row_ja = mysql_fetch_assoc($ja);
$totalRows_ja = mysql_num_rows($ja);

mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
$query_ut = "SELECT * FROM unit_tentera";
$ut = mysql_query($query_ut, $systemsticker_conn) or die(mysql_error());
$row_ut = mysql_fetch_assoc($ut);
$totalRows_ut = mysql_num_rows($ut);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
/*if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}*/

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "applySticker.php";
  $MM_redirectLoginSuccessAdmin = "viewAdminStickers.php";
  $MM_redirectLoginFailed = "index.php?error=1";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_systemsticker_conn, $systemsticker_conn);
  
  $LoginRS__query=sprintf("SELECT pe_username, pe_password FROM pengguna WHERE pe_username=%s AND pe_password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $systemsticker_conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else if ($loginUsername == "admin" && $password == "qwerty") {
	  
	  //declare two session variables and assign them
		$_SESSION['MM_Username'] = $loginUsername;
		$_SESSION['MM_UserGroup'] = $loginStrGroup;	      
	
		if (isset($_SESSION['PrevUrl']) && true) {
		  $MM_redirectLoginSuccessAdmin = $_SESSION['PrevUrl'];	
		}
	  
	  header("Location: ". $MM_redirectLoginSuccessAdmin);
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<style>
a:link  
{  
 text-decoration:none;  
} 
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td align="center" valign="top">
    <h1><a href="index.php">Sticker Management System</a></h1>
      <hr />
      </td>
  </tr>
  <tr>
    <td height="450" align="center" valign="top"><h3>Registration
    </h3>
      <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
        <table align="center">
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>Username</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><input type="text" name="pe_username" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>Password</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><input type="password" name="pe_password" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>Full Name</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><input type="text" name="pe_fullname" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>Email</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><input type="text" name="pe_email" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>National ID / IC / Passport</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><input type="text" name="pe_idno" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>Rank / Resignation</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><input type="text" name="pe_jawatan" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="left" valign="top">Address</td>
            <td nowrap align="left" valign="top">:</td>
            <td align="left" valign="top"><textarea name="pe_alamat" cols="50" rows="5"></textarea></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>Birth Date</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><input type="date" name="pe_tarikhlahir" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>Phone No.</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><input type="text" name="pe_telefon" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>User Type</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><select name="jp_id">
              <?php 
do {  
?>
              <option value="<?php echo $row_jp['jp_id']?>" ><?php echo $row_jp['jp_desc']?></option>
              <?php
} while ($row_jp = mysql_fetch_assoc($jp));
?>
            </select></td>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>Race</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><select name="ba_id">
                <?php 
do {  
?>
                <option value="<?php echo $row_ba['ba_id']?>" ><?php echo $row_ba['ba_desc']?></option>
                <?php
} while ($row_ba = mysql_fetch_assoc($ba));
?>
            </select></td>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>Gender</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><select name="ja_id">
                <?php 
do {  
?>
                <option value="<?php echo $row_ja['ja_id']?>" ><?php echo $row_ja['ja_desc']?></option>
                <?php
} while ($row_ja = mysql_fetch_assoc($ja));
?>
            </select></td>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>Military Unit</td>
            <td align="left" valign="top" nowrap>:</td>
            <td align="left" valign="top"><select name="ut_id">
                <?php 
do {  
?>
                <option value="<?php echo $row_ut['ut_id']?>" ><?php echo $row_ut['ut_desc']?></option>
                <?php
} while ($row_ut = mysql_fetch_assoc($ut));
?>
            </select></td>
          <tr valign="baseline">
            <td align="left" valign="top" nowrap>&nbsp;</td>
            <td align="left" valign="top" nowrap>&nbsp;</td>
            <td align="left" valign="top"><input type="submit" value="Register"></td>
          </tr>
          <tr valign="baseline">
            <td colspan="3" align="left" valign="top" nowrap>
            <?php
			if (isset($_GET['error'])) {
				echo "<span style=\"color:#F00\"><em>";
				$er = $_GET['error'];
				if ($er == 3) {
					echo "Registration failed!";
				}
				echo "</em></span>";
			}
			if (isset($_GET['success'])) {
				echo "<span style=\"color:#0F0\"><em>";
				$er = $_GET['success'];
				if ($er == 1) {
					echo "Registration success ...";
				}
				echo "</em></span>";
			}
			?>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="pe_regdate" value="<?php echo date('Y-m-d H:i:s'); ?>">
        <input type="hidden" name="pe_status" value="1">
        <input type="hidden" name="MM_insert" value="form2">
      </form>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td align="center" valign="top"><hr />
      <h3><br>
    Alright Reserved</h3></td>
  </tr>
</table>
<?php
mysql_free_result($jp);

mysql_free_result($ba);

mysql_free_result($ja);

mysql_free_result($ut);
?>
