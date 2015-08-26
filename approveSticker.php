<?php require_once('Connections/systemsticker_conn.php'); ?>
<?php

if (isset($_GET['id']) && isset($_GET['pel_status'])) {
	
	$pel_id = $_GET['id'];
	$pel_status = ($_GET['pel_status'] == 1) ? (2) : (1);
	$sql = sprintf("UPDATE pelekat SET pel_status = '%s' WHERE pel_id = '%s' ", $pel_status, $pel_id);
	mysql_query($sql) or die("<script>alert('Fail to approval!');location.href='viewAdminStickers.php';</script>");
	
}

header("Location: viewAdminStickers.php");
die();

?>