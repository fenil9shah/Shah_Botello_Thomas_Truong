<?php
    error_reporting(0);
    session_start();


    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
        echo "<script type='text/javascript'>alert('Please enter both email and password');window.location='../login.php';</script>";
        exit();
    }

    $email = $_POST['username'];
    $password = $_POST['password'];

    //prevents mysql injections
    // $email = stripcslashes($email);
    // $password = stripcslashes($password);
    // $email = mysqli_real_escape_string($email);
    // $password = mysqli_real_escape_string($password);

    $con = mysqli_connect("localhost", "root", "", "test");
    if(!$con)
    {
        die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    }
    
    $result = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'");
                
    $row = mysqli_fetch_array($result);
    
    if(($row['email'] == $email) && $row['password'] == $password)
    {
        $_SESSION['user'] = $email;
        if($row['fullName'] == NULL)
        {
            header("location: ../clientProfileManage.php");
            exit();
        }
        header("location: ../fuel_quote.php");
    }
    else{
        echo "<script type='text/javascript'>alert('EMAIL OR PASSWORD INCORRECT');window.location = '../login.php';</script>";
    }

?>