<?php

	require_once("../includes/session.php");
	require_once("../includes/connection.php");

	function mysql_prep( $value )
	{
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0

		if( $new_enough_php )
		{ // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active )
			{
				$value = stripslashes( $value );
			}
			$value = mysql_real_escape_string( $value );
		}
		else
		{ // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active )
			{
				$value = addslashes( $value );
			}
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}

	function confirm_query($result_set)
	{
		global $connection;
		if (!$result_set)
		{
			die("Database query failed: " . mysqli_error($connection));
		}
	}

	function get_toy_id($toymodel)
	{
		global $connection;

		$myquery = "SELECT p_ID FROM toy WHERE p_model = '{$toymodel}' LIMIT 1";

		$result = mysqli_query($connection, $myquery);

		confirm_query($result);

		if ($res = mysqli_fetch_assoc($result))
		{ return $res['p_ID']; }
		else
		{ return 0; }
	}

	$toymodel = $_POST["toymodel"];

	if(isset($_FILES['userfile']))
	{
		$toyid = get_toy_id($toymodel);
		$targeturl = "../Masters/uploads/photos/" . $toyid . ".jpg";

		if(move_uploaded_file($_FILES["userfile"]['tmp_name'], "../uploads/photos/" . $toyid . ".jpg"))
		{
			$query = "UPDATE toy SET p_photo = '{$targeturl}' WHERE p_ID = {$toyid}";

		    mysqli_query($connection, $query);
		}
	}

?>