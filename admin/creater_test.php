
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

        $query  = "INSERT INTO `tests` (`id_test`, `testname`, `testputh`, `active`) VALUES (NULL, '$testname', 'tests/$testname.php', '1');";
        $result = mysqli_query($conection, $query) or die(mysqli_error($conection));

        if($result){
            echo "<h2 >Новий тест '$testname'  !</h2>";        
           // echo "<br> <a href= \"index.php\" > Повернутися до головної панелі</a>";

        }
        else{
            echo "<h2> Помилка !</h2>";  
            return;
        }

        //==========================================================================================
        //=================================== Test crater ==========================================
        //==========================================================================================
            session_start();
            $_SESSION['testname'] = $testname;
            include ('crater_php_fie.php');

        //==========================================================================================
        //================================= End test crater ========================================
        //==========================================================================================

    }

?>