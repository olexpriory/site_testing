
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
     require ('../conection_db.php');


    if (isset($_POST['create_file'])) 
    {
         $test_id =  $_POST['create_file'];
         $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
    }
    elseif (isset($_GET['id']))
    {
        $test_id =  $_GET['id'];
        $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
    }
     elseif(isset($_SESSION['testname']))
    {
        $testname = $_SESSION['testname'];
        $test_id = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE testname = '$testname' "))['id_test'];
    }
    elseif (isset($_SESSION['id_test'])) 
    {
         $test_id = $_SESSION['id_test']; 
         $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
         echo "<h1>Save question</h1>";
    }          
    else
    {
        echo "<h1> Помилка!!! <h1>";
        exit;             
    }
            
     //echo "<br> test_id = $test_id <br><br>";

     echo "<br><h1 align=\"center\"> $testname </h1><br>";

                       
            $query = "SELECT * FROM `questions` WHERE test_id ='$test_id'";
            $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
            $count = mysqli_num_rows($result);

            if($count > 0){
                $counter = 1;
                while ($row = mysqli_fetch_array($result)){
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
                                    $row['test_id']);
                }
            }
            else{

                echo "<br> <hr noshade   style = \"height: 3px;\"> ";
                echo "<br><h4>Відсутні питання!</h4>";
                echo "<br> <hr noshade   style = \"height: 3px;\"> ";
            }



            if (isset($_POST['create_file']))
            {    
                
                include 'crater_php_fie_config.php';    
                $file = "../tests/$testname.php";
                $functional_code = $functional_code_hedr . $functional_code_body. $functional_code_ehd;
                file_put_contents($file, $functional_code);
                session_start();
                $_SESSION['user_msg'] = "Збережено тест '$testname'";
                header("Location: index.php");
        
                // include ('index.php');
                //exit;
            }
       
