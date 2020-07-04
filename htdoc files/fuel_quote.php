<?php
    $con = mysqli_connect("localhost", "root", "root", "test");
    if(!$con)
    {
        die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    }
    session_start();

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
    
        public $companyProfitFactor = 0.10;
    
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
    <form class="FormBody">
        <header>
            <div class="Header">
                FUEL QUOTE FORM
            </div>
        </header>
    
        <div class="SectionInput">
            <div class="Gallons">                  
                    Gallons Requested:
                    <input type="number" size="16" id="txtGallon_requested" name="txtGallon_requested" min="0" placeholder="0.00" onfocus="this.placeholder = ''" onblur="calculateTotal()" required>
                    <script>
                        function calculateTotal(){
                            document.getElementById("txtTotal_due").value = document.getElementById("txtGallon_requested").value * document.getElementById("txtSuggested_price").value;
                           
                        }
                    </script>
            </div>

            <div class="Address">
                Delivery Address:
                <textarea type="text" style="width: 200px;" name="txtDeliverry_address" placeholder="123 streeet 1, Anywhere, US, 77212" cols="40" rows="3" readonly></textarea>
            </div>

            <div class="Delivery">
                Delivery Date:
                <input type="date" id="txtDelivery_date">
                
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
                <button name="btnQuote">Get Quote</button>
                <button name="btnSubmit">Submit</button>
                <button name="btnReset" type="reset" value="submit">Reset</button>

            </div>  
        </div>
    </form>    
</body>

</html>
