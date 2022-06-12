<?php

	require_once("connection.php");
	// require_once("grobot.php");

	// $secret = "6LfNGzAUAAAAAE0WXeUTgOTtFLCJqHldaNcMCWCS";

	// $response = null;

	// $reCaptcha = new ReCaptcha($secret);

	// if (isset($_REQUEST['robottxt']))
	// {
 //    		$response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_REQUEST['robottxt']);
	// }

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

	if(isset($_REQUEST['usertxt']) && isset($_REQUEST['passtxt']))
	{
		// if ($response != null && $response->success)
		// {
			$username = trim(mysql_prep($_REQUEST['usertxt']));
			$password = trim(mysql_prep($_REQUEST['passtxt']));
			//$hashed_password = sha1($password);

			//$query = "(SELECT a_ID AS uID, a_username AS uUN FROM admins WHERE a_username = '{$username}' AND a_password = '{$password}') UNION (SELECT c_ID AS uID, c_username AS uUN FROM customer WHERE c_username = '{$username}' AND c_password = '{$password}') LIMIT 1;";

			$query = "SELECT u_ID AS uID, u_username AS uUN FROM users WHERE u_username = '{$username}' AND u_password = '{$password}' LIMIT 1;";

			$result_set = mysqli_query($connection, $query);
			confirm_query($result_set);

			if (mysqli_affected_rows($connection) == 1)
			{
				$found_user = mysqli_fetch_assoc($result_set);

				session_start();

				$_SESSION['user_id'] = $found_user['uID'];
				$_SESSION['username'] = $found_user['uUN'];
				//$_SESSION['photo'] = $found_user['uPH'];

				echo json_encode(array('status' => 'OK'));
			}
			else
			{
				echo json_encode(array('status' => 'Wrong username or password!'));
			}
		// }
		// else
		// {
		// 	echo json_encode(array('status' => 'ERROR'));
		// }
	}
?>
