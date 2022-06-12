<?php

	require_once("../connection.php");

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

	function class_exist($useID, $ftxt)
	{
		global $connection;

		$myquery = "SELECT u_ID FROM users WHERE u_ID != " . $useID . " AND u_username LIKE '" . $ftxt . "' LIMIT 1";

		$result = mysqli_query($connection, $myquery);

		confirm_query($result);

		if ($res = mysqli_fetch_assoc($result))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	$userID = $_REQUEST["userID"];
	$acredential = trim(mysql_prep($_REQUEST["credentialtxt"]));
    $ausername = trim(mysql_prep($_REQUEST["usernametxt"]));

	if(!class_exist($userID, $ausername))
	{
		$query = "UPDATE users SET credential = '{$acredential}', u_username = '{$ausername}' WHERE u_ID = {$userID} ";

        if (mysqli_query($connection, $query))
        {
        	echo json_encode(array('status' => 'OK', 'message' => 'Data saved successfully!'));
        }
        else
        {
        	echo json_encode(array('status' => 'ERROR', 'message' => 'Please fix the errors!'));
        }
	}
	else
	{
		echo json_encode(array('status' => 'ERROR', 'message' => 'Data already exist!'));
	}
?>