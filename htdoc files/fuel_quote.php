<?php

    $con = mysqli_connect('localhost','root','','test') or die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    
    //echo 'success';
    
    error_reporting(0);
    session_start();

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
?>


<html>

<head>
    <title>Fuel Quote</title>
    <link rel="stylesheet" href="styles/fuel_quote.css">
</head>
<body>
    <div class= "logoutLink">
        <a href="logout.php">Logout</a>
    </div>
    <div  class="FormBody">
        <form action="processes/fuel_code_controller.php" method="POST">
            <header>
                <div class="Header">
                    FUEL QUOTE FORM
                </div>
            </header>
        
            <div class="SectionInput">
                <div class="Gallons">
                    User ID:
                    <?php
                        echo "<input type='number' id='txtUserID' name='txtUserID' value='" . $user_id . "' readonly>";
                    ?>
                </div>
                <div class="Gallons">                  
                        Gallons Requested:
                        <input type="number" size="15" id="txtGallon_requested" name="txtGallon_requested" min="0" max="999999999999999" placeholder="0.00" onfocus="this.placeholder = ''" onblur="calculateTotal()" required>
                        <script>
                            function calculateTotal(){
                                document.getElementById("txtTotal_due").value = document.getElementById("txtGallon_requested").value * document.getElementById("txtSuggested_price").value;
                            
                            }
                        </script>
                </div>
                <div class="Address">
                    Delivery Address:
                    <?php 
                        echo "<textarea type='text' style='width: 200px;' id='txtDeliverry_address' name='txtDeliverry_address' placeholder='" . $addr . "' cols='40' rows='3' readonly></textarea>";
                    ?>
                    
                </div>
                <div class="Delivery">
                    Delivery Date:
                    <input type="date" id="txtDelivery_date" name="txtSuggested_price" required>
                    <script type="text/javascript">
                        function checkDateInput() {
                            var dateString = document.getElementById('txtDelivery_date').value;
                            var inputDate = new Date(dateString);
                            var today = new Date();
                            if ( inputDate < today ) { 
                                $('#txtDelivery_date').after('<p>You cannot enter a date in the past!.</p>');
                                return false;
                            }
                            return true;
                        }
                    </script>
                </div>
                <div class="Suggested">
                    Suggested Price:
                    <input type="text" id="txtSuggested_price" name="txtSuggested_price" value="2" readonly>
                    
                </div>
                <div class="Total_input">
                    Total Amount Due:
                    <input type="text" id="txtTotal_due" name="txtTotal_due" value="" readonly>                
                </div>
                <div class="Buttons">
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>
                </div>  
            </div>
        </form> 
         
    </div>
    
</body>
</html>

<?php
    mysqli_close($con);
?>