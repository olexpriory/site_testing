<?php
        

        session_start();
        require ('conection_db.php');
      

      

       if(isset($_POST['user_surname']) && isset($_POST['user_name']) ){

        $usersurname    = $_POST['user_surname'];
        $username       = $_POST['user_name'];

        $query = "SELECT * FROM `users` WHERE usersurname ='$usersurname' and username = '$username'";  // создание запроса на существования пользователя 

        if(isset($_POST['user_lastname'])){
            $conterdata = 2;
            $userlastname = $_POST['user_lastname'];
            $query = "SELECT * FROM `users` WHERE usersurname ='$usersurname' and username = '$username' and userlastname = '$userlastname'";
        }
           
        if(isset($_POST['user_rung'])){
            $conterdata = 3;
            $userrung_id = $_POST['user_rung'];
            $query = "SELECT * FROM `users` WHERE usersurname ='$usersurname' and username = '$username' and userlastname = '$userlastname' and userrung_id = '$userrung_id'";
        }
            
        if( isset($_POST['subdivision_company']) 
            && isset($_POST['subdivision_platoon'])  
            && isset($_POST['subdivision_specialty'])
        ){
            $conterdata = 4;
            $company_id = $_POST['subdivision_company'];
            $platoon_id = $_POST['subdivision_platoon'];
            $specialty_id = $_POST['subdivision_specialty'];

              $query = "SELECT * FROM `users` WHERE usersurname ='$usersurname' and username = '$username' 
                                                                                and userlastname = '$userlastname'
                                                                                and userrung_id = '$userrung_id'
                                                                                and company_id ='$company_id'
                                                                                and platoon_id = '$platoon_id'
                                                                                and specialty_id = ' $specialty_id'
                                                                                ";
        }
           

       


        $result = mysqli_query($conection, $query) or die(mysqli_error($conection)); // выпольнение запроса или выход?
        $count = mysqli_num_rows($result); // количество рядков в ответе

      

        if($count == 0){
            $fmsg = "Вас не має в системі. Зареэструйтесь будь-ласка!";            
            include ('log_in_full.php');
            return;
        }elseif ($count == 1){
            $fmsg = "Ви один в системі!";
            $_SESSION['user_id'] = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE username = '$username' "))['id_user'];
            header("Location: test_start.php"); 
            //include ('test_start.php'); 
           // return;       
        }else{
            $fmsg = "Введіть додаткові дані!";
            if(! isset($conterdata))$conterdata = 1;

            if( isset($conterdata))
               if ($conterdata == 4)
                {
                    echo "<br><br><h3 style=\"color:red\"> В системі виявленно більше одого користувача з</h3>";
                    echo "<br><br><h3 style=\"color:red\"> однаковими данними. Зварніться до адміністратора!</h3>";
                }


        }


       }


        include ('log_in.php'); //подключаем файл с 

    ?> 