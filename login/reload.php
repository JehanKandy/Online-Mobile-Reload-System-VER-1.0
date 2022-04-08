<?php
    include("../config.php");

    
    session_start();
    $session1 = (String)$_SESSION['login'];         

    $session_sql = "SELECT user_tbl.email, user_tbl.uname, user_tbl.mobile_number, balance_tbl.full_amount, balance_tbl.user_email FROM user_tbl LEFT JOIN balance_tbl ON user_tbl.email = balance_tbl.user_email WHERE user_tbl.email = '$session1'";
    $session_result = mysqli_query($con, $session_sql);

    while($row = mysqli_fetch_assoc($session_result)){
        $uname = $row['uname'];
        $mobile = $row['mobile_number'];
        $email = $row['email'];
        $full_amount = $row['full_amount'];
    }
    if(isset($_POST['reload'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           $new_email = $_POST['new_email']; 
           $rel_amount = $_POST['rel_amount']; 
           
           
           if(empty($rel_amount)){
               $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Amount can not be Empty..!</div>&nbsp</center>";
           }
           else{
               if($full_amount < $rel_amount){
                   $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Please Recharge your account..! <a href='recharge.php'>Recharge</a></div>&nbsp</center>";
               }else{
                    date_default_timezone_set('Asia/Kolkata');
                    $today = date('Y-m-d');

                    $new_full_amount = $full_amount - $rel_amount;

                    $sql = "UPDATE balance_tbl SET full_amount = '$new_full_amount' WHERE user_email = '$session1'";
                    $result = mysqli_query($con, $sql);
                    

                    $reload_sql = "INSERT INTO recharge_tbl(user_email,reload_amount,reload_date)VALUE('$new_email','$rel_amount','$today')";
                    $reload_result = mysqli_query($con, $reload_sql);
                    header("location:user.php");
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
    <title>Reload <?php echo $uname; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="user.php">JK Online Mobile Reload &nbsp - &nbsp Reload Your Mobile</a> 
        <span class="navbar-text">
            <a href="user.php"><button class="btn btn-primary">  &nbsp Back to Dashboard</button></a>
        </span>
    </nav>

    <br><br><br>
    <div class="container">
        <h4>Reload for Your Mobile</h4>
        <br>
        <br>
            <?php 
                if(isset($msg)){
                    foreach($msg as $msg){
                        echo $msg;
                    }
                }
            ?>
        <br>
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                    <center>
                <form action="<?php echo ($_SERVER['PHP_SELF'])?>" method="post">
                <table>
                    <tr>
                        <td>
                            Name 
                        </td>
                        <td>
                            &nbsp&nbsp : &nbsp&nbsp
                        </td>
                        <td>
                            <?php echo $uname; ?>  
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email 
                        </td>
                        <td>
                            &nbsp&nbsp : &nbsp&nbsp
                        </td>
                        <td>
                            <?php echo $email; ?>
                            <input type="hidden" name="new_email" value="<?php echo $email; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mobile Number 
                        </td>
                        <td>
                            &nbsp&nbsp : &nbsp&nbsp
                        </td>
                        <td>
                            <?php echo $mobile; ?>
                        </td>
                    </tr>
                </table>
                <br><br>
            </div>
            <div class="form-group">
                <label for="amount">Reload Amount :</label><br>
                <input type="number" name="rel_amount" placeholder="Reload Amount" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Reload" name="reload" class="btn btn-primary">
            </div>
        </form>
        </div>

    </div>


    <br><br><br>

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