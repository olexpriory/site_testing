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
    

    $ck_subdiw_com = isset($_POST['ck_subdiw_com']);
    $ck_subdiw_plat = isset($_POST['ck_subdiw_plat']);
    $ck_subdiw_spec = isset($_POST['ck_subdiw_spec']);

    $ck_user_surname = isset($_POST['ck_user_surname']);
    $ck_user_name  = isset($_POST['ck_user_name']);
    $ck_user_lastname = isset($_POST['ck_user_lastname']);

    $ck_date = isset($_POST['ck_date']);
    $ck_time = isset($_POST['ck_time']);

    if(isset($_POST['tests']))
    $testname =  $_POST['tests'];

    if($ck_date ){
        $date = $_POST['date'];

        if($date != "")
        {
            $query = "SELECT * FROM `result_user_test` WHERE dateteusing = '$date'";
            $result = mysqli_query($conection, $query) or die(mysqli_error($conection));

            $itt = 0;

            while ($row = mysqli_fetch_array($result)){
                $test_arr[$itt++] = $row['test_id'] ;           
            }

            $test_arr = array_unique($test_arr);
        }
        
    }

   

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
            $specialty_id = $_POST['subdiw_spec'];        
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

        if(isset($company_id) && $company_id != ""){
            $query_main .= $rezon? " and " : "";
            $query_main .= "company_id = $company_id " ;
            $rezon = true;
        } 
        if(isset($platoon_id ) && $platoon_id != "" ){
            $query_main .= $rezon? " and " : "";
            $query_main .= "platoon_id = $platoon_id ";
            $rezon = true;
        } 
        if(isset($specialty_id ) && $specialty_id != "" ){
            $query_main .= $rezon? " and " : "";
            $query_main .= "specialty_id = '$specialty_id' ";
            $rezon = true;
        }

        

        if(isset($usersurname)){
            $buf = $query_main;
            $buf .=  $rezon? " and " : "";
            $buf .= "usersurname = '$usersurname' ";

            $res = mysqli_query($conection, $buf);          
            if(mysqli_num_rows( $res ) > 0){
                $query_main .= $rezon? " and " : "";
                $query_main .= "usersurname = '$usersurname' ";
                $rezon = true;
            }else{
                $usersurname = null;
            }
        }



        if(isset($username)){

            $buf = $query_main;
            $buf .=  $rezon? " and " : "";
            $buf .= "username = '$username' ";

            $res = mysqli_query($conection, $buf);           
            if(mysqli_num_rows($res) > 0){
                $query_main .= $rezon? " and " : "";
                $query_main .= "username = '$username' ";
                $rezon = true;
            }else{
                $username = null;
            }
        }
        if(isset($userlastname)){
            $buf = $query_main;
            $buf .=  $rezon? " and " : "";
            $buf .= "userlastname = '$userlastname' ";

            $res = mysqli_query($conection, $buf);           
            if(mysqli_num_rows($res) > 0){
                $query_main .= $rezon? " and " : "";
                $query_main .= "userlastname = '$userlastname' ";
                $rezon = true;
            }
            else{
                $userlastname = null;
            }
        } 


    } 

   

    if($query_main == "SELECT * FROM `users`  WHERE ")
        $query_main = "SELECT * FROM `users`";

       

    $result = mysqli_query($conection, $query_main) or die(mysqli_error($conection));
    $count = mysqli_num_rows($result);
    echo "count = $count";


    

    


    $itr = 0;
    while ($row = mysqli_fetch_array($result)){
       // echo $row['id_user'] . "<br>";
        $id_users_arr[$itr++] = $row['id_user'];
    }

   

 
    

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
            <div class="container" style= "background-color: #C0C0C0; width:100%; height:285px">

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

                            <select onchange="click_reload()" id = "subdiw_com" name='subdiw_com' class="form-control"  style="display:none"   >
                                <!--<option value=""> Рота </option> -->
                                <option value="">-- Рота № --</option>
                                <?php
                         
                                        $result = mysqli_query($conection, "SELECT * FROM `company`");

                                        while ($row = mysqli_fetch_array($result))
                                        {
                                            $str =  "<option value='".$row['id_company']."'";                                           
                                            if(isset($company_id)){
                                                if($company_id == $row['id_company']){
                                                    $str .= " selected";
                                                }
                                            }
                                            $str .= ">".$row['companynumber']."</option>";
                                            echo $str;
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
                            <select onchange="click_reload()" name='subdiw_plat' class="form-control" id="subdiw_plat" style="display:none" >
                                <!--<option value=""> Взвод </option>-->
                                <option  value="">-- Взвод № --</option>
                                <?php

                                    $result = mysqli_query($conection, "SELECT * FROM `platoon`");

                                    while ($row = mysqli_fetch_array($result))
                                    {
                                        $str = "<option value='".$row['id_platoon']."'";
                                        if(isset($platoon_id)){
                                            if($platoon_id == $row['id_platoon'])
                                            $str .= " selected";
                                        }
                                        $str .= ">".$row['platoonnumber']."</option>";
                                        echo $str;
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
                            <select onchange="click_reload()" name='subdiw_spec' class="form-control" id="subdiw_spec" style="display:none" >
                                <!--<option value=""> Спеціальність </option>-->
                                <option  value="">-- Спеціальність --</option>
                                <?php

                                    $result = mysqli_query($conection, "SELECT * FROM `specialty`");

                                    while ($row = mysqli_fetch_array($result))
                                    {
                                        $str =  "<option value='".$row['id_specialty'] . "'";
                                        if(isset($specialty_id)){
                                            if($specialty_id == $row['id_specialty'])
                                            $str .= " selected";
                                        }
                                        $str .= ">".$row['specialtyname']."</option>";
                                        echo $str;
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
                            <select onchange="click_reload()" id="user_surname" name='user_surname' class="form-control" id="exampleFormControlSelect1" style="display:none"  >
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
                                            echo "<option value='".$row['usersurname']."'>".$row['usersurname']."</option>";
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
                            <select onchange="click_reload()" id="user_name" name='user_name' class="form-control" id="exampleFormControlSelect1" style="display:none"   >
                                <!--<option value=""> Ім'я </option>-->
                                <?php
                                    if(isset($username)){                                           
                                        echo "<option value = \"$username\" >". $username . "</option> "; 
                                    }
                                    else echo "<option  value=\"\">-- Ім'я --</option>";

                                    $query_sun = $query_main;
                                    $query_sun .= " GROUP BY username";
                                    $res = mysqli_query($conection, $query_sun);                                      

                                    while ($row = mysqli_fetch_array($res)){
                                        echo "<option value='".$row['username']."'>".$row['username']."</option>";
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
                            <select onchange="click_reload()" id="user_lastname" name='user_lastname' class="form-control" id="exampleFormControlSelect1" style="display:none" >
                                <!--<option value=""> По батькові </option>-->
                                <?php
                                        if(isset($userlastname)){                                           
                                            echo "<option value = \"$userlastname\" >". $userlastname . "</option> "; 
                                        }
                                        else echo "<option  value=\"\">-- По батькові --</option>";
    
                                        $query_sun = $query_main;
                                        $query_sun .= " GROUP BY userlastname";
                                        $res = mysqli_query($conection, $query_sun);                                      
    
                                        while ($row = mysqli_fetch_array($res)){
                                            echo "<option value='".$row['userlastname']."'>".$row['userlastname']."</option>";
                                        }                                                                    
                                ?>
                            </select>  

                            <input id="user_lastname_mask" class="form-control form-control-sm" type="text" style = "height:38px;"  value = "  По батькові" readonly>

                        </div>
                    </div>


                    
                </div>

                <div class="row" style="width:100%; height:60px">


                    <div class="col-2">
                        <label for="exampleFormControlSelect1">Дата проведення</label>
                    </div>


                    <div class="col-1">                               
                        <div class="form-check" style=" margin-top : 10px; margin-left : 60px;">                                
                            <input id="check_date" onclick="click_check('date')" class="form-check-input" type="checkbox"  name="ck_date" value="1" <?php  if($ck_date) echo"checked"; ?>>            
                        </div>                                                                         
                    </div>

                    <div class="col-2">
                        <div class="form-group" style="margin-top: 4px;">     
                            <select onchange="click_reload()" id="date" name='date' class="form-control" id="exampleFormControlSelect1" style="display:none" >
                                <!--<option value=""> Дата </option>-->
                                <option value=""> Дата </option>
                                <?php
                                                         
                                                            
                    
                                                        $query = "SELECT * FROM `result_user_test` ";

                                                        if(isset($testname) && $testname != ""){
                                                            $id_test = mysqli_fetch_array( mysqli_query($conection, "SELECT * FROM `tests` WHERE  testname = '$testname'"))['id_test'];
                                                            $query .= " WHERE test_id = '$id_test' ";
                                                        }

                                                        $query .= " GROUP BY dateteusing";

                                                        $result = mysqli_query($conection, $query);
                    
                                                        while ($row = mysqli_fetch_array($result)){

                                                           $str = "<option value='".$row['dateteusing'] . "' ";

                                                           if(isset($date)){
                                                                if($date == $row['dateteusing'])
                                                                    $str .= " selected"; 
                                                           }
                                                           
                                                           $str .= ">" . $row['dateteusing']."</option>";

                                                           echo  $str;

                                                        }                                    
                                ?>
                            </select> 

                            <input id="date_mask" class="form-control form-control-sm" type="text" style = "height:38px;"  value = "  Дата" readonly>

                        </div>
                    </div>

                    <div class="col-1">
                        <label style="margin-top: 10px; margin-left: 20px; "for="exampleFormControlSelect1">Тести</label>
                    </div>



                    <div class="col-5" style="margin-top: 4px;"> 
                        <select onchange="click_reload()" id = "tests" name='tests' class="form-control"     >
                                <!--<option value=""> Всі тести </option> -->
                                <option value=""> Всі тести </option>
                                <?php

                                        if(!isset($test_arr)){
                                            $result = mysqli_query($conection, "SELECT * FROM `tests`");

                                            while ($row = mysqli_fetch_array($result))
                                            {
                                                $str = "<option value='" . $row['testname'] . "' ";

                                                if(isset($testname)){
                                                    if($testname == $row['testname']){
                                                        $str .= " selected";                                                      
                                                    }
                                                }

                                                $str .= ">" . $row['testname'] . "</option>";
                                                echo $str;
                                            }
                                        }
                                        else{

                                            foreach($test_arr as $id_test){
                                                $buf_name_test = mysqli_fetch_array( mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = $id_test"))['testname'];
                                                $str = "<option value='$buf_name_test' ";
                                                if(isset($testname)){
                                                    if($testname == $buf_name_test){
                                                        $str .= " selected";
                                                       
                                                    }
                                                }
                                                $str .= ">$buf_name_test</option>";
                                                echo $str;
                                            }
                                        }
                                ?>
                        </select>  
                      
                    </div>


                </div>
           
                <hr noshade   style = "height: 1px" > 

                <div class="row" style="width:100%;">
                                
                    <div class="col-12" style="margin-top: -15px;"> 

                        <button  id="btn_reload" class="btn btn-lg btn-primary btn-block" name ="show_reload"  style="display:none" value="1" type="submit">reload</button> 
                        <button  class="btn btn-lg btn-primary btn-block" name ="show_show" value="1" type="submit">Відобразити результат</button>

                    </div>

                </div>

                <hr noshade   style = "height: 1px; margin-top: 8px;" > 
                                                                         
            </div>
        </form>



        <div class="container" style= "background-color: #C0C0C0; margin-top:100px;">
            
            <hr noshade   style = "height: 1px" >

            <div class="row"> 
                <div class="col-1">                                                                                                                   <!--== [Виберіть один / декілька із варіантів]/[ Впишіть відповідь в поле]/[ Встановіть відповідність] ===-->
                    <label for="exampleFormControlSelect1" ><h5 style = "display : inline">  SHOW </label>
                </div>                            
            </div>

                <?php

                if(isset($_POST['show_show']))
                {

                
                    
                    $fat_err = false;
                    $err =false;

                    
                   // $testname
                   // $test_arr

                    if(!isset($id_users_arr) || !isset($testname) )
                        $fat_err = true;
                   // else
                    if(count($id_users_arr) <= 0)  
                        $err = true;
                   // else
                    if($testname == "" && isset($test_arr) && count($test_arr) <= 0)
                        $err = true;

                    if($fat_err){
                        ?>
                        <div class="row"> 
                            <div class="col-12">                                                                                                                   
                                <h1 align="center"> Невірний запит!!! </h1>
                            </div>                            
                        </div>
                        <?php

                    }elseif($err){
                        ?>
                        <div class="row"> 
                            <div class="col-12">                                                                                                                   
                                <h1 align="center"> Співпадінь не знайдено! </h1>
                            </div>                            
                        </div>
                        <?php

                    }else{
                        ?>
                        <div class="row"> 
                            <div class="col-12">                                                                                                                   
                            <?php
                                    $it = 1;

                                    if($testname == "")
                                    {
                                        if(isset($test_arr))
                                        {
                                            foreach($test_arr as $test_id)
                                            {
                                               // echo "am work  = |$test_id|<br>";

                                                foreach($id_users_arr as $user_id)
                                                {
                                                    
                                                    $query = "SELECT * FROM `result_user_test` WHERE `user_id` = $user_id and test_id = $test_id ";
                                                    if(isset($date) && $date != "")$query .= " and dateteusing = '$date'";
                                                    ShowTable($query, $conection , $it++);
                                                }                                                    
                                            }
                                        }
                                        else
                                        {
                                            foreach($id_users_arr as $user_id)
                                            {       
                                                $query = "SELECT * FROM `result_user_test` WHERE `user_id` = $user_id ";
                                                if(isset($date) && $date != "")$query .= " and dateteusing = '$date'";
                                                ShowTable($query, $conection, $it++ );
                                            }
                                        }
                                    }
                                    else
                                    {
                                        foreach($id_users_arr as $user_id)
                                        {
                                            $test_id = mysqli_fetch_array( mysqli_query($conection, "SELECT * FROM `tests` WHERE  testname = '$testname'"))['id_test'];
                                            $query = "SELECT * FROM `result_user_test` WHERE `user_id` = $user_id and test_id = $test_id";
                                            if(isset($date) && $date != "")$query .= " and dateteusing = '$date'";
                                            ShowTable($query, $conection, $it++ );
                                        }
                                    }


                                   
                                       


                                    
                            ?>
                            </div>

                        </div>                       
                        <?php
                    }







                }


                ?>


        </div>

        <br>
        <br>
        <br>


        <script>


            window.onload = function() {

                click_check_without_reload('subdiw_com');
                click_check_without_reload('subdiw_plat');
                click_check_without_reload('subdiw_spec');

                click_check_without_reload('user_surname');
                click_check_without_reload('user_name');
                click_check_without_reload('user_lastname');

                click_check_without_reload('date');
                click_check_without_reload('time');            

            };

            function click_reload(){
                document.getElementById("btn_reload").click();
            }

           
                    function click_check(id)
                    {
                       
                        check = document.getElementById(`check_${id}`);
                                             
                        if(check.checked){

                            document.getElementById(`${id}`).style.display = "";
                            document.getElementById(`${id}_mask`).style.display = "none";                         

                        }else{
                            document.getElementById(`${id}`).style.display = "none";
                            document.getElementById(`${id}_mask`).style.display = "";                    
                        }

                        //click_reload();
                            
                    }

                    function click_check_without_reload(id)
                    {
                       
                        check = document.getElementById(`check_${id}`);
                                             
                        if(check.checked){

                            document.getElementById(`${id}`).style.display = "";
                            document.getElementById(`${id}_mask`).style.display = "none";                         

                        }else{
                            document.getElementById(`${id}`).style.display = "none";
                            document.getElementById(`${id}_mask`).style.display = "";                    
                        }

                        
                            
                    }

        </script>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>



<?php
    function ShowTable($query, $conection , $f )
    {      
        $result = mysqli_query($conection, $query);
        $fields_num = mysqli_num_fields($result);

       
        if(mysqli_num_rows($result) > 0)//$f >= 1)
        {

            
            echo "<table border='1'>";

                // printing table headers
                echo "<tr>";
                    for($i=0; $i<$fields_num; $i++)
                    {
                        $field = mysqli_fetch_field($result);
                        echo "<td>{$field->name}</td>";
                    }
                echo "</tr>\n";

           // echo "</table>";
       // }

       // echo "<table border='1'>";

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

            echo "</table><br>";

        }
    }
?>