?>   


            <!--==================== Form  crete new question ====================-->   
                <div class="row" >

                    <div class="col-2">
                        <button type="submit" class="btn btn-primary mb-2" >Додати питання</button>                                                                           
                    </div>

                    <div class="col-8">
                        <h4>
                            <form  action ="save_question.php" method="post" style="width: 100%; ">

                            <div id="link" >
                                No
                            </div>

                                <div class="container" style= "background-color: #C0C0C0">

                                        <hr noshade   style = "height: 1px" >    
                                        <div class="row">

                                                <div class="col-6">
                                                    <label for="exampleFormControlSelect1">Тип питання</label>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">     
                                                        <select name='type_quest' class="form-control" id="exampleFormControlSelect1" onchange="f_type_quest(value)" >
                                                            <option value="only">Одина відповідь</option>
                                                            <option value="some">Декілька відповідей</option>
                                                            <option value="text">Текст</option>
                                                            <option value="ratio">Співвідношення</option>
                                                        </select>                               
                                                    </div>
                                                </div>
                                                
                                        </div>
                                        
                                        <hr noshade   style = "height: 1px" >         
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Текcт питання</label>
                                                    <textarea name='text_quest' class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                                </div>   
                                            </div>

                                        </div>

                                        <hr noshade   style = "height: 1px" >
                                        <div class="row" id="count_answ">

                                            <div class="col-6" >
                                                <label for="exampleFormControlSelect1">Кількість відповідей</label>
                                            </div>

                                            <div class="col-6">
                                                    <div class="form-group">                  
                                                        <select name='count_answ_quest' class="form-control" id="exampleFormControlSelect1" onchange="f_count_answ(value)">
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                        </select>
                                                    </div>
                                            </div>

                                        </div>

                                        <div class="row" id="after_count_answ" style = "display:none">

                                            <div class="col-12" >
                                                <label for="exampleFormControlSelect1">Введіть правильну відповідь у поле "Відповіді".</label>
                                            </div>

                                            
                                        </div>

                                        <hr noshade   style = "height: 1px" >
                                        <div class="row">

                                            <div class="col-12">
                                                    
                                                <label for="exampleFormControlSelect1"><h5>Відповіді : </h5></label>
                                                <br>

                                                <div class="container">

                                                    <div id="radio_block">
                                    
                                                        <div class="row" id="radio_block_1" >

                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="exampleRadio" id="radio1" value="1" checked>
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        №1
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" placeholder="" name="radio_1" >
                                                            </div>

                                                        </div>

                                                        <div class="row" id="radio_block_2" >

                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="exampleRadio" id="radio1" value="2" >
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        №2
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" placeholder="" name="radio_2" >
                                                            </div>

                                                        </div>

                                                        <div class="row" id="radio_block_3" style = "display:none" >

                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="exampleRadio" id="radio1" value="3" >
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        №3
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" placeholder="" name="radio_3" >
                                                            </div>

                                                        
                                                        
                                                        
                                                        </div>

                                                        <div class="row" id="radio_block_4" style = "display:none" >

                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="exampleRadio" id="radio4" value="4" >
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        №4
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" placeholder="" name="radio_4" >
                                                            </div>

                                                        
                                                        
                                                        
                                                        </div>


                                                        <div class="row" id="radio_block_5" style = "display:none">

                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="exampleRadio" id="radio5" value="5" >
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        №5
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" placeholder="" name="radio_5" >
                                                            </div>

                                                        </div>

                                                        <div class="row" id="radio_block_6" style = "display:none">

                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="exampleRadio" id="radio6" value="6" >
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        №6
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" placeholder="" name="radio_6" >
                                                            </div>

                                                        </div>

                                                        <div class="row" id="radio_block_7" style = "display:none" >

                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="exampleRadio" id="radio7" value="7" >
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        №7
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" placeholder="" name="radio_7" >
                                                            </div>

                                                        </div>

                                                        <div class="row" id="radio_block_8" style = "display:none" >

                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="exampleRadio" id="radio8" value="8" >
                                                                    <label class="form-check-label" for="exampleRadios1">
                                                                        №8
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" placeholder="" name="radio_8" >
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div id="checkbox_block" style = "display:none">

                                                        <div class="row" id="checkbox_block_1" >

                                                            <div class="col-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="exampleсheckbox_1" id="checkbox1" value="1" >
                                                                    <label class="form-check-label" for="exampleсheckbox_1">
                                                                        №1
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input class="form-control form-control-sm" type="text" placeholder="" name="checkbox_1">
                                                            </div>

                                                        </div>

                                                        <div class="row" id="checkbox_block_2" >

                                                            <div class="col-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="exampleсheckbox_2" id="checkbox2" value="1" >
                                                                    <label class="form-check-label" >
                                                                        №2
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input name="checkbox_2" class="form-control form-control-sm" type="text" placeholder="">
                                                            </div>

                                                        </div>

                                                        <div class="row" id="checkbox_block_3" style = "display:none">

                                                            <div class="col-1" >
                                                                <div class="form-check">                                 
                                                                <input class="form-check-input" type="checkbox" name="exampleсheckbox_3" id="checkbox3" value="1" >
                                                                    <label class="form-check-label" >
                                                                        №3
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input name="checkbox_3" class="form-control form-control-sm" type="text" placeholder="">
                                                            </div>

                                                        
                                                        
                                                        
                                                        </div>

                                                        <div class="row" id="checkbox_block_4" style = "display:none">

                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="exampleсheckbox_4" id="checkbox4" value="1" >                
                                                                    <label class="form-check-label" >
                                                                        №4
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input name="checkbox_4" class="form-control form-control-sm" type="text" placeholder="">
                                                            </div>                                                                                                                                                               
                                                        </div>

                                                        <div class="row" id="checkbox_block_5" style = "display:none">
                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="exampleсheckbox_5" id="checkbox5" value="1" >
                                                                    <label class="form-check-label">
                                                                        №5
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input name="checkbox_5" class="form-control form-control-sm" type="text" placeholder="">
                                                            </div>

                                                        </div>

                                                        <div class="row" id="checkbox_block_6" style = "display:none">
                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="exampleсheckbox_6" id="checkbox6" value="1" >
                                                                    <label class="form-check-label" >
                                                                        №6
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input name="checkbox_6" class="form-control form-control-sm" type="text" placeholder="">
                                                            </div>

                                                        </div>

                                                        <div class="row" id="checkbox_block_7" style = "display:none">
                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="exampleсheckbox_7" id="checkbox7" value="1" >
                                                                    <label class="form-check-label" >
                                                                        №7
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input name="checkbox_7" class="form-control form-control-sm" type="text" placeholder="">
                                                            </div>

                                                        </div>

                                                        <div class="row" id="checkbox_block_8" style = "display:none">
                                                            <div class="col-1" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="exampleсheckbox_8" id="checkbox8" value="1" >
                                                                    <label class="form-check-label" >
                                                                        №8
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-11">
                                                                <input name="checkbox_8" class="form-control form-control-sm" type="text" placeholder="">
                                                            </div>

                                                        </div>

                                                    </div> 

                                                    <div id="text_block" style = "display:none">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <input class="form-control form-control-sm" type="text" name = "text_answ" placeholder="">
                                                            </div>   
                                                        </div>
                                                    </div>

                                                </div>

                                                <br>                                               
                                            </div>

                                        </div>

                                        <hr noshade   style = "height: 1px" >    
                                        <div class="row">

                                                <div class="col-3">
                                                    <label for="exampleFormControlSelect1">Кількість балів</label>
                                                </div>

                                                <div class="col-2">
                                                    <select name='ball_quest' class="form-control" id="exampleFormControlSelect1"  >
                                                        <option value="1"> 1</option>
                                                        <option value="2"> 2</option>
                                                        <option value="3"> 3</option>
                                                        <option value="4"> 4</option>
                                                        <option value="5"> 5</option>
                                                        <option value="6"> 6</option>
                                                        <option value="7"> 7</option>
                                                        <option value="8"> 8</option>
                                                        <option value="9"> 9</option>
                                                        <option value="10">10</option>
                                                    </select> 
                                                </div>

                                                <div class="col-3">
                                                    <label class="form-check-label" for="defaultCheck1" style=" margin-left : 70px; " >
                                                        обов'язково
                                                    </label>
                                                </div>

                                                <div class="col-1">                               
                                                    <div class="form-check" style=" margin-top : 6px; ">                                
                                                        <input class="form-check-input" type="checkbox"  name="exampleсheckbox_impot" value="1">                                                               
                                                    </div>                                                                         
                                                </div>

                                                <div class="col-3">
                                                    <button type="submit" class="btn btn-primary mb-2" style="margin: 2%" name="save_quest" value = "<?php echo $test_id; ?>">Зберегти питання</button>                                                                   
                                                </div>
                                                
                                        </div>

                                </div>
                            </form>
                        </h4>
                    </div>

                </div>   


                <script>

                    function f_type_quest(value){

                        // document.getElementById("radio_block").style.display="block"; 
                        //var link="empty";
                        //link= document.getElementById("radio_block").style.display;
                        //document.getElementById("link").innerHTML=link;

                        if(value == "only"){                                                             
                            document.getElementById("radio_block").style.display=""; 
                            document.getElementById("checkbox_block").style.display="none";
                            document.getElementById("text_block").style.display="none"; 
                            document.getElementById("count_answ").style.display="";
                            document.getElementById("after_count_answ").style.display="none";                 
                        }else if(value == "some"){
                            document.getElementById("radio_block").style.display="none"; 
                            document.getElementById("checkbox_block").style.display="";
                            document.getElementById("text_block").style.display="none";
                            document.getElementById("count_answ").style.display="";
                            document.getElementById("after_count_answ").style.display="none"; 
                        }
                        else if(value == "text"){
                            document.getElementById("radio_block").style.display="none"; 
                            document.getElementById("checkbox_block").style.display="none";
                            document.getElementById("text_block").style.display=""; 
                            document.getElementById("count_answ").style.display="none";
                            document.getElementById("after_count_answ").style.display="";
                        }
                            
                    }

                    function f_count_answ(value)
                    {                        
                        for(i = 1; i <= 8 ; i++){
                            if(i<=Number(value)){
                                document.getElementById(`radio_block_${i}`).style.display="";
                                document.getElementById(`checkbox_block_${i}`).style.display="";
                            }
                            else{
                                document.getElementById(`radio_block_${i}`).style.display="none";
                                document.getElementById(`checkbox_block_${i}`).style.display="none";
                            }
                        }
                    }

                 /*   $("#type_quest").change(function() {

                        ocument.getElementById("radio_block").style.display="block"; 

                        if($(this).val() == "only")
                        {                            
                            document.getElementById("radio_block").style.display="block"; 
                            document.getElementById("checkbox_block").style.display="none"; 
                            //$("#search-form").attr("action", "/search/" + action);

                        }
                        else if($(this).val() == "sone")
                        {
                            document.getElementById("radio_block").style.display="none"; 
                            document.getElementById("checkbox_block").style.display="block";
                        }

                      //  var action = $(this).val() == "people" ? "user" : "content";
                       
                    }); */

                </script>                   
            <!--==================================================================--> 


