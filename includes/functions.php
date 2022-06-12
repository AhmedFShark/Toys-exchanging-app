<?php
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

	function redirect_to( $location = NULL )
	{
		if ($location != NULL)
		{
			header("Location: {$location}");
			exit;
		}
	}

	function confirm_query($result_set)
	{
		global $connection;
		if (!$result_set)
		{
			die("Database query failed: " . mysqli_error($connection));
		}
	}

	//============================================================================================

	global $tab_num;

	function get_toys() {
		global $connection;

		$query = "SELECT * FROM toys INNER JOIN users ON u_ID = t_fk_user_id;";

		$result_set = mysqli_query($connection, $query);
		confirm_query($result_set);

		return $result_set;
	}

	function checkIfNoImage($img) {
		if($img == '')
			return './images/noimage.png';
		else
			return $img;
	}


	//=================================================================================

	function logged_in() { return isset($_SESSION['user_id']); }

	function confirm_logged_in() { if (!logged_in()) { redirect_to("login.php"); } }

	function confirmed_logged_in() { if (logged_in()) { redirect_to("index.php"); } }

	//*********************************************************************************
?>
