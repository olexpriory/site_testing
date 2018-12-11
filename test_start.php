<?php

    session_start();

    if(!isset($_SESSION["session_username"])):
    header("location:log_in.php");
    else:
?>
	
<?php// include("includes/header.php"); ?>

<div id="welcome">
  <h2 align="right">Доброго дня, <span><?php echo $_SESSION['session_username'];?>! </span></h2>
  <p align="right"><a href="logout.php">Вийти</a> з системи </p>
</div>
	
<?php include("test_active.php"); ?>
	
<?php endif; ?>