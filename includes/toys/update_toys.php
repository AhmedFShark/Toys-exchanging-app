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

	function class_exist($toyID)
	{
		global $connection;

		$myquery = "SELECT p_ID FROM toy WHERE p_ID = " . $toyID . " LIMIT 1";

		$result = mysqli_query($connection, $myquery);

		confirm_query($result);

		if ($res = mysqli_fetch_assoc($result))
			{ return true; }
		else
			{ return false; }
	}

	function get_cb_status($checkbox){
		if($checkbox == "true")
			{ return "Yes"; }
		else
			{ return "No"; }
	}
	
	function check_res($res){
		if (strpos($res, 'x') !== false) {
		    $regex = '/(\d+)(x)(\d+)/';
			$res = preg_replace($regex, '$1 $2 $3', $res);
			return $res;
		}
		else
			return $res;
	}

	$toyID = $_REQUEST["toyID"];
	$asn = trim((int) $_REQUEST["asntxt"]);
    $amodel = trim(mysql_prep($_REQUEST["amodeltxt"]));
    $adsize = trim((double) $_REQUEST["adsizetxt"]);
    $adres = check_res(mysql_prep($_REQUEST["adrestxt"]));
    $adtype = trim(mysql_prep($_REQUEST["adtypesel"]));
    $aram = trim(mysql_prep($_REQUEST["aramtxt"]));
    $acpu = trim(mysql_prep($_REQUEST["acputxt"]));
    $agen = trim((int) $_REQUEST["agentxt"]);
    $agput = trim(mysql_prep($_REQUEST["agputtxt"]));
    $agpus = trim(mysql_prep($_REQUEST["agpustxt"]));
    $ahd1 = trim(mysql_prep($_REQUEST["ahd1txt"])) . trim(mysql_prep($_REQUEST["ahd1ssel"]));
    $ahd2 = trim(mysql_prep($_REQUEST["ahd2txt"])) . trim(mysql_prep($_REQUEST["ahd2ssel"]));
    $aod = get_cb_status(mysql_prep($_REQUEST["aodcb"]));
    $ahdmi = get_cb_status(mysql_prep($_REQUEST["ahdmicb"]));
    $avga = get_cb_status(mysql_prep($_REQUEST["avgacb"]));
    $acreader = get_cb_status(mysql_prep($_REQUEST["acreadercb"]));
    $aelan = get_cb_status(mysql_prep($_REQUEST["aelancb"]));
    $ajack = get_cb_status(mysql_prep($_REQUEST["ajackcb"]));
    $afprint = get_cb_status(mysql_prep($_REQUEST["afprintcb"]));
    $acam = get_cb_status(mysql_prep($_REQUEST["acamcb"]));
    $alitkey = get_cb_status(mysql_prep($_REQUEST["alitkeycb"]));
    $aistock = trim((int) $_REQUEST["aistocktxt"]);
    $awprice = trim((int) $_REQUEST["awpricetxt"]);
    $asprice = trim((int) $_REQUEST["aspricetxt"]);
    $afsprice = trim((int) $_REQUEST["afspricetxt"]);
    $ades = trim(mysql_prep($_REQUEST["adestxt"]));

	if(class_exist($toyID))
	{
		$query = "UPDATE toy SET
		        	p_sn = {$asn},
					p_model = '{$amodel}',
					p_display_size = {$adsize},
					p_display_resolution = '{$adres}',
					p_display_type = '{$adtype}',
					p_ram = '{$aram}GB',
					p_cpu = 'i{$acpu}',
					p_generation = {$agen},
					p_gpu_type = '{$agput}',
					p_gpu_size = '{$agpus}GB',
					p_hd_slot1 = '{$ahd1}',
					p_hd_slot2 = '{$ahd2}',
					p_optical_drive = '{$aod}',
					p_hdmi = '{$ahdmi}',
					p_vga = '{$avga}',
					p_card_reader = '{$acreader}',
					p_ethernet_lan = '{$aelan}',
					p_audio_jack = '{$ajack}',
					p_fingerprint = '{$afprint}',
					p_camera = '{$acam}',
					p_lit_keyboard = '{$alitkey}',
					p_in_stock = {$aistock},
					p_wholesale_selling_price = {$awprice},
					p_singular_selling_price = {$asprice},
					p_final_singular_selling_price = {$afsprice},
					p_description = '{$ades}'
		        	WHERE p_ID = {$toyID}
		        ";

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