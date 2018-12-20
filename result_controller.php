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

    if(isset($_POST['id_qests']))
    {
            $id_quests_str = $_POST['id_qests'];
            $id_quests_arr = explode(" ", $id_quests_str);
            $id_test = $_POST['id_test'];

            if(isset($_SESSION["user_id"])){              
                $id_user =  $_SESSION["user_id"];
            }
            else{
                echo "Потрібно авторизуватися!";
                exit;
            }

            $show_result = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$id_test' "))['show_result'];

            date_default_timezone_set('Europe/Kiev');
            $date = date('Y-m-d', time());
            $time = date('H:i:s', time());
             
            $query  =  "INSERT INTO `result_user_test` (`id_result`, `user_id`, `test_id`, `balls_all`, `balls`, `procents`, `mark`, `dateteusing`, `timeusing`) 
            VALUES (NULL, '$id_user', '$id_test', NULL, NULL, NULL, '100500', '$date', '$time')";
            
             
            
             $result = mysqli_query($conection, $query) or die(mysqli_error($conection));

            if(!$result)
            {
                echo "err N 1";
                exit;
            }

           

            $id_result = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `result_user_test` WHERE  `user_id` = '$id_user' and `test_id` = '$id_test' and `mark` = '100500' "))['id_result'];
            $query  =  "UPDATE `result_user_test` SET `mark` = NULL WHERE `result_user_test`.`id_result` = '$id_result'";
            $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
            if(!$result)
            {
                echo "err N 2";
                exit;
            }
            
           
            $balls_all = 0;  
            $balls = 0;

            foreach($id_quests_arr as $value_arr)
            {
                if(!isset($value_arr) || $value_arr == "" || $value_arr == " "|| $value_arr == "\n" )
                    break;

                
                
                $query = "SELECT * FROM `questions` WHERE id_question ='$value_arr'";
                $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
                $row = mysqli_fetch_array($result);
                $ball_your = 0;

                $questiontype = $row['questiontype'];               
                $question_answ_count = $row['question_answ_count'];
                $questionanswer = $row['questionanswer'];
                $questionball = $row['questionball'];

                $cofficient_ball = 0;

                if($questiontype == "only")
                {
                    $answer = $_POST["exampleRadio_$value_arr"];
                    $answer_corr = explode("\n#\n",$questionanswer)[1];
                    if($answer == $answer_corr){
                        $ball_your = $questionball;
                    }
                }
                elseif ($questiontype == "some")
                {
                    $answer = "";

                    for($iter = 1; $iter <=  $question_answ_count; $iter++){ 

                        if(isset($_POST["exampleсheckbox_" . $iter ."_" . $value_arr])){
                             $answer .= "$iter\n";
                        }                    
                    } 

                    $answer_arr = explode("\n",$answer);
                    $answer_corr = explode("\n#\n",$questionanswer)[1];
                    $answer_corr_arr = explode("\n" , $answer_corr);

                    $cofficient_ball = count($answer_corr_arr);

                    foreach($answer_arr as $val){                      
                        if(in_array("$val", $answer_corr_arr))
                            $ball_your += $questionball;
                    }

                    
                    
                }elseif ($questiontype == "text")
                {
                    $answer = $_POST["text_answ_$value_arr"];
                    $answer_corr =  explode("\n#\n",$questionanswer)[1];

                    if(strtoupper ($answer) == strtoupper ($answer_corr))
                        $ball_your = $questionball;

                }

                if($cofficient_ball != 0)
                    $balls_all  += ($questionball * $cofficient_ball);
                else
                    $balls_all  += $questionball;

                    $balls += $ball_your;

                $query  = " INSERT INTO `result_user_questions` (`id_us_quest`, `result_id`, `question_id`, `type_quest`, `answer`, `answer_correct`, `ball`, `ball_your`) 
                            VALUES (NULL, ' $id_result', '$value_arr', '$questiontype', '$answer', '$answer_corr', '$questionball', '$ball_your');";

                mysqli_query($conection, $query) or die(mysqli_error($conection));       

            }
       
            $procents = $balls / ($balls_all / 100);

            if($procents >= 90){
                $mark = 5;
            }elseif($procents >= 75){
                $mark = 4;
            }elseif($procents >= 50){
                $mark = 3;
            }else{
                $mark = 2;
            }
            


            $query  =  "UPDATE `result_user_test` SET `balls_all` = '$balls_all', `balls` = '$balls', `procents` = '$procents', `mark` = '$mark'      WHERE `result_user_test`.`id_result` = '$id_result'";
            $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
            if(!$result)
            {
                echo "err N 3";
                exit;
            }

            

           // echo "<h1> FINISH </h1>";
    
    }
    else
    {
        echo "<h1> Помилка!!! </h1>";
        exit;
    }

   

    if($show_result == "1")
    {
       
    ?>

    <div class="container" style= "background-color: #C0C0C0; width:81%; height: 570px; margin-top : 10px">

        <div class="row" style="height: 100px; ">
            <div class="col-12" style="margin-top : 30px">
                <h1 align="center" > Результат </h1>
            </div>
        </div>
        


        <hr noshade   style = "height: 1px" >

        <div class="row"  >
            <div class="col-2" style="margin-top : 0px">
                <label for="exampleFormControlSelect1">
                    <h4>
                        ФІО
                    </h4>
                </label>
            </div>

            <div class="col-8" style="margin-top : 0px">
                <?php
                    $fio = "";
                    $fio .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['usersurname'];
                    $fio .= "  ";
                    $fio .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['username'];
                    $fio .= "  ";
                    $fio .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['userlastname'];
                ?>
                <input class="form-control form-control-sm" value="<?php echo $fio; ?>" readonly>
            </div>
        </div>

        <div class="row" >
            <div class="col-2" style="margin-top : 0px">
                <label for="exampleFormControlSelect1">
                    <h4>
                        Звання
                    </h4>
                </label>
            </div>

            <div class="col-8" style="margin-top : 0px">
                <?php
                    $rung_id = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['userrung_id'];
                    $rung = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `user_rung` WHERE id_rung = '$rung_id' "))['rungname'];
                 ?>
                <input class="form-control form-control-sm" value="<?php echo $rung; ?>" readonly>
            </div>


        </div>

        <div class="row">
            <div class="col-2" style="margin-top : 0px">
                <label for="exampleFormControlSelect1">
                    <h4>
                        Підрозділ
                    </h4>
                </label>
            </div>

            <div class="col-8" style="margin-top : 0px">
                <?php

                    $id_comp =  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['company_id'];                  
                    $id_plat =  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['platoon_id'];                  
                    $id_spec =  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `users` WHERE id_user = '$id_user' "))['specialty_id'];

                    $subdiv = "Рота №: ";
                    $subdiv .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `company` WHERE id_company = '$id_comp' "))['companynumber'];
                    $subdiv .= "   звод №: ";
                    $subdiv .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `platoon` WHERE id_platoon = '$id_plat' "))['platoonnumber'];
                    $subdiv .= "   спеціальність: ";
                    $subdiv .=  mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `specialty` WHERE id_specialty = '$id_spec' "))['specialtyname'];
                    $subdiv .= ".";
                   
                 ?>

                <input class="form-control form-control-sm" value="<?php echo  $subdiv; ?>" readonly>
            </div>
        </div>

        <hr noshade   style = "height: 1px" >



        <div class="row"  >
            <div class="col-12" style="margin-top : 10px; height: 55px">      
                    <h3 align="center" >
                        Тест "<?php echo mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$id_user' "))['testname']; ?>"
                    </h3>             
            </div>
        </div>

        <div class="row"  >
            <div class="col-5" style="margin-top : 5px">      
                    <h4 >
                       Загальна кількість балів за тест 
                    </h4>             
            </div>

            <div class="col-2" style="margin-top : 9px; margin-left : -70px; ">
                <input class="form-control form-control-sm" value="<?php echo "$balls_all"; ?>" readonly>
            </div>
        </div>

        <div class="row" style = "height: 60px" >
            <div class="col-5" style="margin-top : 5px">      
                <h4 >
                    Набрано балів
                </h4>             
            </div>

            <div class="col-2" style="margin-top : 9px; margin-left : -70px; ">
                <input class="form-control form-control-sm" value="<?php echo "$balls"; ?>" readonly>
            </div>
        </div>

        <div class="row" style = "height: 60px" >
            <div class="col-5" style="margin-top : 5px">      
                <h4 >
                    Оцінка
                </h4>             
            </div>

            <div class="col-2" style="margin-top : 9px; margin-left : -70px; ">
                <input class="form-control form-control-sm" value="<?php echo "$mark"; ?>" readonly>
            </div>
        </div>

        

        <div class="row" style = "height: 40px" >
            <div class="col-2" style="margin-top : 0px">      
                <h4 >
                    Успішність:
                </h4>             
            </div>

            <div class="col-10" style="margin-top : 4px; margin-left : -30px;">      
                <div class="progress" style="height: 30px">
                    <div class="progress-bar <?php if($mark == 5) echo "bg-success"; elseif($mark == 4) echo "bg-info"; elseif($mark == 3) echo "bg-warning"; elseif($mark == 2) echo "bg-danger";?>" role="progressbar" style="width: <?php echo $procents;?>%;  " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <?php echo $procents;?> </div>
                </div>             
            </div>

            
        </div>

       
        
    </div>


    <?php
    }
    else 
    { 
      
?>

    <div class="container" style= "background-color: #C0C0C0; width:81%; height: 130px; margin-top : 10px">
        <div class="row">
            <div class="col-12" style="margin-top : 40px">               
                <h2  align="center">
                       Тест завершено!
                </h2>
            </div>
        </div>
    </div>
<?php 
    }  
    
   
?>

   

    <div class="container"  style = "width:100%; margin-top : 10px;" >
        <a  href="test_start.php" class="btn btn-lg btn-primary btn-block">Повернутись до головної панелі</a>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>