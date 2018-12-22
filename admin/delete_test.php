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


    if(isset($_POST['Delete']))
    {

        $test_id = $_POST['Delete'];
        $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
        session_start();

        

        if(mysqli_num_rows(mysqli_query($conection, " SELECT * FROM `result_user_test` WHERE test_id = '$test_id'")) > 0) 
        {

            if(isset($_POST['swich_del']) && $_POST['swich_del'] != "")
            {

                if($_POST['swich_del'] == "1"){
                   $flag =  mysqli_query($conection, "DELETE FROM `result_user_test` WHERE  test_id = '$test_id'");
                }
                else{
                    $flag = true;
                }

                 if($flag && mysqli_query($conection, "DELETE FROM `tests` WHERE  id_test = '$test_id'")){
                     $_SESSION['user_msg'] = "Видалено тест '$testname'";
                 }
                 else{
                     $_SESSION['user_err'] = "Помилка видалення тесту '$testname'";
                 }
                    
                 header("Location: index.php");

            }
            else{
                echo "<br><h1 align=\"center\"> -- Будь-ласка виберіть дію! -- </h1><br>";
            }
        }
        else{
                if( mysqli_query($conection, "DELETE FROM `tests` WHERE  id_test = '$test_id'")){
                    $_SESSION['user_msg'] = "Видалено тест '$testname'";
                }
                else{
                    $_SESSION['user_err'] = "Помилка видалення тесту '$testname'";
                }
                    
                header("Location: index.php");
        }


    }
    else if(isset($_POST['Delete_out'])){

        $test_id = $_POST['Delete_out'];
        $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
        session_start();
        $_SESSION['user_msg'] = "Відміненно видалення тесту '$testname'";
        header("Location: index.php");

    }elseif (isset($_GET['id']))
    {
        $test_id =  $_GET['id'];  
        $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
        echo "<br><h1 align=\"center\"> Ви впевнені що хочите видалити тест '$testname'? </h1><br>";     
    }
    else
    {
        echo "<h1> Помилка DELETE!!! <h1>";
        exit;             
    }


   

?>

<form  class="form-signin"method="post">


    <?php if(mysqli_num_rows(mysqli_query($conection, " SELECT * FROM `result_user_test` WHERE test_id = '$test_id'")) > 0) {?>

        <div class="container" style=" background-color: #C0C0C0;  width : 60%; height : 270px;">

            <hr noshade   style = "height: 1px;"> 

            <div class="row">
                <div class="col-12">
                    <h3 align="center">Даний тест задіяний для відображення результатів!</h3>
                </div>
            </div>

            <hr noshade   style = "height: 1px;"> 

            <div class="row">
                <div class="col-12">
                    <h6 >Будь-ласка виберіть дію</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-1">                               
                    <div class="form-check" style=" margin-top : 0px; ">                                
                        <input class="form-check-input" type="radio" name="swich_del"  value="1" >                                                               
                    </div>                                                                         
                </div>

                <div class="col-11"style="margin-top: 0px;">
                    <label class="form-check-label" style="margin-left: 0px;" >
                    Видалити разом з Результатами !
                    </label>
                </div>   
            </div>

            <div class="row">
                <div class="col-1">                               
                    <div class="form-check" style=" margin-top : 0px; ">                                
                        <input class="form-check-input" type="radio" name="swich_del"  value="2" >                                                               
                    </div>                                                                         
                </div>

                <div class="col-11"style="margin-top: 0px;">
                    <label class="form-check-label" style="margin-left: 0px;" >
                        Видалити тільки тест (може пошкоджити відображенню рузультатів)!
                    </label>
                </div>   
            </div>


            <hr noshade   style = "height: 1px;"> 

    <?php } else { ?>

        <div class="container" style="">

    <?php }?>

            <div class="row">

                <div class="col-6">                                
                    <button class="btn btn-lg btn-primary btn-block"  name="Delete_out" value="<?php echo $test_id ?>" type="submit">Відміна</button>               
                </div>

                <div class="col-6">                                 
                    <button class="btn btn-danger btn-primary btn-block" name="Delete" value="<?php echo $test_id ?>" type="submit" style="height : 50px">Видалити</button>              
                </div>

            </div>

        </div>

</form>

<?php
    
?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>