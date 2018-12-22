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
    if(!isset($_SESSION)) 
    {
        session_start();
    }

     require ('../conection_db.php');
     $angl_cont = null;
     $angl_msg = null;
     $angl_err = null;

    if (isset($_GET['id']))
    {
        $test_id =  $_GET['id'];
        $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
    }
    elseif (isset($_SESSION['id_test'])) 
    {
        $test_id = $_SESSION['id_test']; 
        $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
         
        if(isset($_SESSION['counter']))$angl_cont = $_SESSION['counter'];
        if(isset($_SESSION['msg'])) $angl_msg = $_SESSION['msg'];  
        if(isset($_SESSION['err'])) $angl_err = $_SESSION['err'];
                                     
    }          
    else
    {
        echo "<h1> Помилка!!! <h1>";
        exit;             
    }
            
     //echo "<br> test_id = $test_id <br><br>";

     echo "<br><h1 align=\"center\"> $testname </h1><br>";

    $query_test = "SELECT * FROM `tests` WHERE id_test ='$test_id'";
    $result_test = mysqli_query($conection, $query_test) or die(mysqli_error($conection));
    $row_test = mysqli_fetch_array($result_test);

    $query = "SELECT * FROM `questions` WHERE test_id ='$test_id'";
    $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
    $count = mysqli_num_rows($result);

    
    $counter_impot = 1;

    if(isset( $row_test['include_impot'])){
        if($row_test['include_impot'] == 1){
            $counter_impot =  mysqli_num_rows(mysqli_query($conection, "SELECT * FROM `questions` WHERE test_id ='$test_id' and question_impot = '1'"));
            if($counter_impot == 0)$counter_impot = 1;
        }
    }

    
    ?>

        <form action="save_test.php" method="POST" style="width:100%">
            <div class="container" style= "background-color: #C0C0C0; width:100%">
                <div class="row" style="width:100%">

                    <div class="col-1">
                        <label for="exampleFormControlSelect1">Всього питань</label>
                    </div>

                    <div class="col-1">
                        <div class="form-group" style="margin-top: 4px;">     
                            <input class="form-control form-control-sm" type="text" value="<?php echo "$count"; ?>" readonly >                               
                        </div>
                    </div>

                    <div class="col-2">
                        <label for="exampleFormControlSelect1">Кількість питань для використання</label>
                    </div>

                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;">     
                            <select name='cont_quest' class="form-control" id="exampleFormControlSelect1"  >
                                <?php
                                    for($itr = $count; $itr >= $counter_impot; $itr-- )
                                    {
                                        $alpha = null;

                                        if(isset($row_test['count_quest'])){
                                            if($row_test['count_quest'] == $itr){
                                                $alpha = 1;
                                            }
                                        }
                                        echo "<option value=\"$itr\"" . (isset($alpha) ? "selected" : "") . ">$itr</option>";
                                    }
                                    
                                    
                                ?>
                            </select>                               
                        </div>
                    </div>

                    <div class="col-1" style="margin-top: 0px;">
                        <label class="form-check-label"   style="margin-left: 0px; " >
                            Обов'язкові питання
                        </label>
                    </div>

                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 4px; ">                                
                            <input onclick="include_impot_onclic()" class="form-check-input" type="checkbox"  name="include_impot" value="1" <?php if(isset ($row_test['include_impot'])){if($row_test['include_impot'] == 1){ echo "checked"; }} ?>> <!--onchange="f_type_quest(value)" -->                                                              
                        </div>                                                                         
                    </div>

                    <div class="col-1"style="margin-top: 3px;">
                        <label class="form-check-label" style="margin-left: 0px;" >
                            Рандомний вибір
                        </label>
                    </div>

                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 4px; ">                                
                            <input class="form-check-input" type="checkbox"  name="random" value="1"  <?php if(isset ($row_test['random'])){if($row_test['random'] == 1){ echo "checked"; }} ?>>                                                               
                        </div>                                                                         
                    </div>

                    <div class="col-2" style="margin-top: 4px;">
                        <input type="hidden" name="id_test" value="<?php echo $test_id ?>">                               
                        <button  class="btn btn-lg btn-primary btn-block" type="submit">Зберегти тест</button>
                        <button id = "btn_save_test_hiden" name="btn_save_test_name" value="cheng_impot" type="submit" style = "display:none"></button>
                    </div>

                </div>
                <div class="row" style="width:100%; height:40px">                  
                    <div class="col-4"style="margin-top: 3px;">
                        <label class="form-check-label" style="margin-left: 0px;" >
                            Відобразити користувачу результати  
                        </label>
                    </div>

                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 6px; margin-left : -80px;">                                
                            <input class="form-check-input" type="checkbox"  name="show_result" value="1"  <?php if(isset ($row_test['show_result'])){if($row_test['show_result'] == 1){ echo "checked"; }} ?>>                                                               
                        </div>                                                                         
                    </div>         
                </div>               
                                   
                
            </div>
        </form>

    <?php
                       
           
            if($count > 0)
            {
                $counter = 1;

                if(isset($angl_cont))
                    if($angl_cont > $count)
                        $angl_cont = $count;

                while ($row = mysqli_fetch_array($result))
                {

                    if(isset($angl_cont))
                    {
                        
                        if($angl_cont >= 0 )
                        {                       
                            if($angl_cont  == $counter){
                                echo "<a name=\"angl\"></a>";
                                ShowInfo( $angl_msg , $angl_err ); 
                                $_SESSION['counter'] = null;
                            }
                                                             
                        }
                        else
                        {
                            if($counter == $count ){
                                echo "<a name=\"angl\"></a>";
                                ShowInfo( $angl_msg , $angl_err );
                                $_SESSION['counter'] = null;
                            }
                                
                        }
                    }
                    
                        

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
            }
            else{
                ShowInfo( $angl_msg , $angl_err );
                echo "<br> <hr noshade   style = \"height: 3px;\"> ";
                echo "<br><h4>Відсутні питання!</h4>";
                echo "<br> <hr noshade   style = \"height: 3px;\"> ";
            }



       
?>   


            <!--==================== Form  crete new question ====================-->  

                <hr noshade   style = "height: 3px;"> <br> 

                <div class="row" >

                    <div class="col-2">
                        <button type="submit" class="btn btn-primary mb-2" onClick="hide_show();return false;" id="link">Додати питання</button>                                                                           
                    </div>

                    <div class="col-8" id="main_form" style="display:none">
                        <h4>
                            <form  action ="save_question.php" method="post" style="width: 100%; ">

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

                <br>      

                <hr noshade   style = "height: 3px;">  


                <script>

                    function click_edit(value){
                        document.getElementById(`btn_edit_${value}`).click();
                    }

                    function include_impot_onclic(){
                        document.getElementById("btn_save_test_hiden").click();
                    }

                    function hide_show()
                    {
                        if(document.getElementById("main_form").style.display == "none")
                        {
                            document.getElementById("main_form").style.display = "";
                            document.getElementById("link").innerHTML ="Сховати питання";
                        }else{
                            document.getElementById("main_form").style.display = "none";
                            document.getElementById("link").innerHTML ="Додати питання";
                        }
                    }

                    function f_type_quest(value){

               

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
<br>

<br> 
<br>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>























<?php
        function ShowInfo($angl_msg , $angl_err)
        {
           

            if(isset($angl_msg)){ 
                echo "<hr noshade   style = \"height: 3px;\">";
                ?><div class="alert alert-success" role="alert"> <?php echo $angl_msg; ?> </div><?php 
                $_SESSION['msg'] = null;
            }
            if(isset($angl_err)){ 
                echo "<hr noshade   style = \"height: 3px;\">";
            ?><div class="alert alert-danger" role="alert"> <?php echo $angl_err; ?> </div><?php
            $_SESSION['err'] = null; 
            }
        }
          



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

        <form  action ="question_editor_delet.php" method="post" style="width: 100%; ">
            <div class="container" style= "background-color: #C0C0C0">
            
                <!--============ Питання №  =============-->
                <hr noshade   style = "height: 1px" >
                <div class="row">
                    <div class="col-12">
                                                                                                                    <!--== [Виберіть один / декілька із варіантів]/[ Впишіть відповідь в поле]/[ Встановіть відповідність] ===-->
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
                                                                    <input onclick="click_edit(<?php echo $id_question ?>)" class="form-check-input" type="radio" name="exampleRadio"  value="<?php echo "$iter"; ?>" <?php if($iter == explode("\n#\n", $questionanswer)[1])echo "checked"; ?>>
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
                                                                    <input onclick="click_edit(<?php echo $id_question ?>)" class="form-check-input" type="checkbox" name="exampleсheckbox_<?php echo "$iter"; ?>"  value="1"  <?php if(in_array("$iter", explode("\n", explode("\n#\n", $questionanswer)[1])))echo "checked"; ?> >
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
                                                <input onclick="click_edit(<?php echo $id_question ?>)" class="form-control form-control-sm" type="text" name = "text_answ" value = "<?php echo explode("\n#\n", $questionanswer)[1]; ?>" readonly>
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

                    <div class="col-6" style="margin-top : 6px">
                        <label for="exampleFormControlSelect1"><h5>Кількість балів за <?php if($questiontype == "some")echo "кожну"; ?> привильну  відповідь: - <?php  echo "$questionball"; ?>  </h5></label>
                    </div>
                    
                    <div class="col-3" style="margin-top : 10px">
                        <label for="exampleFormControlSelect1"><h5> <?php if(isset($question_impot)){if($question_impot == 1){ echo "( Обов'язково! )"; }} ?> </h5></label>
                    </div>
                    
                    <form  action ="question_editor_delet.php" method="post">
                        <input type="hidden" name="id_test" value="<?php echo $test_id ?>">
                        <input type="hidden" name="id_question" value="<?php echo $id_question ?>">
                        <input type="hidden" name="counter" value="<?php echo $counter ?>">

                        <div class="col-1">
                            <input type="hidden" name="option" value="del">
                            <button class="btn btn-danger btn-primary btn-block" type="submit" style="height : 40px; width: 90px">Видалити</button>                                                                   
                        </div>

                    </form>

                    <form  action ="question_editor_delet.php" method="post">
                        <input type="hidden" name="id_test" value="<?php echo $test_id ?>">
                        <input type="hidden" name="id_question" value="<?php echo $id_question ?>">
                        <input type="hidden" name="counter" value="<?php echo $counter ?>">  

                        <div class="col-1">
                            <input type="hidden" name="option" value="ed">
                            <button id="btn_edit_<?php echo $id_question ?>" type="submit" class="btn btn-primary mb-2" style="height : 40px; width: 100px" name="save_quest" value = "<?php echo $test_id; ?>">Редагувати</button>                                                                   
                        </div>

                    </form>
                                                                                                                            
                </div>                   
                <!--========================================-->                  

            </div>
        </form>

        <br>

    <?php
    }
?>