<br>
<div class="container">
    <form action="crater_php_fie.php" method="POST">
        <button class="btn btn-lg btn-primary btn-block" name="create_file" value = "<?php echo $test_id; ?>" type="submit">-- Зберегти тест --</button>
    </form>
</div>

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

    ?>
        <hr noshade   style = "height: 3px;"> 

        <form  action ="save_question.php" method="post" style="width: 100%; ">
            <div class="container" style= "background-color: #C0C0C0">
            
                <hr noshade   style = "height: 1px" >
                <div class="row">
                    <div class="col-12">
                         <label for="exampleFormControlSelect1"><h3> Питання № $counter </h3></label>
                    </div>
                </div>

                <hr noshade   style = "height: 1px" >
                <div class="row">
                    <div class="col-12">
                        <label for="exampleFormControlSelect1"><h6>
                
                            <?php
                                if($questiontype == "only")
                                    echo " Виберіть один із варіантів відповідей! ";
                                elseif($questiontype == "some")
                                    echo " Виберіть декілька варіантів відповідей! ";          
                                elseif($questiontype == "text")       
                                    echo " Впишіть відповідь в поле! ";
                                elseif($questiontype == "ratio")
                                    echo " Встановіть відповідність ";
                            ?>

                        </h6></label>
                    </div>
                </div>


                <hr noshade   style = "height: 1px" >
                <div class="row">
                    <div class="col-12">
                        <label for="exampleFormControlSelect1"><h3>
                            <?php echo "$questiontext" ?>
                        </h3></label>
                    </div>
                </div>





                <hr noshade   style = "height: 1px" >
                <div class="row">
                    <div class="col-12">
                        <label for="exampleFormControlSelect1"><h3>
                            <?php echo "$questiontext" ?>
                        </h3></label>
                    </div>
                </div>

    
        if($questiontype == "only" || $questiontype == "some"){

            $mass_answ = explode("\n", $questionanswer);

            if($questiontype == "only"){
                for($iter = 1; $iter <=  $question_answ_count; $iter++){

                    echo ""
                    $mass_answ[$iter]
                }
            }

        }


        $answer = "<input type=\"text\" name=\"user_lastname\" class=\"form-control\"></input><p>";

        echo "<br><br><p><h4>$questiontext</h4></p><br><br>";
        echo "$answer";

        echo "<br> <hr noshade   style = \"height: 3px;\"> ";

    }
?>