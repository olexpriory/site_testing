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
    //CREATE TABLE `testrow`.`company` ( `id_company` INT NOT NULL AUTO_INCREMENT , `companynumber` INT(10) NOT NULL , `companyname` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , `companynote` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL , PRIMARY KEY (`id_company`)) ENGINE = InnoDB;
    //CREATE TABLE `testrow`.`platoon` ( `id_platoon` INT(5) NOT NULL AUTO_INCREMENT , `platoonnumber` INT NOT NULL , `platoonname` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , `platoonnote` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL , PRIMARY KEY (`id_platoon`)) ENGINE = InnoDB;
    //CREATE TABLE `testrow`.`specialty` ( `id_specialty` INT NOT NULL AUTO_INCREMENT , `specialtyname` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `specialtycode` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , `specialtynote` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL , PRIMARY KEY (`id_specialty`)) ENGINE = InnoDB
    //CREATE TABLE `testrow`.`subdivision` ( `id_subdivision` INT(11) NOT NULL AUTO_INCREMENT , `id_user` INT(11) NOT NULL , `id_company` INT(11) NOT NULL , `id_platoon` INT(11) NOT NULL , `id_specialty` INT(11) NOT NULL , PRIMARY KEY (`id_subdivision`)) ENGINE = InnoDB;


?>

