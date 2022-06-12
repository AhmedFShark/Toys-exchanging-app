<?php require_once("../Masters/includes/session.php") ?>
<?php require_once("../Masters/includes/functions.php") ?>

<?php 
	$_SESSION["os_user_id"] = null;
	$_SESSION["os_username"] = null;
	redirect_to("login.php");
?>