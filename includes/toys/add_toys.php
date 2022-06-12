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

	function toy_exist($mtxt)
	{
		global $connection;

		$myquery = "SELECT p_sn FROM toy WHERE p_sn = " . $mtxt . " LIMIT 1";

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

	if(!toy_exist($asn))
	{
		$query = "INSERT INTO toy
		        (
		        	p_sn, p_model, p_display_size, p_display_resolution, p_display_type, p_ram, p_cpu, p_generation, p_gpu_type, p_gpu_size, p_hd_slot1, p_hd_slot2, p_optical_drive, p_hdmi, p_vga, p_card_reader, p_ethernet_lan, p_audio_jack, p_fingerprint, p_camera, p_lit_keyboard, p_in_stock, p_wholesale_selling_price, p_singular_selling_price, p_final_singular_selling_price, p_description
		        )
		        VALUES
		        (

					{$asn},'{$amodel}',{$adsize},'{$adres}','{$adtype}','{$aram}GB','i{$acpu}',{$agen},'{$agput}','{$agpus}GB','{$ahd1}','{$ahd2}','{$aod}','{$ahdmi}','{$avga}','{$acreader}','{$aelan}','{$ajack}','{$afprint}','{$acam}','{$alitkey}',{$aistock},{$awprice},{$asprice},{$afsprice},'{$ades}'
		        )";

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