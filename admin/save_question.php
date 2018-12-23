<?php

require ('../conection_db.php');

if (isset($_POST['save_quest'])) 
{
    $test_id =  $_POST['save_quest']; 
    $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
        
    
    $id_question = (isset($_POST['id_question']) && $_POST['id_question'] != "" ) ? $_POST['id_question'] :  NULL;
    $counter_angl = (isset($_POST['counter']) && $_POST['counter'] != "" ) ? $_POST['counter'] : NULL;
      

    
        $type_quest = $_POST['type_quest'];
        $text_quest = $_POST['text_quest'];

       
        $ball_quest = $_POST['ball_quest'];


        if($type_quest == "only" || $type_quest == "some")
            $count_answ_quest = $_POST['count_answ_quest'];
        else
            $count_answ_quest = 0;

        $answer = "";

        if($type_quest == "only"){
            for($iter = 1; $iter <=  $count_answ_quest; $iter++){
                $answer .= $_POST["radio_$iter"];
                $answer .= "\n";
            } 
            
            $answer .= "\n#\n";
            $answer .= $_POST["exampleRadio"];
            $answer .= "\n#\n";
            
        }

        if($type_quest == "some")
        {
            for($iter = 1; $iter <=  $count_answ_quest; $iter++){ 
                $answer .= $_POST["checkbox_$iter"];
                $answer .= "\n";
            }  
            
            $answer .= "\n#\n";

            $count = 0;
            for($iter = 1; $iter <=  $count_answ_quest; $iter++){ 
                if(isset($_POST["exampleсheckbox_$iter"])){
                    $answer .= "$iter\n";
                    $count++;
                }                    
            } 

            if($count != 0)
                $ball_quest =  ($ball_quest /  $count);
            else
                $ball_quest = 0;

            $ball_quest =  round($ball_quest, 2);

            $answer .= "#\n";
            
        }


        if($type_quest == "text"){
            $answer .= "\n#\n";
            $answer .= $_POST["text_answ"];
            $answer .= "\n#\n";
        }


        if(isset($_POST["exampleсheckbox_impot"])){
            $impot_quest = 1;
        }
        else{
            $impot_quest = 0;
        }


        // echo "<br>test_id = $test_id<br>";
        // echo "<br>type_quest = $type_quest<br>";
        // echo "<br>text_quest = $text_quest<br>";
        // echo "<br>count_answ_quest =  $count_answ_quest<br>";
        // echo "<br>answer = $answer<br>";
        // echo "<br>ball_quest = $ball_quest<br>";
        // echo "<br>impot_quest = $impot_quest<br>";


        if(isset($id_question))
        {
           echo "<h1>work</h1>";
            $query  =  "UPDATE `questions` SET  `questiontype`  = '$type_quest',
                                                `questiontext` = '$text_quest',
                                                `question_answ_count` = '$count_answ_quest',
                                                `questionanswer` = '$answer',
                                                `questionball` = '$ball_quest',
                                                `questionimg` = NULL,
                                                `question_impot` = '$impot_quest',
                                                `test_id` = '$test_id' 
                        WHERE  `questions`.`id_question` =   $id_question";                    
            
        }
        else{
            $query  =  "INSERT INTO `questions` (`id_question`, `questiontype`, `questiontext`, `question_answ_count`, `questionanswer`, `questionball`, `questionimg`, `question_impot`, `test_id`) 
                        VALUES (NULL, '$type_quest', '$text_quest', '$count_answ_quest', '$answer', '$ball_quest', NULL, '$impot_quest', '$test_id')";
        }

        echo "<br>|$query|<br>";
            
        $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
            
        session_start();

        $_SESSION['id_test'] = $test_id;
        $_SESSION['counter'] =  isset($counter_angl) ? $counter_angl :  -1;
        $bf =  isset($counter_angl) ? " № ".$counter_angl : "";
        if($result)
            $_SESSION['msg'] = isset($id_question) ? "Змінено питаня ".$bf : "Додано нове питаня";                                                
        else    
            $_SESSION['err'] =  isset($id_question) ? "Помилка при зміні питаня [id:$id_question]": "Помилка при збережені питання!!!"; 
        
        
        header("Location: create_test_basic.php#angl");   
    
  
}
else
{
    echo "<h1> Помиилка \"Пустий набір даних\"  </h1>";
    echo "неможливо відкрити файл \"save_question.php\" для интерпритації<br>";   
    exit;
}





?>