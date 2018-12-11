
<?php
   
    require ('../conection_db.php');

    if(isset($_POST['testname'])){
        $testname    = $_POST['testname'];

        $query = "SELECT * FROM `tests` WHERE testname = '$testname'";
        $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
        $count = mysqli_num_rows($result);

        if($count > 0){
            $ecntmsg = "Данний тест вже існує. Введіть інше імя будь-ласка";
            header("Location: create_new_test.php");
            exit;
        }

        $query  = "INSERT INTO `tests` (`id_tets`, `testname`, `testputh`, `active`) VALUES (NULL, '$testname', 'tests/$testname.php', '1');";
        $result = mysqli_query($conection, $query) or die(mysqli_error($conection));

        if($result){
            echo "<h2> Тест '$testname' створено !</h2>";
           
            echo "<br> <a href= \"index.php\" > Повернутися до головної панелі</a>";

        }

    }

?>