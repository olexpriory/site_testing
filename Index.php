<?php
        session_start();
       require ('conection_db.php');

       // fgdhjf

       if(isset($_POST['user_surname']) && isset($_POST['user_name']) ){

        $usersurname    = $_POST['user_surname'];
        $username       = $_POST['user_name'];

        $query = "SELECT * FROM `users` WHERE usersurname ='$usersurname' and username = '$username'";  // создание запроса на существования пользователя 

        if(isset($_POST['user_lastname']){
            // $query = "SELECT * FROM `users` WHERE usersurname ='$usersurname' and username = '$username'";
        }
           
        if(isset($_POST['user_rung']){
            //$query = "SELECT * FROM `users` WHERE usersurname ='$usersurname' and username = '$username'";
        }
            
        if(isset($_POST['subdivision_company'] && $_POST['subdivision_platoon']  && $_POST['subdivision_specialty']){
             //$query = "SELECT * FROM `users` WHERE usersurname ='$usersurname' and username = '$username'";
        }
           

       


        $result = mysqli_query($conection, $query) or die(mysqli_error($conection)); // выпольнение запроса или выход?
        $count = mysqli_num_rows($result); // количество рядков в ответе


        if($count == 0){
            $fmsg = "Вас не має в системі. Зареэструйтесь будь-ласка!";    
            include ('log_in_full.php');
            return;
        }elseif ($count == 1){
            $fmsg = "Ви один в системі!";
            $_SESSION['session_username']=$username;
            header("Location: test_start.php"); 
            //include ('test_start.php'); 
           // return;       
        }else{
            $fmsg = "Введіть додаткові дані!";



        }


       }


        include ('log_in.php'); //подключаем файл с 

    ?> 