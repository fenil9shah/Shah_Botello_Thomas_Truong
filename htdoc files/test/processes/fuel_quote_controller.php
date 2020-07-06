
<?php
    class DB    
    {
        function link()
        {              
            $con = mysqli_connect('localhost','root','','test') or die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());  
            return $con;
        }  
        
    } 

    class User{
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
            $userID_query = mysqli_query($db->link(),"SELECT id, fullName, addr1, city, 'state', zipcode FROM users WHERE id = $user_id");
            $row = mysqli_fetch_array($userID_query);
            $addr = $row['addr1'] . $row['city'] . $row['state'] . $row['zipcode'];

            return $addr;
        }
        
    }

    class Fuel_quote{  
        
        public function validation_inputs($id, $user_id,$gallons_requested,$addr,$delivery_date,$suggested_price,$total_amount_due,$created_date){

            $f_quote = new Fuel_quote();

            // Sanitize filterGallon_requested
            $gallons_requested = filter_var(trim($gallons_requested), FILTER_SANITIZE_STRING);

            // Sanitize delivery date
            //$delivery_date = filter_var(trim($delivery_date), FILTER_SANITIZE_STRING);
            
            $dateCurrent = date("Y-m-d");

            //check is it a number?
            if(filter_var($gallons_requested, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9\s]/")))){
                //check number range [0-999999999999999], int(15)
                if($gallons_requested > 0 && $gallons_requested<=999999999999999){
                    // Validate delivery date
                    if(filter_var($delivery_date, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"~^\d{4}-\d{2}-\d{2}$~")))){
                        if($delivery_date > $dateCurrent)
                        {
                            //$f_quote->insert_fuel_quote($)
                        }
                        else{
                            echo "Invalid date<br>";
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

        public function insert_fuel_quote($user_id,$id,$gallons_requested,$delivery_date,$suggested_price,$total_amount_due,$created_date){

        }
        
        //Use to get fuel quotes of a user
        public function get_fuel_quote_history_by_user_id($user_id){

            $db = new DB();
            $user = new User();

            //query to pull data of fuel_quotes table
            $query = mysqli_query($db->link(), "SELECT * FROM fuel_quotes WHERE userid = $user->getUser->user_id");
            foreach($query as $row){
                $row = mysqli_fetch_array($query);
                echo "User ID   "."ID   "."Gallons requested    "."Delivery date    "."Suggested price  "."Total amount due  "."Created date    ";
                echo $row["userid"] . "    " .$row["id"] . "    " .$row["gallons_requested"] . "    " .
                $row["delivery_date"] . "    " .$row["suggested_price"] . "    " .$row["total_amount_due"] . "    " .$row["created_date"];
            }
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
    phpinfo();
?>
