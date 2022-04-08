<?php
    include("../config.php");

    session_start();
    if(empty($_SESSION['login'])){
        header("location:login.php");
    }

    $session1 = strval($_SESSION['login']);         



    $session_sql = "SELECT user_tbl.uname, user_tbl.email, user_tbl.mobile_number, user_tbl.uaddress, user_tbl.user_type, user_tbl.user_status,
                           balance_tbl.pay_date, balance_tbl.expire_date, balance_tbl.amount, balance_tbl.full_amount, balance_tbl.card_number, balance_tbl.holder_name, balance_tbl.user_email,
                           recharge_tbl.user_email, recharge_tbl.reload_amount, recharge_tbl.reload_date 
                           FROM user_tbl 
                           INNER JOIN balance_tbl ON user_tbl.email = balance_tbl.user_email 
                           INNER JOIN recharge_tbl ON user_tbl.email = recharge_tbl.user_email 
                           WHERE user_tbl.email = '$session1'";

    $session_result = mysqli_query($con, $session_sql);


    while($row = mysqli_fetch_assoc($session_result)){
        
        $uname = $row['uname'];
        $mobile = $row['mobile_number'];
        $email = $row['email'];
        $uaddress = $row['uaddress'];
        $user_type = $row['user_type'];
        $user_status = $row['user_status'];
        $recharge_amount = $row['amount'];
        $balance_expire = $row['expire_date'];
        $full_amount = $row['full_amount'];
        $reload_date = $row['reload_date'];
   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel <?php echo $uname; ?> </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">JK Online Mobile Reload - Admin Panel &nbsp&nbsp <?php echo $email; ?></a> 
    <span class="navbar-text">
        <a href="logout.php"><button class="btn btn-danger"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
  <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
</svg> &nbsp Logout</button></a>
    </span>
</nav>
<br><br><br><br>
<center>
<div class="container">
<table border="0">
        <tr>
            <td>
            <div class="card" style="width: 25rem;">
    <div class="card-body">
        <h5 class="card-title">Your Profile Details
        </h5>
        <p class="card-text">
            <table border="0">
                <tr>
                    <td>
                        Name  
                    </td>
                    <td>
                        &nbsp:&nbsp
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
                        &nbsp:&nbsp
                    </td>
                    <td>
                        <?php echo $email; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Mobile   
                    </td>
                    <td>
                        &nbsp:&nbsp
                    </td>
                    <td>
                        <?php echo $mobile; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Address   
                    </td>
                    <td>
                        &nbsp:&nbsp
                    </td>
                    <td>
                        <?php echo $uaddress; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Account Type:  
                    </td>
                    <td>
                        &nbsp:&nbsp
                    </td>
                    <td>
                        <?php echo $user_type; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Account Status:  
                    </td>
                    <td>
                        &nbsp:&nbsp
                    </td>
                    <td>
                        <?php
                            if($user_status == 1){
                                echo "<font color = 'green'>Account Activated</font>";
                            }else{
                                echo "<font color = 'red'>Account Deactivated</font>";
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </p>

        </div>
        </div>
            </td>
            <td>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </td>
            <td>
                <a href="balance_admin.php" style="text-decoration: none;">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">Your Account Balance</div>
                    <div class="card-body">
                        <h5 class="card-title">Rs.
                            <?php
                                echo $full_amount; 
                                
                            ?>.00</h5>
                        <p class="card-text">Expire on : <?php echo $balance_expire; ?> </p>
                    </div> 
                </div>
                </a>
            </td>
            <td>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </td>
            <td>
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Add Balance</div>
                    <div class="card-body">
                        <h5 class="card-title">Add Balance Here</h5>
                        <p class="card-text"><a href="recharge_admin.php"><button class="btn btn-success">Add Balance</button></a></p>
                    </div>
                </div>
            </td>
            <td>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </td>
            <td>
                <div class="card bg-light mb-3" style="max-width: 25rem;">
                    <div class="card-header">Reload</div>
                    <div class="card-body">
                        <h5 class="card-title">Reload Here</h5>
                        <p class="card-text"><a href="reload_admin.php"><button class="btn btn-success">Reload</button></a></p>
                    </div>
                </div>
            </td>
        </tr>
    </table>

<br><br>
<hr>
<br><br>
    <table border="0">
        <tr>
            <td>

                <a href="all_users.php" style="text-decoration: none;"> 
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">User</div>
                        <div class="card-body">
                            <h5 class="card-title">All Users</h5>
                            <p class="card-text"><h3></h3></p>
                        </div>
                    </div>
                </a>
            </td>
            <td>&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td>

                <a href="all_balances.php" style="text-decoration: none;"> 
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Account Recharges</div>
                        <div class="card-body">
                            <h5 class="card-title">All Account Recharges</h5>
                            <p class="card-text"><h3></h3></p>
                        </div>
                    </div>
                </a>
            </td>
            <td>&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td>
                <a href="all_reloads.php" style="text-decoration: none;"> 
                    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                        <div class="card-header">Mobile Reloads</div>
                        <div class="card-body">
                            <h5 class="card-title">All Mobile Reloads</h5>
                            <p class="card-text"><h3></h3></p>
                        </div>
                    </div>
                </a>
            </td>
        </tr>
    </table>
</div>
</center>
<br><br><br><br>
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