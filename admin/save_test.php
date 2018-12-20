<?php

require ('../conection_db.php');

if (isset($_POST['id_test']))
{
    session_start();
    $test_id =  $_POST['id_test'];
    $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];

    $count_quest =  isset($_POST['cont_quest'])  ? $_POST['cont_quest'] : 0;
    $include_impot = isset($_POST['include_impot'])  ? $_POST['include_impot'] : 0;
    $rundom =  isset($_POST['random'])  ? $_POST['random'] : 0;
    $show_result = isset($_POST['show_result'])  ? $_POST['show_result'] : 0;
    
    $query  = " UPDATE `tests` SET  `count_quest` = '$count_quest', `include_impot` = '$include_impot', `random` = '$rundom', `show_result` = $show_result WHERE `tests`.`id_test` = $test_id";
                    
    $result = mysqli_query($conection, $query) or die(mysqli_error($conection));

    if(isset($_POST['btn_save_test_name'])){
        if($_POST['btn_save_test_name'] == "cheng_impot"){
            $_SESSION['id_test'] = $test_id;
            $_SESSION['counter'] = 1;
            $_SESSION['msg'] = ($include_impot == "1") ? "Вімкнено обовязкові питання" : "Вимкнено обовязкові питання";
            $_SESSION['err'] = null;

            header("Location: crater_php_fie.php");
            exit;
        }
    }

    if($result)
    {
        $_SESSION['user_msg'] = "Збережено тест '$testname'";  
    }
    else{
        $_SESSION['user_err'] = "Помилка при збереженні тесту '$testname'";
    }

    header("Location: index.php");



}else
{
   echo "<h1> Помилка!!! </h1>";
   exit;
}

?>