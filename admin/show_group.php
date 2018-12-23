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
session_start();

    

    $tablename = (isset($_POST['nametable']) && $_POST['nametable'] != "" )? $_POST['nametable'] : null;
    $edit_id = (isset($_POST['edit']) && $_POST['edit'] != "" )? $_POST['edit'] : null;
    

?>
       
        <!--=================== button back main page ==================-->
        <div   style= " background-color: #8D94CC; height: 50px;">
        
            <div class="row"    >

                <div class="col-9">
                </div>

                <div class="col-3" style="margin-top: 10px; ">                                  
                    <a style=" margin-left: 80px;" href="index.php"  class="btn btn-primary btn-sm">Повернутися до  головної панелі</a>            
                </div>
                
            </div>
        </div>
        <!--========================================================-->

        <!--=========================== user mesage ============================-->
        <?php if(isset($_SESSION['gmsg'])){ ?><div class="alert alert-success" role="alert"> <?php echo $_SESSION['gmsg']; $_SESSION['gmsg'] = null; ?> </div><?php } ?> 
        <?php if(isset($_SESSION['gerr'])){ ?><div class="alert alert-danger" role="alert"> <?php echo $_SESSION['gerr']; $_SESSION['gerr'] = null; ?> </div><?php } ?> 
        <!--=====================================================================-->  

        <br>


        <div style = "width:100%; padding:10px">

            <?php

                echo "<br><h2>Рота</h2>";
                ShowTable('company', $conection, $edit_id, $tablename);

                echo "<br><h2>Взвод</h2>";
                ShowTable('platoon', $conection, $edit_id, $tablename);   
                
                echo "<br><h2>Спаціальність</h2>";
                ShowTable('specialty', $conection, $edit_id, $tablename);

                echo "<br><h2>Звання</h2>";
                ShowTable('user_rung', $conection, $edit_id, $tablename);

                echo "<br><h2>Користувачі</h2>";
                ShowTable('users', $conection, $edit_id, $tablename);

                //echo "<br><h2>Тести</h2>";
                //ShowTable('tests', $conection, $edit_id, $tablename);

                //echo "<br><h2>Результати</h2>";
                //ShowTable('result_user_test', $conection, $edit_id, $tablename);
        ?>

        </div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>


<?php
    function ShowTable($table, $conection, $id , $tablename)
    {  
        
        if(!isset($tablename) || $tablename != $table)
            $id = null;

        $result = mysqli_query($conection, "SELECT * FROM {$table}");
        $fields_num = mysqli_num_fields($result);

       

        echo "<form  action=\"group_control.php\" method=\"POST\">";
            echo "<table border='3'>";

            echo "<input name=\"nametable\" value = \"$table\"   type=\"hidden\"  >";
            
            echo "<tr>";
                for($i=0; $i<$fields_num; $i++)
                {
                    $field = mysqli_fetch_field($result);
                    echo "<td>{$field->name}</td>";
                }
                echo "<td>Редагувати</td>";
                echo "<td>Видалити</td>";
            echo "</tr>\n";

            $count = 0;
            while($row = mysqli_fetch_row($result))
            {
               


                echo "<tr>";
                //------------------------
                    if(!isset($id) || $id != $row[0] )
                    {
                        echo "<form  method=\"POST\">";
                        echo "</form>";
                        foreach($row AS $cell){
                            echo "<td bgcolor=\"#C0C0C0\">$cell</td>";
                        }
                            echo "<td><form  method=\"POST\">";
                            echo " <input name=\"nametable\" value = \"$table\"    type=\"hidden\"  >";
                            echo " <button name=\"edit\" value=\"$row[0]\"  class=\"btn btn-sm btn-warning btn-block\"  ><div style=\"margin-top:-10px;\"  >Edit</div></button> ";
                            echo "</form></td>";

                        echo "<td> <button name=\"del_id\" value=\"$row[0]\"  class=\"btn  btn-sm btn-danger btn-block\"  ><div style=\"margin-top:-10px;\"  >Del</div></button> </td>";                      
                    }
                    else{

                        for($itr = 0; $itr < $fields_num; $itr++){
                            $bf =  ($itr==0) ? "readonly value = \"auto\"" : "value = \"$row[$itr]\"";
                            echo "<td><input name=\"val_edit_$itr\" na class=\"form-control form-control-sm\" type=\"text\" ".$bf." ></td>";
                        }
                        echo "<td colspan=\"2\"> <button <button name=\"edit_id\" value=\"$row[0]\"  class=\"btn btn-sm btn-warning btn-block\"  style=\"height:30px;\"><div style=\"margin-top:-10px;\"  >edit</div></button> </td>";

                    }
                 //-------------------------
                 echo "</tr>\n";
               



            }

            echo "<tr>";
            for($itr = 0; $itr < $fields_num; $itr++){
                $bf =  ($itr==0) ? "readonly value = \"auto\"" : "";
                echo "<td><input name=\"val_add_$itr\" class=\"form-control form-control-sm\" type=\"text\" ".$bf." ></td>";
            }
            echo "<td colspan=\"2\"> <button <button name=\"add\" value=\"1\"  class=\"btn btn-sm btn-success btn-block\"  style=\"height:30px;\"><div style=\"margin-top:-10px;\"  >add</div></button> </td>";
            echo "</tr>\n";

        echo "</table>";
        echo "</form>";

        echo"<br><br>";
    }
?>