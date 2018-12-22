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

if (isset($_POST['result_schow']) || isset($_POST['show_reload']) || isset($_POST['show_show']) || isset($_POST['show_detal']))
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

    if($ck_date )
        $date = $_POST['date'];
    else
        $date = null;

       
            $query = "SELECT * FROM `result_user_test` "; 
            $query .= (isset($date) && $date != "") ? "WHERE dateteusing = '$date'" : "";
           
            $result = mysqli_query($conection, $query) or die(mysqli_error($conection));

            $itt = 0;

            while ($row = mysqli_fetch_array($result)){
                $test_arr[$itt++] = $row['test_id'] ;           
            }

            if(isset($test_arr))
            $test_arr = array_unique($test_arr);
        


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

        

        if(isset($usersurname))
        {
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

        if(isset($username))
        {

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


    $itr = 0;
    while ($row = mysqli_fetch_array($result)){     
        $id_users_arr[$itr++] = $row['id_user'];
    }
}
else
{
    echo "<h1> Помиилка \"Пустий набір даних\"  </h1>";
    echo "неможливо відкрити файл \"show_results.php\" для интерпритації<br>";   
    exit;             
}

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

        <br>
   
        <!--=================== block serch data ==================-->
        <form action="show_results.php" method="POST" >
            <div id="main_header_block" class="container" style= "background-color: #C0C0C0; width:100%; height:285px; <?php if(isset($_POST['show_detal'])) echo " display:none " ?>">
 
                <div class="row" style="width:100%; height:20px ">
                </div>  
                

                <!--============= subdivision ==============-->
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
                <!--========================================-->


                <!--============= user data  ===============-->                    
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
                <!--========================================-->


                <!--============ date / tests ==============-->
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

                                        if(isset($test_arr))
                                        {                                      
                                            foreach($test_arr as $id_test)
                                            {
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
                <!--=======================================-->


                <hr noshade   style = "height: 1px" >

                <!--============ button showresult ==============-->
                <div class="row" style="width:100%;">
                                
                    <div class="col-12" style="margin-top: -15px;"> 

                        <button  id="btn_reload" class="btn btn-lg btn-primary btn-block" name ="show_reload"  style="display:none" value="1" type="submit">reload</button>
                        <button  id="btn_show_detal" class="btn btn-lg btn-primary btn-block" name ="show_detal"  style="display:none"  type="submit">reload</button>  
                        <button  id="btn_show_show_sh" class="btn btn-lg btn-primary btn-block" name ="show_show" value="1" type="submit">Відобразити результат</button>

                    </div>

                </div>
                <!--==============================================-->

                <hr noshade   style = "height: 1px; margin-top: 8px;" > 
                                                                         
            </div>
        </form>
        <!--========================================================-->


        <!--=================== block show result ==================-->
        <div  style= "background-color: #C0C0C0; margin-top:40px;  margin-left:20px; width:97%; padding: 10px;">
            
            <hr noshade   style = "height: 1px" >

            <div class="row" > 
                <div class="col-12">                                                                                                                   <!--== [Виберіть один / декілька із варіантів]/[ Впишіть відповідь в поле]/[ Встановіть відповідність] ===-->
                    <h3 align="center"> Результати </h3>
                </div>                            
            </div>
            <br>

                <?php

                    if(isset($_POST['show_show']))
                    {

                        $fat_err = false;
                        $err =false;
                        $err_noresult = false;

                        if(!isset($id_users_arr) || !isset($testname) )
                            $fat_err = true;
                        else
                        if(!isset($test_arr))
                            $err_noresult = true;
                        else   
                        if(count($id_users_arr) <= 0 || count($test_arr) <= 0)  
                            $err = true;
                    

                        if($fat_err){
                            ?>
                            <div class="row"> 
                                <div class="col-12">                                                                                                                   
                                    <h1 align="center"> Невірний запит!!! </h1>
                                </div>                            
                            </div>
                            <?php
                        }elseif($err_noresult){
                            ?>
                            <div class="row"> 
                                <div class="col-12">                                                                                                                   
                                    <h1 align="center"> Результатів в системі не має ! </h1>
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

                            //======== show results ======
                            ?>
                                <div class="row"> 
                                    <div class="col-12">

                                        <?php TableHeader(); ?>

                                            <!--================ Show dataset results ============-->
                                            <?php
                                                
                                                $empty_dataset = true;

                                                $it = 1;
                                                if($testname == "")
                                                {                                           
                                                    foreach($test_arr as $test_id)
                                                    {                                                
                                                        echo " <tr> ";
                                                        if(isset($test_id))
                                                        {
                                                            $testname = mysqli_fetch_array( mysqli_query($conection, "SELECT * FROM `tests` WHERE id_test = $test_id"))['testname'];
                                                            echo " <td colspan=\"16\" align=\"center\"> <div>  <h5 style=\"display:inline-block;\">$testname</h5>  <span style=\"display:inline-block; margin-left : 15px\"> [id : '$test_id']</span> </div> </td> "; 
                                                        }
                                                        else{
                                                            echo " <td colspan=\"16\" align=\"center\"> <h4> Тест видалено =( </h4> </td> ";

                                                        }              
                                                        echo " </tr> \n";
                                                        
                                                        foreach($id_users_arr as $user_id)
                                                        {                                                                                                     
                                                            ShowTableResultTests($user_id, $test_id, $date, $conection, $empty_dataset);
                                                        }                                                                                                                                                         
                                                    }                                        
                                                }
                                                else
                                                {
                                                    $test_id = mysqli_fetch_array( mysqli_query($conection, "SELECT * FROM `tests` WHERE  testname = '$testname'"))['id_test'];

                                                    echo " <tr> ";    
                                                    echo " <td colspan=\"16\" align=\"center\"> <div>  <h5 style=\"display:inline-block;\">$testname</h5>  <span style=\"display:inline-block; margin-left : 15px\"> [id : '$test_id']</span> </div> </td> ";            
                                                    echo " </tr> \n";
                                                
                                                    foreach($id_users_arr as $user_id)
                                                    {
                                                        ShowTableResultTests($user_id, $test_id, $date, $conection, $empty_dataset);
                                                    }
                                                }

                                            ?>
                                            <!--==================================================-->

                                            <!--================ check empty dataset ============-->
                                            <?php 
                                                if($empty_dataset)
                                                {
                                                    echo " <tr> ";
                                                    echo " <td colspan=\"16\" align=\"center\"> <h3>Результатів по даному запиту не знайдено<h3></td> ";               
                                                    echo " </tr> \n";
                                                }
                                            ?>
                                            <!--=================================================-->

                                        </table>

                                    </div>

                                </div>                                                
                            <?php
                            //============================
                        }
                    }

                    if(isset($_POST['show_detal']))
                    {
                        ?>
                            <div class="row"> 
                                <div class="col-12">
                                    <?php  ShowTableDetails($_POST['show_detal'], $conection);?>
                                </div>
                            </div>

                            <hr noshade   style = "height: 1px" >

                            <div class="row"> 
                                <div class="col-12">
                                    <button onclick="click_back()"  class="btn btn-lg btn-primary btn-block" >Повернутись</button>
                                </div>
                            </div>

                            <br>

                        <?php
                    }
                    
                ?>

            <br>
            <hr noshade   style = "height: 1px" >

        </div>
        <!--========================================================-->


    <br><br><br><br><br><br>


    <script>

        window.onload = function() 
        {
            m_click_check('subdiw_com');
            m_click_check('subdiw_plat');
            m_click_check('subdiw_spec');

            m_click_check('user_surname');
            m_click_check('user_name');
            m_click_check('user_lastname');

            m_click_check('date');
            m_click_check('time');            
        };


        function click_back()
        {               
            document.getElementById("btn_show_show_sh").click();
        }

        function click_show_detals(id_res)
        {
            document.getElementById("btn_show_detal").value = id_res;
            document.getElementById("btn_show_detal").click();
        }

        function click_reload()
        {
            document.getElementById("btn_reload").click();
        }

        function click_check(id)
        {                     
            check = document.getElementById(`check_${id}`);
                                             
            if(check.checked)
            {
                document.getElementById(`${id}`).style.display = "";
                document.getElementById(`${id}_mask`).style.display = "none";                         
            }
            else
            {
                document.getElementById(`${id}`).style.display = "none";
                document.getElementById(`${id}_mask`).style.display = "";                    
            }

            click_reload();
        }

        function m_click_check(id)
        {                     
            check = document.getElementById(`check_${id}`);
                                             
            if(check.checked)
            {
                document.getElementById(`${id}`).style.display = "";
                document.getElementById(`${id}_mask`).style.display = "none";                         
            }
            else
            {
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


<!-- ============= function php ====================== -->
<?php

    function TableHeader()
    {
        ?>
            <table border='2'>
                <tr>
                    <td> ID-рез</td>

                    <td> Прізвище </td>
                    <td> імя </td>
                    <td> По батькові </td>
                    <td> Звання </td>

                    <td> Рота № </td>
                    <td> Взвод № </td>
                    <td> Спец-сть </td>

                    <td> id-тест </td>
                    <td> Всього <br> балів </td>
                    <td> Набрано <br> балів </td>
                    <td> - % - </td>
                    <td> Оцінка </td>

                    <td> Дата </td>
                    <td> Час </td>
                    <td>Деталі</td>                                       
                </tr>

        <?php
    }

    function ShowTableDetails($id_res, $conection)
    {

        ?>
            <table border='2'>
                <tr>
                    <td> ID-пит</td>
                    <td> Тип </td>
                    <td> Текст питання </td>
                    <td> Ваша <br> відповідь </td>
                    <td> Вірна <br> відповідь </td>
                
                    <td> Балів за <br> відповідь </td>
                    <td> Набрано <br> балів </td>                            
                </tr> 
        <?php

        $query = "SELECT * FROM `result_user_questions` WHERE `result_id` = $id_res";
        $result = mysqli_query($conection, $query);

        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";

                echo "<td>".$row['question_id']."</td>";              
                echo "<td>".$row['type_quest']."</td>";

                
                if(isset($row['question_id']))
                {
                    $id_quest = $row['question_id'];
                    $text = mysqli_fetch_array(mysqli_query($conection, "SELECT * FROM `questions` WHERE `id_question` = $id_quest"))['questiontext'];
                }
                else{
                    $text ="<h6>Дане питання було видалено!!!</h6>"; 
                }
                
                echo "<td>".$text."</td>";

                echo "<td>".$row['answer']."</td>";
                echo "<td>".$row['answer_correct']."</td>";
                echo "<td>".$row['ball']."</td>";
                echo "<td>".$row['ball_your']."</td>";
                
            echo " </tr>\n";
        }

        ?>
         </table> 
        <?php
    }

    function ShowTableResultTests($user_id, $test_id, $date, $conection, &$flag_empty_dataset)
    {    
        $query = "SELECT * FROM `result_user_test` WHERE `user_id` = $user_id ";
        $query .= isset($test_id) ? " and test_id = '$test_id' " :  "and test_id IS NULL ";
        $query .= (isset($date) && $date != "") ? " and dateteusing = '$date'" : "";
        $result = mysqli_query($conection, $query);
        $count = mysqli_num_rows($result); 

        if($count > 0)
        {
            $flag_empty_dataset = false;

            while($row = mysqli_fetch_row($result))
            {
                echo " <tr> ";
  
                    $itr = 0;
                    foreach($row as $cell)
                    {                     
                        if($itr == 1)
                        {                           
                          echo "<td>" . mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `users` WHERE id_user = $cell"))['usersurname'] . "</td>";
                          echo "<td>" . mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `users` WHERE id_user = $cell"))['username'] . "</td>";
                          echo "<td>" . mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `users` WHERE id_user = $cell"))['userlastname'] . "</td>";

                           $id_rung = mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `users` WHERE id_user = $cell"))['userrung_id'];
                           $id_company = mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `users` WHERE id_user = $cell"))['company_id'];
                           $id_platoon = mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `users` WHERE id_user = $cell"))['platoon_id'];
                           $id_specialty = mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `users` WHERE id_user = $cell"))['specialty_id'];

                           echo "<td>" . mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `user_rung` WHERE id_rung = $id_rung"))['rungname'] . "</td>";
                           echo "<td>" . mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `company` WHERE id_company = $id_company"))['companynumber'] . "</td>";
                           echo "<td>" . mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `platoon` WHERE id_platoon = $id_platoon"))['platoonnumber'] . "</td>";
                           echo "<td>" . mysqli_fetch_array(mysqli_query($conection,  "SELECT * FROM `specialty` WHERE id_specialty = $id_specialty"))['specialtyname'] . "</td>";                         
                        }
                        elseif($itr == 2 )
                        {
                          
                            if($row[2] == "")
                                echo "<td bgcolor=\"red\">Тест<br>вида-<br>лено!</td>";
                            else
                                echo "<td>$cell</td>";
                        }
                        elseif($itr == 5 )
                        {

                            if($row[6] > 4){
                                echo "<td bgcolor=\"green\">$cell</td>";  
                            }elseif($row[6] > 3){
                                echo "<td bgcolor=\"blue\">$cell</td>"; 
                            }elseif($row[6] > 2){
                                echo "<td bgcolor=\"yellow\">$cell</td>"; 
                            }else{
                                echo "<td bgcolor=\"maroon\">$cell</td>";  
                            }                           
                        }
                        else
                        {
                            echo "<td>$cell</td>";                           
                        }

                      $itr += 1;
                            
                    }

                    echo "<td> <button  onclick=\"click_show_detals(".$row[0].")\" class=\"btn  btn-primary btn-block\" style=\"height : 20px; width: 48px\" ><div style=\"margin-top:-10px;\"  >+</div></button> </td>";  
                                     
                echo " </tr> \n";
            }

        }

    }
?>
<!-- ================================================== -->