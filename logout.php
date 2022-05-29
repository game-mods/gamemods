<?php

// core functions
include_once "core.php";

// check if user is online
if(ONLINE)
{
	// destroy current user session
	session_destroy();
	$_SESSION = array();
}

// redirect to homepage
header("Location: ".SITE_URL."home"); exit;
?>
