<?php
    include("../config.php");

    if(isset($_POST['register'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $usern = $_POST['u_name'];
            $email = $_POST['email'];
            $pass1 = md5($_POST['pass']);
            $cpass = md5($_POST['cpass']);
            $mobile_n = $_POST['mobile_n'];
            $address = $_POST['address'];

            $all_sql = "SELECT * FROM user_tbl WHERE email = '$email'";
            $all_result = mysqli_query($con, $all_sql);
            $all_nor = mysqli_num_rows($all_result);
            
            if($all_nor > 0){
                $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>User Already Exists...!</div>&nbsp</center>";
            }else{
                if(empty($usern)){
                    $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Name Can't be Empty</div>&nbsp</center>";
                }
                elseif(empty($email)){
                    $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Email Can't be Empty</div>&nbsp</center>";
                }
                elseif(empty($pass1)){
                    $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Password Can't be Empty</div>&nbsp</center>";
                }
                elseif(empty($cpass)){
                    $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Confirm Password Can't be Empty</div>&nbsp</center>";
                }
                elseif(empty($mobile_n)){
                    $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Mobile Number Can't be Empty</div>&nbsp</center>";
                }
                elseif(empty($address)){
                    $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Address Can't be Empty</div>&nbsp</center>";
                }
                elseif($pass1 != $cpass){
                    $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Password and Confirm Password Does not Match</div>&nbsp</center>";
                }
                else{
                    $insert_sql = "INSERT INTO user_tbl(uname,email,pass1,mobile_number,uaddress,user_type,user_status)VALUES('$usern','$email','$pass1','$mobile_n','$address','user','1')";
                    $inser_result = mysqli_query($con, $insert_sql);
                    
                    date_default_timezone_set('Asia/Kolkata');
                    $today = date('Y-m-d');
                    $expire_d = date('Y-m-d',strtotime('+30 days',strtotime(str_replace('/', '-',$today))));

                    $balance_table_sql = "INSERT INTO balance_tbl(pay_date,expire_date,amount,full_amount,card_number,holder_name,user_email) VALUES('$today','$expire_d','50','50','Login Gift','Admin','$email')";
                    $balance_result = mysqli_query($con, $balance_table_sql);

                    $recharge_table_sql = "INSERT INTO recharge_tbl(user_email,reload_amount,reload_date)VALUES('$email','50','$today')";
                    $recharge_result = mysqli_query($con, $recharge_table_sql);

                    header("location:login.php");
                    
                }
            }
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
.reg_system {
    width: 100%;
    height: 130vh;
    background-image: url(../images/reg.jpg);
    background-size: cover;
    background-position: center;
}
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="../index.php">JK Online Mobile Reload</a>
    <span class="navbar-text">

    </span>
</nav>
<div class="reg_system">
<div class="container">
    <br><br><br><br><br>
    <center>
    <div class="card" style="width: 40rem;">
        <div class="card-header">
            <h3>Register Here</h3>
        </div>
        <div class="card-body">

            <?php 
                if(isset($msg)){
                    foreach($msg as $msg){
                        echo($msg);
                    }
                }            
            ?>
            <form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Enter Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg></span>
                        </div>
                            <input type="text" class="form-control" name="u_name">
                    </div>   
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Enter Email &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-at" viewBox="0 0 16 16">
                        <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"/>
                        </svg></span>
                        </div>
                            <input type="email" class="form-control" name="email">
                    </div>   
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Enter Password  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                            <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg></span>
                        </div>
                            <input type="password" class="form-control" name="pass">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Confirm Password &nbsp <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                            <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg></span>
                        </div>
                            <input type="password" class="form-control" name="cpass">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Mobile Number &nbsp&nbsp&nbsp&nbsp <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
                            <path d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0z"/>
                            </svg></span>
                        </div>
                            <input type="text" class="form-control" name="mobile_n">
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">Enter Address &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg></span>
                        </div>
                            <input type="text" class="form-control" name="address">
                    </div>
                    <br>
                    <div class="form-group">
                        <p>
                            Already have an Account ? <a href="login.php">Login Here</a>
                        </p>
                    </div>
                    <div class="form-group">
                        <input type="reset" value="Clear" class="btn btn-secondary btn-lg btn-block">
                        <input type="submit" value="Register" name="register" class="btn btn-primary btn-lg btn-block">
                    </div>             
                </div>
            </form>
        </div>
    </div>
    </center>
    <br><br>
</div>
</div>

<div class="footer">
    <div class="card text-center">
    <div class="card-footer text-muted">
        &copy; &nbspDEVELOPED BY : JEHANKANDY || 2022 April
    </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>