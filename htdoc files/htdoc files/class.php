<?php
define('HOST', 'localhost');  
define('USER', 'root');  
define('PASS', 'root');  
define('DB', 'test');  

class DB  
  
{  
    function __construct() {  
        $con = mysql_connect(HOST, USER, PASS) or die('Connection Error! '.mysql_error());  
        mysql_select_db(DB, $con) or die('DB Connection Error: ->'.mysql_error());  
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
        $password = md5($password);  
        $checkuser = mysql_query("Select id from users where email='$email'");  
        $result = mysql_num_rows($checkuser);  
        if ($result == 0) {  
            $register = mysql_query("Insert into users (fulName, username, email, password) values ($fullName','$username','$email','$password')") or die(mysql_error());  
            return $register;  
        } else {  
            return false;  
        }  
    }  
  
    public  
  
    function login($email, $password) {  
        $password = md5($password);  
        $check = mysql_query("Select * from users where email='$email' and password='$password'");  
        $data = mysql_fetch_array($check);  
        $result = mysql_num_rows($check);  
        if ($result == 1) {  
            $_SESSION['login'] = true;  
            $_SESSION['id'] = $data['id'];  
            return true;  
        } else {  
            return false;  
        }  
    }  
  
    public  
  
    function fullname($id) {  
        $result = mysql_query("Select * from users where id='$id'");  
        $row = mysql_fetch_array($result);  
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