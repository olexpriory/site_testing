<h1 align="center"> Тести</h1>
<br><br>

<?php
    require ('../conection_db.php');

    $query = "SELECT * FROM `tests` WHERE active = 1";
    $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
    $count = mysqli_num_rows($result);

    if($count > 0)
    { 
                 
        for($iter = 0; $iter < $count; $iter++) {
            $row = mysqli_fetch_row($result);?>
        <!--================================= html code ===============================-->
        <p>
           <a href= "../view_test.php?id=<?php echo $row[0]; ?>" ><img src="../images/testicon.jpg" width="30" height="30" >
                <?php echo "$row[1]"?>  
            </a>  

            <a href= "crater_php_fie.php?id=<?php echo $row[0]; ?>" >  Редагувати  </a> 

            <a href= "delete_php_fie.php?id=<?php echo $row[0]; ?>" >  Видалити  </a> 
         </p>

        
        <!--============================================================================-->

    <?php } } else { ?>

        <!--================================= html code ===============================-->
        <br><br>
        <h2 style="color:red" >Відсутні активні тести.</h2>
        <br><br>
        <!--============================================================================-->
    <?php } ?>