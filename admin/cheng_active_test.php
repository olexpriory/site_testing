<?php
require ('../conection_db.php');

if (isset($_GET['id']))
{
    $test_id = $_GET['id'];

    $value = (mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['active'] == "1") ? 0 : 1;

    if( !mysqli_query($conection, "UPDATE `tests` SET `active` = '$value' WHERE `tests`.`id_test` = '$test_id' "))
    {
        $testname = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['testname'];
        session_start();
        //$_SESSION['user_err'] = "UPDATE `test` SET `active` = '$value' WHERE `tests`.`id_test` = '$test_id' ";
        $_SESSION['user_err'] = "Помилка змінення активності тесту '$testname'";
    }

    header("Location: index.php");

        
}
else
{
    echo "<h1> Помиилка \"Пустий набір даних\"  </h1>";
    echo "неможливо відкрити файл \"cheng_active_test.php\" для интерпритації<br>";   
    exit; 
}

?>