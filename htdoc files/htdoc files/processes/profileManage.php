<?php
     error_reporting(0);
     session_start();
 

     $con = mysqli_connect("localhost", "root", "", "test");
    if(!$con)
    {
        die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    }

    $user_check = $_SESSION['user'];
    if (empty($user_check))
    {
        header("location: ../login.php");
        session_destroy();
    }

    $fullname = $_POST['fullName'];
    $addr1 = $_POST['address1'];
    $addr2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zipcode'];

    $result = mysqli_query($con, "UPDATE `users` SET `fullName`='$fullname',`addr1`='$addr1',`addr2`='$addr2',`city`='$city',`state`='$state',`zipcode`='$zip' WHERE email = '$user_check'");

    if(empty($result)){
        //Could not implement to database so send back to login
        session_destroy();
        echo "<script type='text/javascript'>alert('Databse was unable to insert data. Please log in again.');window.location = '../login.php';</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('Success!');window.location = '../fuel_quote.php';</script>";
    }

?>