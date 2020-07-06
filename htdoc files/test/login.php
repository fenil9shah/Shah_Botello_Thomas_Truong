<?php
    error_reporting(0);
    session_start();

    /*$con = mysqli_connect("localhost", "root", "", "test");
        if(!$con)
        {
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        }

    $user_check = $_SESSION['user'];
    */ // add this sectoin in class.php to check database connection
    
    /*$ses_sql = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$user_check'");
    $row = mysqli_fetch_array($ses_sql);
    $loginSession = $row['email'];
    if(!empty($loginSession)){
        if ($row['fullName'] == NULL)
        {
            header('location: clientProfileManage.php');
            exit();
        }
        header('location: fuel_quote.php');
    }*/ // add this section in class.php to check login session.
    
    include_once 'class.php';
    $user = new User();
    if($user->session()){
        header("location: fuel_quote.php");
    }

    $user = new User();
    if($_SERVER["$REQUEST_METHOD"] == "POST"){
        $login = $user->login($_REQUEST['email'], $_REQUEST['password']);
        if($login){
            header("location:fuel_quote.php");    
        }
        else{
            echo "Login failed!";
        }
    }

?>

<html>

<head>
    <title>Test Website</title>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>

    <header>


    </header>

    <div class="login-mid">
        <div class="login-title">
            Sign in:
        </div>
        <div class="signinSection">
            <form action='processes\loginProcess.php' method="POST" > 
                <div class="UsernameTitle">
                    Username:
                    <div class="usernameInput">
                        <input type="text" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                    </div>
                </div>


                <div class="PasswordTitle">
                    Password:
                    <div class="passwordInput">
                        <input type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                    </div>
                </div>
            
                <div class="buttons">
                    <button class="loginButton">Login</button>
                    <a href = "clientRegister.php"><button type = "button" class="registerButton">Register</button></a>
                </div>
            </form>
        </div>



    </div>


</body>



</html>