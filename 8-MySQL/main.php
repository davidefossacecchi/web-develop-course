<?php
	$message["data"]="some data";
	if ($_POST["process"] == "login") $message["result"]="GRANTED";
	if ($_POST["process"] == "save") $message["result"]="SAVED";
	echo json_encode($message);
?>