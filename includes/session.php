<?php

	ob_start();

	if (!isset($_SESSION))
	{
		//header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0'); // always works
		//session_cache_limiter('private_no_expire'); // works
		//session_cache_limiter('none'); // works too
		session_start();
	}

?>
