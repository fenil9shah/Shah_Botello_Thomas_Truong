<?php
session_start();

define('HOST', 'localhost');  
define('USER', 'root');  
define('PASS', '');  
define('DB', 'test');  

class DB  
  
{  
    function __construct() {  
        $con = mysqli_connect(HOST, USER, PASS) or die('Connection Error! '.mysqli_error());  
        // mysqli_select_db(DB, $con) or die('DB Connection Error: ->'.mysqli_error());  
    }  
}  
  
class User  
  
{  
    public  
  
    function __construct() {  
        $db = new DB;  
    }  
  
    public  
  
    function register($fullName, $username, $email, $password) {  
      //  $password = md5($password);  
        $checkuser = mysqli_query("Select id from users where email='$email'");  
        $result = mysqli_num_rows($checkuser);  
        if ($result == 0) {  
            $register = mysqli_query("Insert into users (fulName, username, email, password) values ($fullName','$username','$email','$password')") or die(mysql_error());  
            return $register;  
        } else {  
            return false;  
        }  
    }  
  
    public  
  
    function login($email, $password) {  
     //   $password = md5($password);  
        $check = mysqli_query(mysqli_connect(HOST, USER, PASS, "test2"), "SELECT * from `users` where email='$email' and password='$password'");  
        $data = mysqli_fetch_array($check);  
        $result = mysqli_num_rows($check);
        if ($result == 1) {  
            $_SESSION['user'] = $email;  
            $_SESSION['id'] = $data['id'];  
            return true;  
        } else {  
            return false;  
        }  
    }

    public function checkCredentials($email, $password){
        $check = mysqli_query(mysqli_connect(HOST, USER, PASS, "test2"), "SELECT * from `users` where email='$email' and password='$password'");  
        $data = mysqli_fetch_array($check);  
        if ($data['fullname'] == NULL) {  
            return true;  
        } else {  
            return false;  
        }  
    }
  
    public  
  
    function fullname($id) {  
        $result = mysqli_query("Select * from users where id='$id'");  
        $row = mysqli_fetch_array($result);  
        echo $row['fullName'];  
    }  
  
    public  
  
    function session() {  
        if (isset($_SESSION['login'])) {  
            return $_SESSION['login'];  
        }  
    }  
  
    public  
  
    function logout() {  
        $_SESSION['login'] = false;  
        session_destroy();  
    }  
}  
  
?>  