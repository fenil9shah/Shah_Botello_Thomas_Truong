<?php
    error_reporting(0);
    session_start();


    if (empty($_POST['createUserN']) || empty($_POST['pass1']) || empty($_POST['pass2'])) {
        $error = "Username or Password is invalid";
        echo "<script type='text/javascript'>alert('Please enter both Username and password');window.location='../clientRegister.php';</script>";
        exit();
    }
    if($_POST['pass1'] != $_POST['pass2'])
    {
        $error = "Password does not match";
        echo "<script type='text/javascript'>alert('Password doesnot match');window.location='../clientRegister.php';</script>";
        exit();
    }
    if(strlen($_POST['pass1']) < 6)
    {
        $error = "Password: Minimum 6 characters";
        echo "<script type='text/javascript'>alert('Password: Minimum 6 characters');window.location='../clientRegister.php';</script>";
        exit();
    }




    $email = $_POST['createUserN'];
    $password1 = $_POST['pass1'];
    $password2 = $_POST['pass2'];

    
    // to check if username already exists in the database.
    $con = mysqli_connect("localhost", "root", "", "test");
    if(!$con)
    {
        die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        echo "<script type='text/javascript'>alert('error connection');</script>";
    }
    $result = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email'");           
    $row = mysqli_fetch_array($result);
    if(($row['email'] == $email))
    {
        $error = "Username already exists";
        echo "<script type='text/javascript'>alert('User name already exists. try different one.');window.location = '../clientRegister.php';</script>";
        exit();
    }
    else{
        // after checking everything is fine, insert into the database: username and password.
        $result1 = "INSERT INTO `users`(`email`, `password`) VALUES ('$email','$password1')";
        if ($con->query($result1) === TRUE) {
            echo "<script type='text/javascript'>alert('New record created');window.location = '../login.php';</script>";
        } else {
            echo "Error: " . $result1 . "<br>" . $conn->error;
        }
    }
    /*if(empty($result1)){
        //Could not implement to database so send back to registration
        session_destroy();
        echo "<script type='text/javascript'>alert('Databse was unable to insert data. Please register again.');window.location = '../clientRegister.php';</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('Success!');window.location = '../login.php';</script>";
    }*/



    



?>