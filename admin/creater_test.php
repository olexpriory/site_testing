
<?php
   
    require ('../conection_db.php');
    

    if(isset($_POST['testname'])){
        $testname    = $_POST['testname'];

        $query = "SELECT * FROM `tests` WHERE testname = '$testname'";
        $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
        $count = mysqli_num_rows($result);

        if($count > 0){
            $ecntmsg = "Данний тест вже існує. Введіть інше імя будь-ласка";
            include 'create_new_test.php';
            exit;
        }


        $query  = " INSERT INTO `tests` (`id_test`, `testname`, `testputh`, `active`, `count_quest`, `sum_ball`, `include_impot`, `random`) 
                    VALUES (NULL, '$testname', NULL, '1', '0', NULL, '0', '0')";
                    
        $result = mysqli_query($conection, $query) or die(mysqli_error($conection));

        if($result){
            echo "<h2 >Новий тест '$testname'  !</h2>";        
           // echo "<br> <a href= \"index.php\" > Повернутися до головної панелі</a>";

            //=================================== Test crater ==========================================
                session_start();
                $test_id = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE testname = '$testname' "))['id_test'];
                $_SESSION['id_test'] = $test_id;
                include ('crater_php_fie.php');
             //================================= End test crater ========================================
        }
        else{
            echo "<h2> Помилка Збереження!</h2>";  
            return;
        }


    }

?>