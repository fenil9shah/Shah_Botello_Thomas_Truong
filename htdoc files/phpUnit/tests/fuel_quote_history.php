<?php 
        $con = mysqli_connect("localhost", "root", "", "test");
        if(!$con)
        {
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        }

        session_start();
        $user_check = $_SESSION['user'];
    //    echo "<script type='text/javascript'>alert('$user_check');window.location = '../login.php';</script>";
        $ses_sql = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$user_check'");
        $row = mysqli_fetch_array($ses_sql);
        $loginSession = $row['email'];
        if(empty($loginSession)){
            header('location: login.php');
           // echo "<script type='text/javascript'>alert('$loginSession');window.location = '../login.php';</script>";

        }

?>


<!DOCTYPE html>
<html>
    
    <head>
        <title>Fuel Quote History</title>
          <link rel="stylesheet" type="text/css" href="styles/fuel_quote_history.css" />
    </head>
    
    <body>

        <div class= "logoutLink">
            <a href="logout.php">Logout</a>
        </div>

        <h1>Fuel Quote History</h1>
        <br>
        <table>
            <tr>
                <th>Client Name</th>
                <th>Gallons Requested</th>
                <th>Delivery Address</th>
                <th>Delivery Date</th>
                <th>Suggested Price / Gallon</th>
                <th>Total Amount Due</th>
            </tr>
            <tr>
                <td>Lester Harvey</td>
                <td># of gallons requested</td>
                <td>address</td>
                <td>date</td>
                <td>price</td>
                <td>total cost</td>
            </tr>
            <tr>
                <td>Fred Brown</td>
                <td># of gallons requested</td>
                <td>address</td>
                <td>date</td>
                <td>price</td>
                <td>total cost</td>
            </tr>
            <tr>
                <td>Charles Pearson</td>
                <td># of gallons requested</td>
                <td>address</td>
                <td>date</td>
                <td>price</td>
                <td>total cost</td>
            </tr>
            <tr>
                <td>Harry Brown</td>
                <td># of gallons requested</td>
                <td>address</td>
                <td>date</td>
                <td>price</td>
                <td>total cost</td>
            </tr>
        </table>
    </body>
</html>