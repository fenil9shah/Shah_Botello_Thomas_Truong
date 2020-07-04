<?php
    error_reporting(0);
    session_start();

    //connect to DB test
    $con = mysqli_connect('localhost','root','','test') or die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

    
?>