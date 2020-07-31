

<?php
 /*   $con = mysqli_connect("localhost", "root", "root", "test");
    if(!$con)
    {
        die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    }
    session_start();*/
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Pricing Module</title>
    </head>

</html>

<?php

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
        private $outOfState;
    
        private $test;
    
        public $companyProfitFactor = 0.10;
    
        public function __construct(int $id, float $gallonsRequested,string $dateRequested)
        {
            $this->gallonsRequested = $gallonsRequested;
            $this->dateRequested = $dateRequested;
            
            $this->test = new Database();
            $this->test->query("SELECT * FROM client_information WHERE id = '$id' ");
            $this->client = $this->test->single();
            
            $this->test = new Database();
            $this->test->query("SELECT * FROM fuel_quotes WHERE id = '$id' ");
            $this->clientHistory = $this->test->resultSet();
            
            $this->setLocationFactor();
            $this->setHistoryFactor();
            $this->setGallonsRequestedFactor();
            
        }
    
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
