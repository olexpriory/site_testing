<?php

require ('../conection_db.php');

if (
        isset($_POST['id_test'])
        && isset($_POST['id_question'])
        && isset($_POST['counter'])
        && isset($_POST['option'])
    ) 
{   
    session_start();

    $id_quest = $_POST['id_question'];
    $_SESSION['id_test'] = $_POST['id_test'];
    $counter = $_POST['counter'];
    $_SESSION['counter'] =  $counter;

    if($_POST['option'] == "del")
    {
            
        if( mysqli_query($conection, "DELETE FROM `questions` WHERE  id_question = '$id_quest'")){         
            $_SESSION['msg'] = "Видалено питання! № ~$counter";
        }
        else{
            $_SESSION['err'] = "Помилка видалення! id = |" . $id_quest . "|";
        }



    }elseif($_POST['option'] == "ed"){

        $_SESSION['msg'] = "EDITTT питання!";

    }

    header("Location: create_test_basic.php#angl");

}else{
   echo "<h1> Помилка!!! </h1>";
   exit;
}
?>