<?php

require ('../conection_db.php');

if (isset($_POST['nametable']))
{
    $tablename = (isset($_POST['nametable']) && $_POST['nametable'] != "" )? $_POST['nametable'] : null;

    $id_edit = (isset($_POST['edit_id']) && $_POST['edit_id'] != "" )? $_POST['edit_id'] : null;
    $id_del = (isset($_POST['del_id']) && $_POST['del_id'] != "" )? $_POST['del_id'] : null;
    $add = (isset($_POST['add']) && $_POST['add'] != "" )? $_POST['add'] : null;


    if(isset($id_edit) || isset($id_del) || isset($add))
    {
        // echo "id_edit = $id_edit <br>";
        // echo "id_del = $id_del <br>";
        // echo "add = $add <br>";

        if(isset($id_edit) || isset($add))
        {
            $result = mysqli_query($conection, "SELECT * FROM {$tablename}");
            $fields_num = mysqli_num_fields($result);

            $mask = isset($id_edit) ? "val_edit_" : "val_add_";

            for($i=0; $i<$fields_num; $i++)
            {
                $field = mysqli_fetch_field($result);
                $mass_name[$i] =  $field->name;

                if($i!= 0)
                {
                    $buf = $mask; 
                    $buf .= $i;
                    $mass_value[$i-1] = $_POST[$buf];
                   //echo "buf = "
                }
                

                
            }

            

            if(isset($id_edit)){
                $query  =  "UPDATE `$tablename` SET ";
                $it = 1;
                foreach($mass_value as $value){
                    $query  .=  $mass_name[$it] . " = " . "'$value'" ;
                    $query  .= ($it++ < count($mass_value)) ? " , " : " ";
                }

                $query  .=   " WHERE `$tablename`.`$mass_name[0]` = '$id_edit'";
                
            }
            else{

                $query  = "INSERT INTO `$tablename` (";
                $it = 1;
                foreach($mass_name as $name){
                    $query .= $name;
                    $query  .= ($it++ < count($mass_name)) ? " , " : " ";
                }

                $query  .= ") VALUES ( NULL, ";

                $it = 1;
                foreach($mass_value as $value){
                    $query .= "'$value'";
                    $query  .= ($it++ < count($mass_value)) ? " , " : " )";
                }

            }

           

         

            
        }
        else{
            $result = mysqli_query($conection, "SELECT * FROM {$tablename}");
            $field = mysqli_fetch_field($result);
            $id =  $field->name;

            $query = "DELETE FROM `$tablename` WHERE  $id = '$id_del'";         
        }

            //echo "query = |$query|";
            $result = mysqli_query($conection, $query) or die(mysqli_error($conection));

             session_start();
            if($result)              
                $_SESSION['gmsg'] = "Операвцію виконано!";
            else
                $_SESSION['gerr'] = "Операція ЗАБОРОНЕНА, або сталася непередбачувана помилка! <br> Будь-ласка зверніться до адміністратора!";
                
            header("Location: show_group.php");
           // exit;
        
    }

}
else
{
    echo "<h1> Помиилка \"Пустий набір даних\"  </h1>";
    echo "неможливо відкрити файл \"group_control.php\" для интерпритації<br>";   
    exit;             
}

echo "<h1>ERROR </h1>";

?>