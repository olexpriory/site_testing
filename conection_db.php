<?php
    try {
        require_once 'conection_db_config.php'; // подключаем конфиг
    } catch (Exception $e) {
        echo "Не удалось поключить файл конфигурации : 'conection_db_config.php'<br>". $e->getMessage();
        exit();
    }

   if( isset($conection) )
    mysqli_close($conection);

    $conection = mysqli_connect($host, $user, $password, $database); //подключаемся к бд
    mysqli_set_charset($conection, 'utf8');  // тараборщина???

    if ($conection->connect_errno) {
        echo "<br>=====================================================<br>";
        echo "Не удалось подключиться к MySQL: (" . $conection->connect_errno . ") " . $conection->connect_error;
        echo "<br>=====================================================<br><br><br>";
    }

    if( !$conection){
        $link = mysqli_connect($host, $user, $password) or die("<br><br><h1>Невозможно подключиться к MySQL!!!<h1><br><br> " . mysqli_error($link) . "<br><br>");
        echo "Подлючено к MySQL!!!<br>";
        echo "ТУТ Необходимо создать базу данных [$database]<br><br><br>";
        exit();
    }
   

    //CREATE TABLE `testrow`. ( `id_tets` INT(11) NOT NULL AUTO_INCREMENT , `testname` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `testputh` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `active` BOOLEAN NOT NULL , PRIMARY KEY (`id_tets`)) ENGINE = InnoDB
    //INSERT INTO `tests` (`id_tets`, `testname`, `testputh`, `active`) VALUES (NULL, 'test N 1', 'testN1', '1');
?>

