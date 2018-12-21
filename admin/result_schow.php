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

if (isset($_POST['result_schow']) || isset($_POST['show_reload']) || isset($_POST['show_show']))
{
    echo "<h1> Ok!!! </h1>";

    $ck_subdiw_com = isset($_POST['ck_subdiw_com']);
    $ck_subdiw_plat = isset($_POST['ck_subdiw_plat']);
    $ck_subdiw_spec = isset($_POST['ck_subdiw_spec']);

    $ck_user_surname = isset($_POST['ck_user_surname']);
    $ck_user_name  = isset($_POST['ck_user_name']);
    $ck_user_lastname = isset($_POST['ck_user_lastname']);

    $ck_date = isset($_POST['ck_date']);
    $ck_time = isset($_POST['ck_time']);

    

    $rezon = false;


    if($ck_subdiw_com)
        if(isset($_POST['subdiw_com'])){
            $company_id =  $_POST['subdiw_com'];
            $rezon = true;
        }
            
             
    if($ck_subdiw_plat)
        if(isset($_POST['subdiw_plat'])){
            $platoon_id = $_POST['subdiw_plat'];
            $rezon = true;
        }
            
      
    if($ck_subdiw_spec)
        if(isset($_POST['ck_subdiw_spec'])){
            $specialty_id = $_POST['ck_subdiw_spec'];
            $rezon = true;
        }




        if( $ck_user_surname )
            if(isset($_POST['user_surname'])){
                $usersurname = $_POST['user_surname'];
                $rezon = true;
            }

        if( $ck_user_name )
            if(isset($_POST['user_name'])){
                $username = $_POST['user_name'];
                $rezon = true;
            }

        if( $ck_user_lastname )
            if(isset($_POST['user_lastname'])){
                $userlastname = $_POST['user_lastname'];
                $rezon = true;
            }



    $query_main = "SELECT * FROM `users` ";
    
    if($rezon){
        $query_main .= " WHERE ";

        $rezon = false;

        if(isset($company_id)){
            $query_main .= $rezon? " and " : "";
            $query_main .= "company_id = $company_id " ;
            $rezon_main = true;
        } 
        if(isset($platoon_id)){
            $query_main .= $rezon? " and " : "";
            $query_main .= "company_id = $platoon_id ";
            $rezon_main = true;
        } 
        if(isset($specialty_id)){
            $query_main .= $rezon? " and " : "";
            $query_main .= "company_id = $specialty_id ";
            $rezon_main = true;
        }
        if(isset($usersurname)){
            $buf = $query_main;
            $buf .=  $rezon? " and " : "";
            $buf .= "usersurname = $usersurname ";

            $res = mysqli_query($conection, $buf);
            if(mysqli_num_rows( $res ) > 0){
                $query_main .= $rezon? " and " : "";
                $query_main .= "usersurname = $usersurname ";
                $rezon_main = true;
            }else{
                $username = null;
            }
        }
        if(isset($username)){

            $buf = $query_main;
            $buf .=  $rezon? " and " : "";
            $buf .= "username = $username ";

            $res = mysqli_query($conection, $buf);
            if(mysqli_num_rows($res) > 0){
                $query_main .= $rezon? " and " : "";
                $query_main .= "username = $username ";
                $rezon_main = true;
            }else{
                $username = null;
            }
        }
        if(isset($userlastname)){
            $buf = $query_main;
            $buf .=  $rezon? " and " : "";
            $buf .= "userlastname = $userlastname ";

            $res = mysqli_query($conection, $buf);
            if(mysqli_num_rows($res) > 0){
                $query_main .= $rezon? " and " : "";
                $query_main .= "userlastname = $userlastname ";
                $rezon_main = true;
            }
            else{
                $userlastname = null;
            }
        } 


    } 

     
    $result = mysqli_query($conection, $query_main) or die(mysqli_error($conection));
    $count = mysqli_num_rows($result);
    echo "count = $count";


    //$itr = 0;

   

   // while ($row = mysqli_fetch_array($result)){
   //     echo $row['id_user'] . "<br>";
   //     $id_users_arr[$itr++] = $row['id_user'];
  //  }

  // foreach($id_users_arr as $id_us){
  //      echo "<h5>$id_us</h5>";
  // }
    

}
else
{
    echo "<h1> Помилка!!! </h1>";

    echo $_POST['show_reload'];
    echo $_POST['show_show'];
    echo $_POST['result_schow'];
    exit;             
}



