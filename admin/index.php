<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<?php
    session_start();


        if(isset($_SESSION['user_msg'])){
            $user_msg = $_SESSION['user_msg'];
            $_SESSION['user_msg'] = null;
        }

        if(isset($_SESSION['user_err'])){
            $user_err = $_SESSION['user_err'];
            $_SESSION['user_err'] = null;
        }
    
?>

<br>


<!--=========================== user mesage ============================-->
 <?php if(isset($user_msg)){ ?><div class="alert alert-success" role="alert"> <?php echo $user_msg; ?> </div><?php } ?>
 <?php if(isset( $user_err)){ ?><div class="alert alert-danger" role="alert"> <?php echo  $user_err; ?> </div><?php } ?>
 <!--===================================================================-->


 <div class="container">
    <form action="create_new_test.php" method="POST">
        <button class="btn btn-lg btn-primary btn-block" name="CreateNewTest" type="submit">Створити новий тест</button>
    </form>
</div>



<div class="container" style= " margin-top:10px;">
    <form action="show_group.php" method="POST">
        <button class="btn btn-lg btn-primary btn-block" name="group" type="submit">Підрозділи</button>
    </form>
</div>

<div class="container" style= " margin-top:10px;">
    <form action="show_results.php" method="POST">
        <button class="btn btn-lg btn-primary btn-block" name="result_schow" type="submit">Результати</button>
    </form>
</div>


<br><br>

<?php  require ('show_test.php');?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>