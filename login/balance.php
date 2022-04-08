<?php
    include("../config.php");

    session_start();
    if(empty($_SESSION['login'])){
        header("location:login.php");
    }

    $session1 = strval($_SESSION['login']);       

    $sql = "SELECT * FROM balance_tbl WHERE user_email = '$session1'";
    $result = mysqli_query($con, $sql);
    $nor = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
<body>
<nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="user.php">JK Online Mobile Reload &nbsp - &nbsp Recharge History</a> 
        <span class="navbar-text">
            <a href="user.php"><button class="btn btn-primary">  &nbsp Back to Dashboard</button></a>
        </span>
    </nav>

    <br><br><br>
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>
                        Username
                    </th>
                    <th>
                        Recharged Balance
                    </th>
                    <th>
                        Full Balance
                    </th>
                    <th>
                        Recharged Card
                    </th>
                    <th>
                        Card Holder
                    </th>
                    <th>
                        Recharged Date
                    </th>
                    <th>
                        Expire Date
                    </th>
                </tr>
            </thead>
                <?php 
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td>
                        <?php echo $row['user_email']; ?>
                    </td>
                    <td>
                        Rs.<?php echo $row['amount']; ?>.00
                    </td>
                    <td>
                        Rs.<?php echo $row['full_amount']; ?>.00
                    </td>
                    <td>
                        <?php echo $row['card_number']; ?>
                    </td>
                    <td>
                        <?php echo $row['holder_name']; ?>
                    </td>
                    <td>
                        <?php echo $row['pay_date']; ?>
                    </td>
                    <td>
                        <?php echo $row['expire_date']; ?>
                    </td>
                </tr>
                <?php } ?>
        </table>
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