<?php

    session_start();
    require ('conection_db.php');

    if(isset($_POST['id_qests']))
    {
            $id_quests_str = $_POST['id_qests'];
            $id_quests_arr = explode(" ", $id_quests_str);
            $id_test = $_POST['id_test'];

            if(isset($_SESSION["user_id"])){
                echo "OK [" . $_SESSION["user_id"] ."]";
                $id_user =  $_SESSION["user_id"];
            }
            else{
                echo "Потрібно авторизуватися!";
                exit;
            }

            $show_result = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['show_result'];

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


            if($show_result == "1"){
                echo "<h1>balls_all = $balls_all </h1>";
                echo "<h1>balls = $balls </h1>";
                echo "<h1>procents = $procents</h1>";
                echo "<h1>mark = $mark</h1>";
            }

            echo "<h1> FINISH </h1>";
    
    }
    else
    {
        echo "<h1> Помилка!!! </h1>";
        exit;
    }

?>