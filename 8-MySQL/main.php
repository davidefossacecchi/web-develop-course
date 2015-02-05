<?php

	require('credentials.php');

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	if ($_POST["process"] == "login"){
		$email = $_POST["email"];
		$password = $_POST["password"];
		$query = "SELECT * FROM `diaries` WHERE `email` = '".$email."'";
		$r = mysqli_query($conn, $query);
		
		if (mysqli_num_rows($r) < 1){
			$salt = generateSalt(16);
			$encPSW = md5($salt.$_POST["password"]);
			$query = "INSERT INTO `diaries` (`email`,`password`, `salt`, `diary`) VALUES ('".$email."', '".$encPSW."', '".$salt."', '')";
			mysqli_query($conn, $query);
			session_start();
			$_SESSION["user"] = $email;
			$_SESSION["diary"] = "";
			$message["result"]="GRANTED";
			$message["diary"] = "";
		}
		else{
			$row = mysqli_fetch_array($r);
			$encPSW = md5($row["salt"].$_POST["password"]);
			if ($encPSW != $row["password"]) $message["result"]="LOGIN_ERROR";
			else{
				session_start();
				$_SESSION["user"] = $email;
				$_SESSION["diary"] = $row["diary"];
				$message["result"]="GRANTED";
				$message["diary"] = $row["diary"];
			}
		} 
	}
	if ($_POST["process"] == "save") {
		session_start();
		if($_POST["diary-content"] != $_SESSION["diary"]){
			$query = "UPDATE `diaries` SET `diary` = '".$_POST["diary-content"]."' WHERE `email` = '".$_SESSION["user"]."'";
			mysqli_query($conn, $query);
			if(mysqli_affected_rows($conn) < 1) $message["result"] = "LOGIN_ERROR";
			else $message["result"]="SAVED";
		}
		else $message["result"]="SAVED";
		session_destroy();
	}
	mysqli_close($conn);
	echo json_encode($message);

	function generateSalt($lenght){
		$salt = "";
		$chars = Array("a","b","c","d","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","w","y","x","z","A","B","C","D","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","W","Y","X","Z","1","2","3","4","5","6","7","8","9","0");
		$charsLength = count($chars);
		for ($i=0; $i<$lenght; $i++) $salt .= $chars[rand(0, $charsLength - 1)];
		return $salt;
	}
?>