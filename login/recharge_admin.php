<?php
    include("../config.php");

    
    session_start();
    $session1 = (String)$_SESSION['login'];         

    $session_sql = "SELECT user_tbl.email, user_tbl.uname, user_tbl.mobile_number, balance_tbl.full_amount FROM user_tbl LEFT JOIN balance_tbl ON user_tbl.email = balance_tbl.user_email WHERE user_tbl.email = '$session1'";
    $session_result = mysqli_query($con, $session_sql);

    while($row = mysqli_fetch_assoc($session_result)){
        $uname = $row['uname'];
        $mobile = $row['mobile_number'];
        $email = $row['email'];
        $full_amount = $row['full_amount'];
    }

    if(isset($_POST['pay'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $new_email = $_POST['new_email'];
            $pay_amount = $_POST['pay_amount'];
            $card_num = $_POST['card_num'];
            $holder_name = $_POST['holder_name'];

            if(empty($pay_amount)){
                $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Amount can not be Empty..!</div>&nbsp</center>";  
            }
            elseif(empty($card_num)){
                $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Card Number can not be Empty..!</div>&nbsp</center>"; 
            }
            elseif(empty($holder_name)){
                $msg[] = "<center>&nbsp<div class='alert alert-danger col-10' role='alert'>Holder Name can not be Empty..!</div>&nbsp</center>"; 
            }
            else{
                date_default_timezone_set('Asia/Kolkata');
                $today = date('Y-m-d');
                $expire_d = date('Y-m-d',strtotime('+30 days',strtotime(str_replace('/', '-',$today))));
                

                $new_full_amount = $full_amount + $pay_amount;

                $insert_sql = "INSERT INTO balance_tbl(pay_date,expire_date,amount,full_amount,card_number,holder_name,user_email)VALUES('$today','$expire_d','$pay_amount','$new_full_amount','$card_num','$holder_name','$new_email')";
                $insert_result = mysqli_query($con, $insert_sql);
                header("location:admin.php");
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
    <title>Recharge Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="admin.php">JK Online Mobile Reload &nbsp - &nbsp Add Balance Your Account</a> 
        <span class="navbar-text">
            <a href="admin.php"><button class="btn btn-primary">  &nbsp Back to Dashboard</button></a>
        </span>
    </nav>

    <br><br><br>


    <div class="container">
        <h4>Add Balance for Your Account</h4>
        <br>
        <p>
            <font color="red">Your Amount will Expire After 30 days</font>
        </p>
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
                </center>
                    <div class="form-group">
                        <label for="pay-ammount">Amount : </label>
                        <input type="number" name="pay_amount" placeholder="Pay Amount" class="form-control">
                    </div>
                    <div class="form-group">
                        <b>Select Card Type : </b><br>
                        <label for="card"></label>
                            <input type="radio" name="card" value="Master Card" class="form=control"> Master Card
                            &nbsp&nbsp&nbsp&nbsp
                            <input type="radio" name="card" value="visa Card" class="form=control"> Visa Card                            
                        
                    </div>
                    <div class="form-group">
                        <label for="Card Number">Card Number : &nbsp</label>
                        <input type="number" name="card_num" placeholder="Card Number" class="form-control lg">
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="number" name="cvv" class="form-control" style="width: 100px;" maxlength="4">
                                <b>Card Expire</b>
                                <label for="date"></label>
                                <select name="month" class="form-control" style="width: 120px;">
                                    <option value="Jan">January</option>
                                    <option value="Feb">February</option>
                                    <option value="Mar">March</option>
                                    <option value="Apr">April</option>
                                    <option value="May">May</option>
                                    <option value="Jun">June</option>
                                    <option value="Jul">July</option>
                                    <option value="Aug">August</option>
                                    <option value="Sep">September</option>
                                    <option value="Oct">October</option>
                                    <option value="Nov">November</option>
                                    <option value="Dec">December</option>                            
                                </select>
                                <br>
                                <select name="year" class="form-control" style="width: 120px;">
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>                        
                                </select>

                    </div>
                    <div class="form-group">
                        <label for="card-holder">Card holder's Name : </label>
                        <input type="text" name="holder_name" placeholder="Holder's Name" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="PAY" class="btn btn-primary" name="pay">
                    </div>
                </form>
            </div>
        </div>
        <br><br><br>
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