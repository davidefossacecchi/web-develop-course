<?php
	require "vendor/autoload.php";
	require "credential.php";

	session_start();

	use Abraham\TwitterOAuth\TwitterOAuth;

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, TOKEN_SECRET);
	$content = $connection->get("account/verify_credentials");
	$statuses = $connection->get("statuses/home_timeline", array("count" => 25, "exclude_replies" => true));

	foreach($statuses as $status){
		echo "<p>".$status->text."</p>";
	}

?>