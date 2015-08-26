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
  $Result1 = mysql_query($insertSQL, $systemsticker_conn) or die("<script>location.href='index.php?error=3';</script>");

  $insertGoTo = "index.php?success=1";
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
    <td align="center" valign="top"><h1><a href="index.php">Sticker Management System</a><br><hr />
    </h1></td>
  </tr>
  <tr>
    <td height="450" align="center" valign="top"><h3>Log In</h3>
      <form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
        <table border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td>Username</td>
            <td>:</td>
            <td><label>
              <input type="text" name="username" id="username">
            </label></td>
          </tr>
          <tr>
            <td>Password</td>
            <td>:</td>
            <td><label>
              <input type="password" name="password" id="password">
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type="submit" name="button" id="button" value="Log In">
              <a href="register.php">
              <input type="button" name="button2" id="button2" value="Registration" />
              </a>            </label></td>
          </tr>
          <tr>
            <td colspan="3"><span style="color:#F00"><em>
            <?php
			if ( isset($_GET['error']) ) {
				$er = $_GET['error'];
				if ($er == 1) {
					echo "Invalid username / password!";
				}
				if ($er == 2) {
					echo "Access Denied!";
				}
			} else if ( isset($_GET['accesscheck']) ) {
				if (isset($_GET['accesscheck'])) {
					echo "Access Denied!";
				}
			}
			?></em></span>
            &nbsp;</td>
          </tr>
        </table>
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
