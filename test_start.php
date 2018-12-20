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
    require ('conection_db.php');

    if(!isset($_SESSION["user_id"]))
    {
        echo "<h1>Помилка ідентифікації</h1>";
        require ('log_in.php');
    }

    $id_user = $_SESSION["user_id"];

    $fio = "  ";
    $fio .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['usersurname'];
    $fio .= "  ";
    $username =  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['username'];
    $fio .=  $username;
    $fio .= "  ";
    $fio .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['userlastname'];
    $fio .= "  ";


    $rung_id = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['userrung_id'];
    $rung = "  ";
    $rung .= mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `user_rung` WHERE id_rung = '$rung_id' "))['rungname'];
    $rung .= "  ";
    
    $id_comp =  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['company_id'];                  
    $id_plat =  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['platoon_id'];                  
    $id_spec =  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['specialty_id'];

    $subdiv = "  Рота №: ";
    $subdiv .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `company` WHERE id_company = '$id_comp' "))['companynumber'];
    $subdiv .= "    звод №: ";
    $subdiv .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `platoon` WHERE id_platoon = '$id_plat' "))['platoonnumber'];
    $subdiv .= "    спеціальність: ";
    $subdiv .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `specialty` WHERE id_specialty = '$id_spec' "))['specialtyname'];
    $subdiv .= ".  ";
    
?>
	

    <div id="welcome" align="right" style="margin-right:10px; height:180px">

    <div style="margin-top:10px; display : inline;"> <h2 style="display : inline"   > Доброго дня,  <?php echo $username; ?> !</h2> </div> <a  href="logout.php" class="btn btn-lg btn-primary btn-block" style="display : inline; " > Вийти з системи </a>  
        
        <table cellpadding="5" border="2" style=" margin-top:20px;">
            <tr>
                <td><?php echo $fio; ?></td>
                <td><?php echo $rung; ?></td>
                <td><?php echo $subdiv; ?></td>
            </tr>
        </table>     
    </div>
	
<?php include("test_active.php"); ?>
	




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>