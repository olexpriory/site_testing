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


    <div class="container">
        <form class="form-signin" action="index.php" method="post">
            <br><br><br>
            <h2 align="center">Авторизація</h2> 
            <br>

            <!--=========================== user mesage ============================-->
            <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?> 
            <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?> 
            <!--=====================================================================-->   
                 
            
            <input type="text" name="user_surname" class="form-control"   <?php if(isset($usersurname)) echo "value = \"$usersurname\""; else echo "placeholder=\"Прiзвище\" required";?> >
            <input type="text" name="user_name" class="form-control"   <?php if(isset($username)) echo "value = \"$username\""; else echo "placeholder=\"Iм'я\" required";?> >


         
            <?php
            if(isset($conterdata))
            {
              ?>
                    <!--== +++++++++++++ ==--> 
                    <?php if($conterdata > 0){ ?>
                        <input type="text" name="user_lastname" class="form-control" <?php if(isset($userlastname)) echo "value = \"$userlastname\""; else echo "placeholder=\"По батьковi\" required";?> >   
                    <?php } ?>

                    <?php if($conterdata > 1){ ?>
                        <select name='user_rung' class="form-control" required>
                        

                            <?php

                                if(isset($userrung_id)){
                                    $result = mysqli_query($conection, "SELECT * FROM `user_rung` WHERE id_rung = '$userrung_id'");
                                    echo "<option value = \"$userrung_id\" >". mysqli_fetch_array($result)['rungname'] . "</option> "; 
                                }
                                else echo "<option  value=\"\"> Звання </option>";
                                

                                $result = mysqli_query($conection, "SELECT * FROM `user_rung`");

                                while ($row = mysqli_fetch_array($result)){
                                    echo "<option value=' ".$row['id_rung']." '>".$row['rungname']."</option>";
                                }
                            ?>

                        </select>
                    <?php } ?>
                    
                    <?php if($conterdata > 2){ ?>
                        <!--============================== spiner ==============================-->
                            <input type="button" name="user_subdivision" class="form-control" value="Підрозділ" style="text-align:left">

                            <div style="width : 95%; margin-left: 30px;" >

                                <select name='subdivision_company' class="form-control" required >
                                    <option value=''>-- Рота № --</option>";

                                    <?php
                                        $result = mysqli_query($conection, "SELECT * FROM `company`");

                                        while ($row = mysqli_fetch_array($result)){
                                            echo "<option value=' ".$row['id_company']." '>".$row['companynumber']."</option>";
                                        }
                                    ?>

                                </select>

                                <select name='subdivision_platoon' class="form-control"  required >
                                    <option value=''>-- Взвод № --</option>";

                                    <?php
                                        $result = mysqli_query($conection, "SELECT * FROM `platoon`");

                                        while ($row = mysqli_fetch_array($result)){
                                            echo "<option value=' ".$row['id_platoon']." '>".$row['platoonnumber']."</option>";
                                        }
                                    ?>

                                </select>

                                <select name='subdivision_specialty' class="form-control" required >
                                    <option value=''>-- Спеціальність  --</option>";

                                    <?php
                                        $result = mysqli_query($conection, "SELECT * FROM `specialty`");

                                        while ($row = mysqli_fetch_array($result)){
                                            echo "<option value=' ".$row['id_specialty']." '>".$row['specialtyname']."</option>";
                                        }
                                    ?>

                                </select>


                            </div>           
                        <!--=====================================================================-->
                    <?php } ?>
                    <!--== +++++++++++++ ==-->  
            <?php
            }
               ?>

            

            <br><br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Почати</button>
        <!--<a href="login.php" class="btn btn-lg btn-primary btn-block">login</a>-->

    </form>    
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>