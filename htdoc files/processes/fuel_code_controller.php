<html>abcd</html>
<?php
    //error_reporting(0);
    //session_start();
    echo "< window.location('../fuel_quote.php') >";
    echo "Welcome";

    //connect to DB test
    $con = mysqli_connect('localhost','root','','test') or die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    /*
    $user_id = $_POST[''];
    $id = $_POST[''];
    $gallon_requested = $_POST[''];
    $delivery_date = $_POST[''];
    $suggested_price = $_POST[''];
    $total_amount_due = $_POST[''];
    $created_date = $_POST[''];*/

    echo "connect successed";

    $errGallon = $errorDate = "";
    $user_id = $id = $gallon_requested = $delivery_date = $suggested_price = $total_amount_due = $created_date = "";
    


    //function to filter gallon requested
    function filterGallon_requested($field){
        echo "filterGallon_requested";

        // Sanitize filterGallon_requested
        $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
        
        // Validate filterGallon_requested
        //check is it a number?
        if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9\s]/")))){
            //check number range [0-999999999999999], int(15)
            if($field > 0 && $field<=999999999999999)
                return $field;
            else
                return FALSE;
        } else{
            return FALSE;
        }
    }

    //function to filter delivery date
    function filterDelivery_date($field){
        echo "filterDelivery_date";

        // Sanitize delivery date
        $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
        $dateCurrent = date("Y/m/d");
        // Validate delivery date
        if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"~^\d{4}/\d{2}/\d{2}$~")))){
            if($field > $dateCurrent)
                return $field;
            else
                return FALSE;
        } else{
            return FALSE;
        }
    }
    //catch POST
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        echo "REQUEST_METHOD";

        if(empty($_POST["txtGallon_requested"])){
            $errGallon = "Gallon is required";
        }else{
            $gallon_requested = filterGallon_requested($_POST["txtGallon_requested"]);
        }

        if(empty($_POST["txtDelivery_date"])){
            $errorDate = "Gallon is required";
        }else{
            $gallon_requested = filterDelivery_date($_POST["txtGallon_requested"]);
        }
        $user_id = $_POST["txtUserID"];
        $id = $_POST["txtGallon_requested"];
        $gallon_requested = $_POST["txtDeliverry_address"];
        $delivery_date = $_POST["txtDelivery_date"];
        $suggested_price = $_POST["txtSuggested_price"];
        $total_amount_due = $_POST["txtTotal_due"];
        $created_date = $dateCurrent;

        //insert
        $sql = "INSERT INTO fuel_quotes (userid,id,gallons_requested,delivery_date,suggested_price,total_amount_due,created_date)
                VALUES($user_id,$id,$gallon_requested,$delivery_date,$suggested_price,$total_amount_due,$created_date)";

        if(mysqli_query($con,$sql)){
            echo"Success";
        }else{
            echo"Error";
        }
    }

    mysqli_close($con);
?>
