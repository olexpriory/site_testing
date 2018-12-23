
<h1 align="center"> Тести</h1>
<br>

<?php
    require ('../conection_db.php');

    $query = "SELECT * FROM `tests`";
    $result = mysqli_query($conection, $query) or die(mysqli_error($conection));
    $count = mysqli_num_rows($result);

    if($count > 0)
    { 
       
        echo"<hr noshade   style = \"height: 3px; width:99%; margin-left : 8px;\"> ";
        echo"<div class=\"container\">";

                while ($row = mysqli_fetch_array($result))
                {
                    $test_id = $row['id_test'];
                    $action = (mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = '$test_id' "))['active'] == "1") ? true : false;

                    ?>
                        <!-- ================= show test info ============= -->
                        <div class="row" style="width:87%">

                            <div class="col-6">
                                <a href= "../view_test.php?id=<?php echo $row['id_test']; ?>" ><img src="../images/testicon.jpg" width="30" height="30" ><?php echo $row['testname'];?></a>
                            </div>

                            <div class="col-2">
                                <a style="margin-left:50%;color: #FFD700"href= "create_test_basic.php?id=<?php echo $row['id_test']; ?>" >  Редагувати  </a>
                            </div>

                            <div class="col-2">
                                <a href= "delete_test.php?id=<?php echo $row['id_test']; ?>" style="color: maroon" > Видалити  </a>
                            </div>

                            <div class="col-2">
                                <a href= "cheng_active_test.php?id=<?php echo $row['id_test']; ?>" <?php if($action) echo "style=\"color: green\">Активний</a>"; else echo "style=\"color: red\"> Не активний</a>"; ?>
                            </div>

                        </div>
                        <!-- ============================================== -->

                        <div class="row"><hr noshade   style = "height: 1px; width:80%; margin-left:0"> </div> 

                    <?php 
                }
            
        echo"</div>";  
    }
    else 
    { 
        ?>

            <br><br>
            <h2 style="color:red" >Відсутні активні тести.</h2>
            <br><br>
        
        <?php 
    } 
?>