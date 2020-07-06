<?php
    session_start();
    include_once 'class.php';
    $user = new User();
    if($user->session()){
        header("location: clientProfileManage.php");
    }

    $user = new User();
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $login = $user->login($_REQUEST['email'], $_REQUEST['password']);
        if($login){
            header("location:clientProfileManage.php");
        }
        else{
            echo "Login failed!";
        }
    }


    
   /* $result = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'");
                
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