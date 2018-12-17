
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
     
     require ('../conection_db.php');

    if (isset($_GET['id']))
    {
        $test_id =  $_GET['id'];
        $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
    }
     elseif(isset($_SESSION['testname']))
    {
        $testname = $_SESSION['testname'];
        $test_id = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE testname = '$testname' "))['id_test'];
    }          
    elseif (isset($_POST['create_file'])) 
    {
        $test_id =  $_POST['create_file'];
        $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
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
                while ($row = mysqli_fetch_array($result)){
                    Showqvestions(  $row['id_question'],
                                    $row['questiontype'], 
                                    $row['questiontext'],
                                    $row['questionanswer'],
                                    $row['questionball'],
                                    $row['questionimg'],
                                    $row['questionnecessarily'],
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
                $_SESSION['user_msg'] = "Створено новий тест '$testname'";
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
                            <form action="" method="post" style="width: 100%; ">
                                <div class="container" style= "background-color: #C0C0C0">

                                        <hr noshade   style = "height: 1px" >    
                                        <div class="row">

                                                <div class="col-6">
                                                    <label for="exampleFormControlSelect1">Тип питання</label>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">     
                                                        <select class="form-control" id="exampleFormControlSelect1" >
                                                            <option>Одиночний</option>
                                                            <option>Вибірковий</option>
                                                            <option>Текстове поле</option>
                                                            <option>Співвідношення</option>
                                                        </select>                               
                                                    </div>
                                                </div>
                                                
                                        </div>
                                        
                                        <hr noshade   style = "height: 1px" >         
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Текcт питання</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>   
                                            </div>

                                        </div>

                                        <hr noshade   style = "height: 1px" >
                                        <div class="row">

                                            <div class="col-6">
                                                <label for="exampleFormControlSelect1">Кількість відповідей</label>
                                            </div>

                                            <div class="col-6">
                                                    <div class="form-group">                  
                                                        <select class="form-control" id="exampleFormControlSelect1">
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

                                        <hr noshade   style = "height: 1px" >
                                        <div class="row">

                                            <div class="col-12">
                                                    
                                                <label for="exampleFormControlSelect1"><h5>Відповіді : </h5></label>
                                                <br>

                                                <div class="container">
                                    
                                                    <div class="row">

                                                        <div class="col-1">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                                <label class="form-check-label" for="exampleRadios1">
                                                                    №1
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-11">
                                                            <input class="form-control form-control-sm" type="text" placeholder="">
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-1">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                                <label class="form-check-label" for="exampleRadios1">
                                                                    №2
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-11">
                                                            <input class="form-control form-control-sm" type="text" placeholder="">
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
                                                    <input class="form-control form-control-sm" type="text" placeholder="">                                                                   
                                                </div>

                                                <div class="col-3">
                                                    <label class="form-check-label" for="defaultCheck1" style=" margin-left : 70px; " >
                                                        обов'язково
                                                    </label>
                                                </div>

                                                <div class="col-1">                               
                                                    <div class="form-check" style=" margin-top : 6px; ">                                
                                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">                                                               
                                                    </div>                                                                         
                                                </div>

                                                <div class="col-3">
                                                    <button type="submit" class="btn btn-primary mb-2" style="margin: 2%">Зберегти питання</button>                                                                   
                                                </div>
                                                
                                        </div>

                                </div>
                            </form>
                        </h4>
                    </div>

                </div>                      
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
                            $id_question,
                            $questiontype, 
                            $questiontext,
                            $questionanswer,
                            $questionball,
                            $questionimg,
                            $questionnecessarily,
                            $test_id 
                          )
    {  

        echo "<br> <hr noshade   style = \"height: 3px;\"> ";

        $answer = "empty";
        if($questiontype == "only"){
            echo "<br> Виберіть один із варіантів відповідей! <br>";
            $answer = "radio button 1";
        }elseif($questiontype == "some"){
            echo "<br> Виберіть декілька варіантів відповідей! <br>";
            $answer = "radio button some";
        }elseif($questiontype == "text"){
            $answer = "<input type=\"text\" name=\"user_lastname\" class=\"form-control\"></input><p>";
            echo "<br> Впишіть відповідь в поле! <br>";
        }elseif($questiontype == "ratio"){
            echo "<br> Встановіть відповідність <br>";
        }

        echo "<br><br><p><h4>$questiontext</h4></p><br><br>";
        echo "$answer";

        echo "<br> <hr noshade   style = \"height: 3px;\"> ";

    }
?>