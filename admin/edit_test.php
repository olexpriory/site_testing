<?php 

    require ('../conection_db.php');

    if (isset($_GET['id'])){

       $id_test =  $_GET['id'];
    }
    else{
        echo "<h1>Помилка відсутній 'id' </h1>";
        exit;
    }



//             $query = "SELECT * FROM `questions` WHERE test_id ='$test_id'";
//             $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
//             $count = mysqli_num_rows($result);

//             if($count > 0){
//                 while ($row = mysqli_fetch_array($result)){
//                     Showqvestions(  $row['id_question'],
//                                     $row['questiontype'], 
//                                     $row['questiontext'],
//                                     $row['questionanswer'],
//                                     $row['questionball'],
//                                     $row['questionimg'],
//                                     $row['questionnecessarily'],
//                                     $row['test_id']);
//                 }
//             }


            



 ?>


 <?php
//     function Showqvestions( 
//                             $id_question,
//                             $questiontype, 
//                             $questiontext,
//                             $questionanswer,
//                             $questionball,
//                             $questionimg,
//                             $questionnecessarily,
//                             $test_id 
//                           )
//     {  

//         echo "<br> <hr noshade   style = \"height: 3px;\"> ";

//         $answer = "empty";
//         if($questiontype == "only"){
//             echo "<br> Виберіть один із варіантів відповідей! <br>";
//             $answer = "radio button 1";
//         }elseif($questiontype == "some"){
//             echo "<br> Виберіть декілька варіантів відповідей! <br>";
//             $answer = "radio button some";
//         }elseif($questiontype == "text"){
//             $answer = "<input type=\"text\" name=\"user_lastname\" class=\"form-control\"></input><p>";
//             echo "<br> Впишіть відповідь в поле! <br>";
//         }elseif($questiontype == "ratio"){
//             echo "<br> Встановіть відповідність <br>";
//         }

//         echo "<br><br><p><h4>$questiontext</h4></p><br><br>";
//         echo "$answer";

//         echo "<br> <hr noshade   style = \"height: 3px;\"> ";

//     }
?>