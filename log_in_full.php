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
         require ('conection_db.php');

        if( isset($_POST['user_surname'])
            && isset($_POST['user_name'])
            && isset($_POST['user_lastname'])
            && isset($_POST['user_rung']) 

            && isset($_POST['subdivision_company'])
            && isset($_POST['subdivision_platoon'])
            && isset($_POST['subdivision_specialtyy'])

          ){
           


                $usersurname = $_POST['user_surname'];
                $username = $_POST['user_name'];
                $userlastname = $_POST['user_lastname'];

                $userrung_id = $_POST['user_rung'];
                $company_id = $_POST['subdivision_company'];
                $platoon_id = $_POST['subdivision_platoon'];
                $specialty_id = $_POST['subdivision_specialtyy'];

                if(
                        $userrung_id != ''
                        && $company_id != ''
                        && $platoon_id != ''
                        && $specialty_id != ''
                    )
                    {


                        $query = "SELECT * FROM `users` WHERE usersurname ='$usersurname' and username = '$username' 
                        and userlastname = '$userlastname'
                        and userrung_id = '$userrung_id'
                        and company_id ='$company_id'
                        and platoon_id = '$platoon_id'
                        and specialty_id = '$specialty_id'
                        ";

                        $result = mysqli_query($conection, $query) or die(mysqli_error($conection)); // выпольнение запроса или выход?
                        $count = mysqli_num_rows($result);

                        if($count == 0){

                                date_default_timezone_set('Europe/Kiev');
                                $date = date('Y-m-d H:i:s', time());

                                $query  = "INSERT INTO `users` (`id_user`, `usersurname`, `username`, `userlastname`, `userrung_id`, `company_id`, `platoon_id`, `specialty_id`, `userege`, `userdatereg`)
                                VALUES (NULL, '$usersurname', '$username', '$userlastname', '$userrung_id', '$company_id', '$platoon_id', '$specialty_id', NULL, '$date')";
                
                                $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
                
                                if($result){
                                    $smsg = "Реєстрація пройшла успішно";
                                    $fmsg = NULL;
                                    include ('log_in.php');
                                    return;
                                } else {
                                    $fmsg = "Помилка реєстрації";
                                }

                        }
                        else{
                            $fmsg = "В ситемі вже є такий користувач змініть будь ласка данні, або ввійдіть в систему";                        
                            $err = 1;
                        }
                    }
                    else {
                        $fmsg = "Не всі поля заповнені! Заповніть всі поля";
                    }  

               
            }
            

    ?>


    <div class="container" style="width : 60%;">
        <form  class="form-signin" action="log_in_full.php" method="post">
            <br><br><br>
            <h2 align="center">Реэстрацiя</h2> 
            <br>

            <!--=========================== user mesage ============================-->
            <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?> 
            <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; if(isset($err)){ echo "<p align=\"center\"><a href=\"log_in.php\">Ввійти</a> в систему </p>"; $err = NULL;}   ?> </div><?php } ?> 
            <!--=====================================================================-->   
                 
            <input type="text" name="user_surname" class="form-control"   <?php if(isset($usersurname)) echo "value = \"$usersurname\""; else echo "placeholder=\"Прiзвище\" required";?> >
            <input type="text" name="user_name" class="form-control"   <?php if(isset($username)) echo "value = \"$username\""; else echo "placeholder=\"Iм'я\" required";?> >
    
            <input type="text" name="user_lastname" class="form-control" <?php if(isset($userlastname)) echo "value = \"$userlastname\""; else echo "placeholder=\"По батькорвi\" required";?> > 

            <select name='user_rung' class="form-control" required>
                        

                            <?php

                                if(isset($userrung_id)){
                                    $result = mysqli_query($conection, "SELECT * FROM `user_rung` WHERE id_rung = '$userrung_id'");
                                    echo "<option value = \"$userrung_id\" >". mysqli_fetch_array($result)['rungname'] . "</option> "; 
                                }
                                else echo "<option  value=\"\"> Звання </option>";
                                

                                $result = mysqli_query($conection, "SELECT * FROM `user_rung`");

                                while ($row = mysqli_fetch_array($result)){
                                    echo "<option value=' ".$row['id_rung']." '>".$row['rungname']."</option>";
                                }
                            ?>

                        </select>

            <!--============================== spiner ==============================-->
            <input type="button" name="user_subdivision" class="form-control" value="Підрозділ" style="text-align:left">

            <div     style="width : 95%; margin-left: 30px;" >

                <select name='subdivision_company' class="form-control" required >
                    <!--<option value=''>-- Рота № --</option>";-->
                    <?php

                        if(isset($company_id)){
                            $result = mysqli_query($conection, "SELECT * FROM `company` WHERE id_company = '$company_id'");
                            echo "<option value = \"$company_id\" >". mysqli_fetch_array($result)['companynumber'] . "</option> "; 
                        }
                        else echo "<option  value=\"\">-- Рота № --</option>";

                         $result = mysqli_query($conection, "SELECT * FROM `company`");

                        while ($row = mysqli_fetch_array($result)){
                            echo "<option value=' ".$row['id_company']." '>".$row['companynumber']."</option>";
                        }
                    ?>
                </select>

                <select name='subdivision_platoon' class="form-control"  required >
                    <?php

                        if(isset($platoon_id)){
                            $result = mysqli_query($conection, "SELECT * FROM `platoon` WHERE id_platoon = '$platoon_id'");
                            echo "<option value = \"$platoon_id\" >". mysqli_fetch_array($result)['platoonnumber'] . "</option> "; 
                        }
                        else echo "<option  value=\"\">-- Взвод № --</option>";

                         $result = mysqli_query($conection, "SELECT * FROM `platoon`");

                        while ($row = mysqli_fetch_array($result)){
                            echo "<option value=' ".$row['id_platoon']." '>".$row['platoonnumber']."</option>";
                        }
                    ?>
                </select>

                 <select name='subdivision_specialtyy' class="form-control" required >
                    <?php

                        if(isset($specialty_id)){
                            $result = mysqli_query($conection, "SELECT * FROM `specialty` WHERE id_specialty = '$specialty_id'");
                            echo "<option value = \"$specialty_id\" >". mysqli_fetch_array($result)['specialtyname'] . "</option> "; 
                        }
                        else echo "<option  value=\"\">-- Спеціальність --</option>";

                         $result = mysqli_query($conection, "SELECT * FROM `specialty`");

                        while ($row = mysqli_fetch_array($result)){
                            echo "<option value=' ".$row['id_specialty']." '>".$row['specialtyname']."</option>";
                        }
                    ?>
                </select>
          
            </div>           
            <!--=====================================================================-->

            <br><br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Зареэструвати</button>
            
    </form>    
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>