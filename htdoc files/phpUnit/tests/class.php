<?php
define('HOST', 'localhost');  
define('USER', 'root');  
define('PASS', 'root');  
define('DB', 'test');  

class DB  
  
{  
    function __construct() {  
        /*$con = mysql_connect(HOST, USER, PASS) or die('Connection Error! '.mysql_error());  
        mysql_select_db(DB, $con) or die('DB Connection Error: ->'.mysql_error()); */ 
        $con = mysqli_connect("localhost", "root", "", "test");
        if(!$con)
        {
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
        }

    //$user_check = $_SESSION['user'];
    }  
}  
  
class User  
  
{  
    public  
  
    function __construct() {  
        $db = new DB;  
    }  
  
    public  
  
    function register($email, $password) {  
        $password = md5($password);  
        $checkuser = mysqli_query("Select * from users where email='$email'");  
        $result = mysqli_num_rows($checkuser);  
        if ($result == 0) {  
            $register = mysqli_query("Insert into users (email, password) values ('$email','$password')") or die(mysqli_error());  
            return $register;  
        } else {  
            return false;  
        }  
    }  

    public  
    //this for adding fullname, address, city, state, zipcode. into the database.
    function profileManage($email,$fullName, $address1, $address2, $city, $state) {  
        //$password = md5($password);  
        $checkuser = mysqli_query("Select id from users where email='$email'");  
        $result = mysqli_num_rows($checkuser);  
        if ($result == 0) {  
            $register = mysqli_query("Insert into 'users' ('email', 'password') values ('$email','$password')") or die(mysqli_error());  
            return $register;  
        } else {  
            return false;  
        }  
    }  
  
    public  
  
    function login($email, $password) {  
        $password = md5($password);  
        $check = mysqli_query("Select * from users where email='$email' and password='$password'");  
        $data = mysqli_fetch_array($check);  
        $result = mysqli_num_rows($check);  
        if ($result == 1) { 
            if($data['fullName'] == NULL){
                header("location: ../clientProfileManage.php");
            }
            
            $_SESSION['login'] = true; 
            header("location: ../fuel_quote.php");
            //header("location: ../clientProfileManage.php"); 
            //$_SESSION['id'] = $data['id'];  
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