<html>abcd</html>
<?php
    //error_reporting(0);
    //session_start();
    echo "< window.location('../fuel_quote.php') ><br>";
    echo "Welcome<br>";

    //connect to DB test
    $con = mysqli_connect('localhost','root','','test') or die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

    //hard code for user id:
        $user_id = 2;
    
    //query to pull data of user
    $userID_query = mysqli_query($con,"SELECT id, fullName, addr1, city, 'state', zipcode FROM users WHERE id = $user_id");
    //get data of user from users table
    foreach($userID_query as $urow){
        //echo "inside foreach of users" . $urow["fullName"];
        $username = $urow["fullName"];
        $addr = $urow["addr1"] . $urow["city"] . $urow["state"] . $urow["zipcode"];
        //echo $username;  
    }

    /*
    $user_id = $_POST[''];
    $id = $_POST[''];
    $gallon_requested = $_POST[''];
    $delivery_date = $_POST[''];
    $suggested_price = $_POST[''];
    $total_amount_due = $_POST[''];
    $created_date = $_POST[''];*/

    echo "connect successed<br>";

    $errGallon = $errorDate = "";
    $user_id = $id = $gallon_requested = $delivery_date = $suggested_price = $total_amount_due = $created_date = "";
    


    //function to filter gallon requested
    function filterGallon_requested($field){
        echo "filterGallon_requested<br>";

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
        echo "filterDelivery_date<br>";

        // Sanitize delivery date
        $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
        
        $dateCurrent = getdate('Y-m-d');
        // Validate delivery date
        if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"~^\d{4}/\d{2}/\d{2}$~")))){
            if($field > $dateCurrent)
                return $field;
            else{
                echo "Invalid date<br>";
                return FALSE;
            }
                
        } else{
            return FALSE;
        }
    }
    //catch POST
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        echo "REQUEST_METHOD<br>";

        if(empty($_POST["txtGallon_requested"])){
            $errGallon = "Gallon is required<br>";
        }else{
            $gallon_requested = filterGallon_requested($_POST["txtGallon_requested"]);
        }

        if(empty($_POST["txtDelivery_date"])){
            $errorDate = "Gallon is required<br>";
        }else{
            $gallon_requested = filterDelivery_date($_POST["txtGallon_requested"]);
        }

        $user_id = $_POST["txtUserID"];
        $id = 4;//need fix for auto increase, not required in assignment 3===================================================
        $addr = $_POST["txtDeliverry_address"];
        $gallon_requested = $_POST["txtGallon_requested"];
        //$delivery_date = $_POST["txtDelivery_date"];//check for insert a date in next assignment==========================
        $delivery_date = "2020-02-02";
        $suggested_price = $_POST["txtSuggested_price"];
        $total_amount_due = $_POST["txtTotal_due"];
        //$created_date = $dateCurrent;//check for insert a date in next assignment==========================
        $created_date = "2020-05-05";
        //insert
        $sql = "INSERT INTO fuel_quotes (userid,id,gallons_requested,delivery_date,suggested_price,total_amount_due,created_date)
                VALUES($user_id,$id,$gallon_requested,$delivery_date,$suggested_price,$total_amount_due,$created_date)";

        if(mysqli_query($con,$sql)){
            echo"Success<br>";
        }else{
            echo"<br>Error". $sql . "<br>" . $con->error;
        }
    }

    //mysqli_close($con);
?>

<html>
    <header></header>
    <body>
        <div>
            <form style="overflow:scroll; height:500" >              
                <table>
                    <tr>
                        <th>Client Name</th>
                        <th>Gallons Requested</th>
                        <th>Delivery Address</th>
                        <th >Delivery Date</th>
                        <th >Suggested Price</th>
                        <th >Total Amount Due</th>
                        <th >Date created</th>
                    </tr>
                    <?php
                        //use to count fuel quote histories of a user
                        //$count = 0;

                        //query to pull data of fuel_quotes table
                        $query = mysqli_query($con, "SELECT * FROM fuel_quotes WHERE userid = $user_id");
                        //get data of each user id matched history
                        foreach($query as $row){
                            //$count++;
                            //echo "inside foreach of history";
                            echo"<tr><td >" . $username . "</td><td >" 
                                            . $row["gallons_requested"] . "</td><td>"
                                            . $addr . "</td><td >"
                                            . $row["delivery_date"] . "</td><td >"
                                            . $row["suggested_price"] . "</td><td>"
                                            . $row["total_amount_due"] . "</td><td >"
                                            . $row["created_date"] . 
                                "</td></tr>";
                        }
                    ?>
                    
                </table>
            </form>  
        </div>
        
    </body>
</html>
