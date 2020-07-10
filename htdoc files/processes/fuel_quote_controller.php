
<?php
    class DB    
    {
        function link()
        {              
            $con = mysqli_connect('localhost','root','','test') or die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());  
            return $con;
        }  
        
    } 

    class User1{
        public function get_user_name($user_id){

            $db = new DB();

            //query to pull data of user
            $userID_query = mysqli_query($db->link(),"SELECT id, fullName, addr1, city, 'state', zipcode FROM users WHERE id = $user_id");
            $row = mysqli_fetch_array($userID_query);
            $username = $row['fullName'];

            return $username;
        }

        public function get_user_address($user_id){
            $db = new DB();

            //query to pull data of user
            $userID_query = mysqli_query($db->link(),"SELECT id, fullName, addr1, city, state, zipcode FROM users WHERE id = $user_id");
            $row = mysqli_fetch_array($userID_query);
            $addr = $row['addr1'] . " " . $row['city'] . ", " . $row['state'] . " " . $row['zipcode'];

            return $addr;
        }
        
    }

    class Fuel_quote{  
        
        public function validation_inputs(){
            $f_quote = new Fuel_quote();



            // Sanitize filterGallon_requested
            //$gallons_requested = filter_var(trim($gallons_requested), FILTER_SANITIZE_STRING);

            // Sanitize delivery date
            //$delivery_date = filter_var(trim($delivery_date), FILTER_SANITIZE_STRING);
            //$timestamp = time();
            //$dateCurrent = date("Y-m-d",$timestamp);

            $dateCurrent = date("Y-m-d");

            $user_id = $_SESSION['id'];
            $gallons_requested = $_POST['txtGallon_requested'];
            $addr = $_POST['txtDeliverry_address'];
            $delivery_date = $_POST['txtDelivery_date'];
            $suggested_price = $_POST['txtSuggested_price'];
            $total_amount_due = $_POST['txtTotal_due'];
            $created_date = $dateCurrent;

            print($dateCurrent);

            //check is it a number?
            if(filter_var($gallons_requested, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9\s]/")))){
                //check number range [0-999999999999999], int(15)
                if($gallons_requested > 0 && $gallons_requested<=999999999999999){
                    // Validate delivery date
                    if(filter_var($delivery_date, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"~^\d{4}-\d{2}-\d{2}$~")))){
                        //Make sure date input is not current or past
                        if($delivery_date == $dateCurrent)
                        {                            
                            $f_quote->insert_fuel_quote($user_id,$gallons_requested,$delivery_date,$suggested_price,$total_amount_due, $delivery_date);
                            echo "<a style='color:blue;'>Fuel quote send successful ! </a><br>";
                        }
                        else{
                            echo "<a style='color:red;'>Invalid date</a><br>";
                        }
                            
                    } else{
                        echo "";
                    }
                    echo"";
                }                    
                else
                    echo "the amount of gallon requested must larger 0 and smaller 999,999,999,999,999<br>";
            } else{
                echo "Gallons requested must be a number!<br>";
            }
        }

        public function insert_fuel_quote($user_id,$gallons_requested,$delivery_date,$suggested_price,$total_amount_due,$created_date){
            $created_date = date("Y-m-d");
            $db = new DB();
            $user = new User1();

            //query to pull data of fuel_quotes table
            $query = mysqli_query($db->link(), "INSERT INTO `fuel_quotes` (`userid`, `gallons_requested`, `delivery_date`, `suggested_price`, `total_amount_due`, `created_date`)
                                                 VALUES ('$user_id','$gallons_requested','$delivery_date','$suggested_price','$total_amount_due','$created_date');

            ");            
        }
        
        //Use to get fuel quotes of a user
        public function get_fuel_quote_history_by_user_id($user_id){

            $db = new DB();
            $user = new User();

            $fuel_history_array = array();//to store fuel_quote history of a user
            $r = $c =0; // use for input array, r = row, c = column
            
            //echo "User ID   "."ID   "."Gallons requested    "."Delivery date    "."Suggested price  "."Total amount due  "."Created date    ";
            //query to pull data of fuel_quotes table
            $query = mysqli_query($db->link(), "SELECT * FROM fuel_quotes WHERE userid = $user_id");
            foreach($query as $row){
                //echo $row["userid"] . "    " .$row["id"] . "    " .$row["gallons_requested"] . "    " .
                //$row["delivery_date"] . "    " .$row["suggested_price"] . "    " .$row["total_amount_due"] . "    " .$row["created_date"]."|";
                $fuel_history_array[$r][$c++] = $row["userid"];
                $fuel_history_array[$r][$c++] = $row["id"];
                $fuel_history_array[$r][$c++] = $row["gallons_requested"];
                $fuel_history_array[$r][$c++] = $row["delivery_date"];
                $fuel_history_array[$r][$c++] = $row["suggested_price"];
                $fuel_history_array[$r][$c++] = $row["total_amount_due"];
                $fuel_history_array[$r][$c++] = $row["created_date"];
                $c=0;
                $r+=1;
            }
            /*
            for($i = 0; $i <5; $i++){
                echo"<br>record number #".$i.":";
                for($j = 0; $j <7; $j++){
                    echo ",".$fuel_history_array[$i][$j];
                }
                echo"<br>";
            }*/
        }
    }  
   

    //Pricing module to calculate suggested price and total amount due
    class PricingModule{
        private $client;
        private $clientHistory;
        private $pricePerGallon = 1.50;
        private $locationFactor;
        private $rateHistoryFactor;
        private $gallonsRequestedFactor;
        private $companyProfitFactor;
        public $gallonsRequested;
        private $deliveryRequested;
        private $deliveryAddress;
        private $outOfState;
    
        private $test;
    
        public $companyProfitFactorPb = 0.10;//==========================conflict with line 30 so I added Pb at the end as public
    
        public function setLocationFactor(){
            $this->outOfState = ($this->client->state != "TX") ? true : false;
            $this->locationFactor = ($this->outOfState) ? 0.04 : 0.02;
        }
    
        public function setHistoryFactor(){
            $this->rateHistoryFactor = (!empty($this->clientHistory)) ? 0.01 : 0;
        }
    
        public function setGallonRequestedFactor(){
            $this->gallonsRequestedFactor = (($this->gallonsRequested) > 1000) ? 0.02 : 0.03;
        }
    
        public function margin(){
            ($this->locationFactor - $this->rateHistoryFactor + $this->gallonsRequestedFactor + $this->companyProfitFactor) * $this->pricePerGallon;
        }
    
        //suggested price = price per gallon + margin
        public function suggestedPricePerGallon(){
            return $this->pricePerGallon + $this->margin;
        }
    
        public function totalAmountDue(){
            return $this->gallonsRequested * $this->suggestedPricePerGallon;
        }
    }
    //phpinfo();
?>
