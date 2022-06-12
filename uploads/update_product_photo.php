<?php
	require_once("../includes/session.php");
	$toyID = $_POST["toyID"];

	if(isset($_FILES['userfile']))
	{
		$targeturl = "../uploads/photos/" . $toyID . ".jpg";
		move_uploaded_file($_FILES["userfile"]['tmp_name'], $targeturl);
	}
?>