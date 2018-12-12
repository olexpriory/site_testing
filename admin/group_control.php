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
    
    if (isset($_POST['group']))
    {     
        require ('../conection_db.php');

        ShowTable('company', $conection);   
        
        ShowTable('platoon', $conection);   
        
        ShowTable('specialty', $conection);
     
    }


?>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>



<?php
    function ShowTable($table, $conection )
    {
        

        $result = mysqli_query($conection, "SELECT * FROM {$table}");
        $fields_num = mysqli_num_fields($result);

        echo "<h1>Table: {$table}</h1>";

        echo "<table border='3'>";

            // printing table headers
            echo "<tr>";
                for($i=0; $i<$fields_num; $i++)
                {
                    $field = mysqli_fetch_field($result);
                    echo "<td>{$field->name}</td>";
                }
            echo "</tr>\n";

            // printing table rows
            while($row = mysqli_fetch_row($result))
            {
                echo "<tr>";
                //------------------------
                    foreach($row AS $cell)
                        echo "<td>$cell</td>";
                //-------------------------
                echo "</tr>\n";
            }

        echo "</table>";

        echo"<br><br><br>";
    }
?>