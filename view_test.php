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

    if (isset($_GET['id']))
    {
        $test_id =  $_GET['id'];
        $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
        //if(isset($_SESSION["user_id"]))
            //$user_id = $_SESSION["user_id"];
    }
    else
    {
        echo "<h1> Помилка!!! <h1>";
        exit;             
    }


    
    echo "<br><h1 align=\"center\"> $testname </h1><br>";


    $query_test = "SELECT * FROM `tests` WHERE id_test ='$test_id'";
    $result_test = mysqli_query($conection, $query_test) or die(mysqli_error($conection));

    if(mysqli_num_rows($result_test) != 1){
        echo "<h1> Помилка в індексації теста!!! <h1>";
        exit;
    }

    $row_test = mysqli_fetch_array($result_test);

    $count_quest = isset($row_test['count_quest']) ? $row_test['count_quest'] : 0;
    $include_impot = isset($row_test['include_impot']) ? $row_test['include_impot'] : 0;
    $random = isset($row_test['random']) ? $row_test['random'] : 0;


    
    
                       
    $query = "SELECT * FROM `questions` WHERE test_id ='$test_id'";
    $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
    $count = mysqli_num_rows($result);


    if($count > 0)
    {

        $iterat = 0;
        while ($row = mysqli_fetch_array($result))
        {           
            $arr_question[$iterat] = $row['id_question'];
            $arr_question[$iterat] .= " ";
            $arr_question[$iterat++] .= isset($row['question_impot']) ? $row['question_impot'] : 0;  
            //echo "$iterat = "  . $arr_question[$iterat-1] . "|<br>";     
        }

        if($count_quest < $count)
        {

            if($include_impot == 1)
            {
                $iterat = 0;
                foreach($arr_question as $value_arr ){
                    if(explode(" ", $value_arr)[1] == 1){
                        $out_arr_question[$iterat++] = explode(" ", $value_arr)[0];
                    }            
                }

                foreach($arr_question as $value_arr ){
                    if(explode(" ", $value_arr)[1] != 1){

                        if($iterat >= $count_quest)
                            break;

                        $out_arr_question[$iterat++] = explode(" ", $value_arr)[0];
                    }            
                }

            }else{

                if($random == 1){
                    shuffle($arr_question);
                }

                $iterat = 0;

                foreach($arr_question as $value_arr )
                {
                    if($iterat >= $count_quest)
                        break;

                    $out_arr_question[$iterat++] = explode(" ", $value_arr)[0];
                                
                }

            }

        }
        else{

                $iterat = 0;
                foreach($arr_question as $value_arr ){                        
                        $out_arr_question[$iterat++] = explode(" ", $value_arr)[0];                                      
                }
        }

        if($random == 1){
            shuffle($out_arr_question);
        }
        $id_qests = "";
        foreach($out_arr_question as $value_arr ){
            $id_qests .= $value_arr;
            $id_qests .= " ";
        }                
            



        ?>
            <form  action ="result_controller.php" method="post" style="width: 100%; ">
                <input type="hidden" name="id_qests" value="<?php echo $id_qests ?>">
                <input type="hidden" name="id_test" value="<?php echo $test_id ?>">
                <!--<input type="hidden" name="id_user" value="<?php if(isset($user_id))echo $user_id ?>">-->
        <?php

                $counter = 1;

                foreach($out_arr_question as $value_arr )
                {
                    $query = "SELECT * FROM `questions` WHERE id_question ='$value_arr'";
                    $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
                    $row = mysqli_fetch_array($result);

                    Showqvestions(
                                    $counter++,
                                    $row['id_question'],
                                    $row['questiontype'], 
                                    $row['questiontext'],
                                    $row['question_answ_count'],
                                    $row['questionanswer'],
                                    $row['questionball'],
                                    $row['questionimg'],
                                    $row['question_impot'],
                                    $row['test_id']
                                );
                }

        ?>
                <br><br>

                <div class="container">              
                    <button class="btn btn-lg btn-primary btn-block" type="submit">-- Завершити тест --</button>      
                </div>

                <br><br>
            </form >
        <?php



    }
    else{      
        echo "<br> <hr noshade   style = \"height: 3px;\"> ";
        echo "<br><h4>Відсутні питання в даному тесті!</h4>";
        echo "<br> <hr noshade   style = \"height: 3px;\"> ";
    }


?>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>



