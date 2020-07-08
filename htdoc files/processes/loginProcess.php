<?php

    include_once '../class.php';

    

    


    $user = new User();
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $email = $_REQUEST['username'];
        $pass = $_REQUEST['password'];

        $login = $user->login($email, $pass);
        if($login){
            if ($user->checkCredentials($email, $pass))
                header("location: ../clientProfileManage.php");
            else
                header("location: ../fuel_quote.php");
        }
        else{
            echo "<script type='text/javascript'>alert('Login incorrect');window.location = '../login.php';</script>";
        }
    }

    $user = new User();
    if($user->session()){
        header("location: ../clientProfileManage.php");
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
*/
?>