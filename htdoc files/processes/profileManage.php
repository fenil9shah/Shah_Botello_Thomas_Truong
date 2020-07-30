<?php
     error_reporting(0);
     session_start();
 
     $userID = $_SESSION['id'];

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

    $result = mysqli_query($con, "INSERT INTO `client_information`(`userID`, `full_name`, `address1`, `address2`, `city`, `state`, `zipcode`)
                                    VALUES ('$userID','$fullname','$addr1','$addr2','$city','$state','$zip')");
    $result2 = mysqli_query($con, "UPDATE `users`
                                   SET `client_info_ID`= (SELECT `client_info_ID`
                                                          FROM `client_information`
                                                          WHERE client_information.userID = users.id AND users.id = '$userID')
                                    WHERE id = '$userID'");

    if(empty($result) || empty($result2)){
        //Could not implement to database so send back to login
        session_destroy();
        echo "<script type='text/javascript'>alert('Databse was unable to insert data. Please log in again.');window.location = '../login.php';</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('Success!');window.location = '../fuel_quote.php';</script>";
    }

?>