<?php

    function Showqvestions( 
                            $counter,
                            $id_question,
                            $questiontype, 
                            $questiontext,
                            $question_answ_count,
                            $questionanswer,
                            $questionball,
                            $questionimg,
                            $question_impot,
                            $test_id 
                          )
    {
        
        
                                if($questiontype == "only")
                                    $tyte_text =  " Виберіть один із варіантів відповідей! ";
                                elseif($questiontype == "some")
                                    $tyte_text =  " Виберіть декілька варіантів відповідей! ";          
                                elseif($questiontype == "text")       
                                    $tyte_text =  " Впишіть відповідь в поле! ";
                                elseif($questiontype == "ratio")
                                    $tyte_text =  " Встановіть відповідність ";
                                else
                                    $tyte_text =  "Помилка в питанні зверніться до викладача!!!";

    ?>
        <hr noshade   style = "height: 3px;"> <br>

        
            <div class="container" style= "background-color: #C0C0C0">
            
                <!--============ Питання №  =============-->
                <hr noshade   style = "height: 1px" >
                <div class="row">
                    <div class="col-12">                                                                                                                   <!--== [Виберіть один / декілька із варіантів]/[ Впишіть відповідь в поле]/[ Встановіть відповідність] ===-->
                         <label for="exampleFormControlSelect1" ><h5 style = "display : inline"> Питання № <?php echo"$counter  ";  ?></h5> <?php echo"( $tyte_text )"; ?></label>
                    </div>
                </div>
                <!--=====================================-->


                <!--============ text question  =============-->
                <hr noshade   style = "height: 1px" >
                <div class="row" style = "padding:10px">
                    <div class="col-12" style = "background-color: #C0F0E7;  ">

                        <label for="exampleFormControlSelect1"><h2>
                            <?php echo "$questiontext" ?>
                        </h2></label>
                    </div>
                </div>
                <!--=========================================-->


                <!--============ Відповіді =============-->
                <hr noshade   style = "height: 1px" >
                <div class="row">
                    <div class="col-12">

                            <label for="exampleFormControlSelect1"><h5>Відповіді : </h5></label> <br>
                     
                            <?php

                            
                                    if($questiontype == "only" || $questiontype == "some")
                                    {
                                        echo "<div class=\"container\">";

                                            $mass_answ = explode("\n", $questionanswer);

                                            if($questiontype == "only")
                                            {
                                        
                                                for($iter = 1; $iter <=  $question_answ_count; $iter++)
                                                {
                                                    ?>
                                                        <div class="row">

                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="exampleRadio_<?php echo "$id_question"; ?>"  value="<?php echo "$iter"; ?>" <?php if($iter == 1)echo "checked"; ?>>
                                                                    <label class="form-check-label" for="exampleRadios">
                                                                        №<?php echo "$iter";  ?>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" value="<?php $buf = $mass_answ[$iter - 1]; echo "$buf";  ?>" name="radio_<?php echo "$iter"; ?>" readonly >
                                                            </div>

                                                        </div>
                                                                            
                                                    <?php
                                                }                                       
                                            }
                                            elseif($questiontype == "some")
                                            {                                             

                                                for($iter = 1; $iter <=  $question_answ_count; $iter++){
                                                    ?>
                                                        <div class="row">

                                                            <div class="col-1" >
                                                                <div class="form-check">            
                                                                    <input class="form-check-input" type="checkbox" name="exampleсheckbox_<?php echo "$iter"; ?>_<?php echo "$id_question"; ?>"  value="1"  >
                                                                    <label class="form-check-label" for="exampleсheckbox_<?php echo "$iter"; ?>">
                                                                        №<?php echo "$iter";  ?>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" value="<?php $buf = $mass_answ[$iter - 1]; echo "$buf";  ?>" name="checkbox_<?php echo "$iter"; ?>" readonly>
                                                            </div>

                                                        </div>
                                                                            
                                                    <?php
                                                }    
                                               
                                            }
                                            
                                        echo "</div>";
                                    }
                                    elseif($questiontype == "text" )
                                    {
                                        ?>
                                            <div class="col-12">
                                                <input class="form-control form-control-sm" type="text" name = "text_answ_<?php echo "$id_question"; ?>" placeholder="">
                                            </div> 
                                        <?php
                                    }


                            ?>
                       
                    </div>
                </div>
                <!--=====================================-->


                <!--============ control panel =============-->
                <hr noshade   style = "height: 1px" >    
                <div class="row">

                    <div class="col-9" style="margin-top : 6px">
                        <label for="exampleFormControlSelect1"><h4>Кількість балів за <?php if($questiontype == "some") echo "кожну"; ?> привильну  відповідь: - <?php   echo "$questionball"; ?>  </h4></label>
                    </div>
                                                                                                                                       
                </div>                   
                <!--========================================-->                  

            </div>
        

        <br>

    <?php
    }
?>