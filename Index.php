<?php
        session_start();
       require ('conection_db.php');

       // fgdhjf

       if(isset($_POST['user_surname']) && isset($_POST['user_name']) ){

        $usersurname    = $_POST['user_surname'];
        $username       = $_POST['user_name'];

        $query = "SELECT * FROM `users` WHERE usersurname ='$usersurname' and username = '$username'";  // создание запроса на существования пользователя  
        $result = mysqli_query($conection, $query) or die(mysqli_error($conection)); // выпольнение запроса или выход?
        $count = mysqli_num_rows($result); // количество рядков в ответе


        /*
        echo "<br><br>usersurname = $usersurname <br> username = $username <br><br>";
        echo "qvery = $query <br>";
        echo "count = $count <br>";

        date_default_timezone_set('Europe/Kiev');
        $date = date('Y-m-d H:i:s', time());
        echo "date = [$date]"; 
        */

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
            $fmsg = "Ви не один в системі!";
        }


       }


        include ('log_in.php'); //подключаем файл с 

    ?> 