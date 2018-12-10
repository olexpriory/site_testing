<?php
	session_start();
	unset($_SESSION['session_username']);
	session_destroy();
	header("location:log_in.php");
	?>