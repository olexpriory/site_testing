<?php

    session_start();

    if(!isset($_SESSION["session_username"])):
    header("location:log_in.php");
    else:
?>
	
<?php// include("includes/header.php"); ?>

<div id="welcome">
<h2>Добро пожаловать, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
  <p><a href="logout.php">Выйти</a> из системы</p>
</div>
	
<?php include("test_active.php"); ?>
	
<?php endif; ?>