?>

<br>
   

        <form action="result_schow.php" method="POST" style="width:100%;  ">
            <div class="container" style= "background-color: #C0C0C0; width:100%; height:260px">



                <div class="row" style="width:100%; height:20px ">
                </div>  

                <div class="row" style="width:100%;">

                    <div class="col-2">
                        <label for="exampleFormControlSelect1"> Підрозділ </label>
                    </div>



                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 10px; margin-left : 60px;">                                
                            <input   onclick="click_check('subdiw_com') "class="form-check-input" type="checkbox"  name ="ck_subdiw_com" id="check_subdiw_com" value="1" <?php if($ck_subdiw_com) echo"checked"; ?>>                                                            
                        </div>                                                                         
                    </div>

                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;"> 

                            <select id = "subdiw_com" name='subdiw_com' class="form-control"  style="display:none"   >
                                <!--<option value=""> Рота </option> -->
                                <?php

                                        if(isset($company_id)){
                                            $result = mysqli_query($conection, "SELECT * FROM `company` WHERE id_company = '$company_id'");
                                            echo "<option value = \"$company_id\" >". mysqli_fetch_array($result)['companynumber'] . "</option> "; 
                                        }
                                        else echo "<option  value=\"\">-- Рота № --</option>";

                                        $result = mysqli_query($conection, "SELECT * FROM `company`");

                                        while ($row = mysqli_fetch_array($result)){
                                            echo "<option value=' ".$row['id_company']." '>".$row['companynumber']."</option>";
                                        }
                                ?>
                            </select> 

                            <input id = "subdiw_com_mask" class="form-control form-control-sm" type="text" style = "height:38px;"  value = "  Рота" readonly>

                        </div>
                    </div>



                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 10px; margin-left : 60px;">                                
                            <input  onclick="click_check('subdiw_plat')"  class="form-check-input" id="check_subdiw_plat" type="checkbox"  name="ck_subdiw_plat" value="1" <?php if($ck_subdiw_plat) echo"checked"; ?>>                                                              
                        </div>                                                                         
                    </div>

                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;">     
                            <select name='subdiw_plat' class="form-control" id="subdiw_plat" style="display:none" >
                                <!--<option value=""> Взвод </option>-->
                                <?php
                                                    
                                    if(isset($platoon_id)){
                                        $result = mysqli_query($conection, "SELECT * FROM `platoon` WHERE id_platoon = '$platoon_id'");
                                        echo "<option value = \"$platoon_id\" >". mysqli_fetch_array($result)['platoonnumber'] . "</option> "; 
                                    }
                                    else echo "<option  value=\"\">-- Взвод № --</option>";

                                    $result = mysqli_query($conection, "SELECT * FROM `platoon`");

                                    while ($row = mysqli_fetch_array($result)){
                                        echo "<option value=' ".$row['id_platoon']." '>".$row['platoonnumber']."</option>";
                                    }                                                                   
                                ?>
                            </select> 

                            <input id = "subdiw_plat_mask" class="form-control form-control-sm" type="text" style = "height:38px; "  value = "  Взвод" readonly>

                        </div>
                    </div>

                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 10px; margin-left : 60px;">                                
                            <input onclick="click_check('subdiw_spec')" class="form-check-input" type="checkbox" id="check_subdiw_spec"  name="ck_subdiw_spec" value="1" <?php if($ck_subdiw_spec) echo"checked"; ?>>                                                             
                        </div>                                                                         
                    </div>


                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;">     
                            <select name='subdiw_spec' class="form-control" id="subdiw_spec" style="display:none" >
                                <!--<option value=""> Спеціальність </option>-->
                                <?php
                                    
                                    if(isset($specialty_id)){
                                        $result = mysqli_query($conection, "SELECT * FROM `specialty` WHERE id_specialty = '$specialty_id'");
                                        echo "<option value = \"$specialty_id\" >". mysqli_fetch_array($result)['specialtyname'] . "</option> "; 
                                    }
                                    else echo "<option  value=\"\">-- Спеціальність --</option>";

                                    $result = mysqli_query($conection, "SELECT * FROM `specialty`");

                                    while ($row = mysqli_fetch_array($result)){
                                        echo "<option value=' ".$row['id_specialty']." '>".$row['specialtyname']."</option>";
                                    } 

                                ?>
                            </select>  

                            <input id="subdiw_spec_mask" class="form-control form-control-sm" type="text" style = "height:38px; "  value = "  Спеціальність" readonly>

                        </div>
                    </div>
                    
                </div>

                <div class="row" style="width:100%;">

                    <div class="col-2">
                        <label for="exampleFormControlSelect1"> Користувач </label>
                    </div>

                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 10px; margin-left : 60px;">                                
                            <input id="check_user_surname" onclick="click_check('user_surname')" class="form-check-input" type="checkbox"  name="ck_user_surname" value="1" <?php if($ck_user_surname) echo"checked"; ?>>                                                             
                        </div>                                                                         
                    </div>

                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;">     
                            <select id="user_surname" name='user_surname' class="form-control" id="exampleFormControlSelect1" style="display:none"  >
                                <!--<option value=""> Прізвище </option>-->
                                <?php
                                        if(isset($usersurname)){                                           
                                            echo "<option value = \"$usersurname\" >". $usersurname . "</option> "; 
                                        }
                                        else echo "<option  value=\"\">-- Прізвище --</option>";
    
                                        $query_sun = $query_main;
                                        $query_sun .= " GROUP BY usersurname";
                                        $res = mysqli_query($conection, $query_sun);                                      

                                        while ($row = mysqli_fetch_array($res)){
                                            echo "<option value=' ".$row['usersurname']." '>".$row['usersurname']."</option>";
                                        }
    
                                                                                                        
                                ?>
                            </select>   

                            <input id="user_surname_mask" class="form-control form-control-sm" type="text" style = "height:38px;"  value = "  Прізвище" readonly>

                        </div>
                    </div>

                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 10px; margin-left : 60px;">                                
                            <input id="check_user_name" onclick="click_check('user_name')" class="form-check-input" type="checkbox"  name="ck_user_name" value="1" <?php if($ck_user_name) echo"checked"; ?>>                                                               
                        </div>                                                                         
                    </div>

                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;">     
                            <select id="user_name" name='cont_quest' class="form-control" id="exampleFormControlSelect1" style="display:none"   >
                                <option value=""> Ім'я </option>
                                <?php
                                    if(isset($username)){                                           
                                        echo "<option value = \"$username\" >". $username . "</option> "; 
                                    }

                                    $query_sun = $query_main;
                                    $query_sun .= " GROUP BY username";
                                    $res = mysqli_query($conection, $query_sun);                                      

                                    while ($row = mysqli_fetch_array($res)){
                                        echo "<option value=' ".$row['username']." '>".$row['username']."</option>";
                                    }
                                                                                                            
                                ?>
                            </select> 

                            <input id="user_name_mask" class="form-control form-control-sm" type="text" style = "height:38px;"  value = "  Ім'я" readonly>

                        </div>
                    </div>

                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 10px; margin-left : 60px;">                                
                            <input id="check_user_lastname" onclick="click_check('user_lastname')" class="form-check-input" type="checkbox"  name="ck_user_lastname" value="1" <?php if($ck_user_lastname) echo"checked"; ?>>                                                          
                        </div>                                                                         
                    </div>


                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;">     
                            <select id="user_lastname" name='cont_quest' class="form-control" id="exampleFormControlSelect1" style="display:none" >
                                <option value=""> По батькові </option>
                                <?php
                                        if(isset($userlastname)){                                           
                                            echo "<option value = \"$userlastname\" >". $userlastname . "</option> "; 
                                        }
    
                                        $query_sun = $query_main;
                                        $query_sun .= " GROUP BY userlastname";
                                        $res = mysqli_query($conection, $query_sun);                                      
    
                                        while ($row = mysqli_fetch_array($res)){
                                            echo "<option value=' ".$row['userlastname']." '>".$row['userlastname']."</option>";
                                        }                                                                    
                                ?>
                            </select>  

                            <input id="user_lastname_mask" class="form-control form-control-sm" type="text" style = "height:38px;"  value = "  По батькові" readonly>

                        </div>
                    </div>


                    
                </div>

                <div class="row" style="width:100%;">


                    <div class="col-2">
                        <label for="exampleFormControlSelect1">Дата / час</label>
                    </div>


                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 10px; margin-left : 60px;">                                
                            <input id="check_date" onclick="click_check('date')" class="form-check-input" type="checkbox"  name="ck_date" value="1" <?php  if($ck_user_lastname) echo"checked"; ?>>            
                        </div>                                                                         
                    </div>

                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;">     
                            <select id="date" name='cont_quest' class="form-control" id="exampleFormControlSelect1" style="display:none" >
                                <!--<option value=""> Дата </option>-->
                                <?php
                                                         
                                                         if(isset($date)){                    
                                                            echo "<option value = \"$date\" >". $date . "</option> "; 
                                                        }
                                                        else echo "<option  value=\"\">-- Дата --</option>";     
                    
                                                        $result = mysqli_query($conection, "SELECT * FROM `result_user_test` GROUP BY dateteusing");
                    
                                                        while ($row = mysqli_fetch_array($result)){
                                                            echo "<option value=' ".$row['idateteusing']." '>".$row['dateteusing']."</option>";
                                                        }                                    
                                ?>
                            </select> 

                            <input id="date_mask" class="form-control form-control-sm" type="text" style = "height:38px;"  value = "  Дата" readonly>

                        </div>
                    </div>



                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 10px; margin-left : 60px;">                                
                            <input id="check_time" onclick="click_check('time')" class="form-check-input" type="checkbox"  name="ck_time" value="1" <?php if($ck_time) echo"checked"; ?>> 
                        </div>                                                                         
                    </div>

                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;">     
                            <select id="time" name='cont_quest' class="form-control" id="exampleFormControlSelect1" style="display:none" >
                                <option value=""> Час від </option>
                                <?php
                                                                      
                                ?>
                            </select>

                            <input id="time_mask" class="form-control form-control-sm" type="text" style = "height:38px;"  value = "  Час від" readonly>

                        </div>
                    </div>
           
                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 4px; ">                                
                           
                        </div>                                                                         
                    </div>

                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;">     
                            <select id="time_2" name='cont_quest' class="form-control" id="exampleFormControlSelect1" style="display:none" >
                                <option value=""> Час до </option>
                                <?php
                                    
                                    
                                    
                                ?>
                            </select>

                            <input id="time_mask_2" class="form-control form-control-sm" type="text" style = "height:38px;"  value = "  Час до" readonly>

                        </div>
                    </div>  



                </div>





                <div class="row" style="width:100%;">
                                
                    <div class="col-12" style="margin-top: 4px;">                                                     
                        <button  class="btn btn-lg btn-primary btn-block" name ="show_reload" value="1" type="submit">reload</button> 

                        <button  class="btn btn-lg btn-primary btn-block" name ="show_show" value="1" type="submit">Відобразити результат</button>                     
                    </div>

                </div>
                         
                                   
                
            </div>
        </form>



        <div class="container" style= "background-color: #C0C0C0; margin-top:100px;">
            
            <hr noshade   style = "height: 1px" >

            <div class="row">              

                <div class="col-1">                                                                                                                   <!--== [Виберіть один / декілька із варіантів]/[ Впишіть відповідь в поле]/[ Встановіть відповідність] ===-->
                    <label for="exampleFormControlSelect1" ><h5 style = "display : inline">  SHOW </label>
                </div>
                                  
            </div>
        </div>


        <script>


            window.onload = function() {

                click_check('subdiw_com');
                click_check('subdiw_plat');
                click_check('subdiw_spec');

                click_check('user_surname');
                click_check('user_name');
                click_check('user_lastname');

                click_check('date');
                click_check('time');            

            };

                    function click_check(id)
                    {
                       
                        check = document.getElementById(`check_${id}`);
                                             
                        if(check.checked){

                            document.getElementById(`${id}`).style.display = "";
                            document.getElementById(`${id}_mask`).style.display = "none";

                            if(id == "time"){
                                document.getElementById(`${id}_2`).style.display = "";
                                document.getElementById(`${id}_mask_2`).style.display = "none";
                            }

                        }else{
                            document.getElementById(`${id}`).style.display = "none";
                            document.getElementById(`${id}_mask`).style.display = "";

                            if(id == "time"){
                                document.getElementById(`${id}_2`).style.display = "none";
                                document.getElementById(`${id}_mask_2`).style.display = "";
                            }
                        }
                            
                    }

        </script>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>