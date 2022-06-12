<?php
	$toyID = $_POST["toyID"];

	if(isset($toyID))
	{
		$fp = "../uploads/photos/".$toyID.".jpg";
    	fclose($fp);
    	unlink($fp);
	}
?>