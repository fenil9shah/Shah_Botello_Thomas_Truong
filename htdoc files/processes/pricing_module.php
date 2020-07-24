<?php

    class PricingModule{
        public function get_suggested_price(){

            echo"Call successed<br>";//Testing

            $db = new DB();//conection string to DB
            $user = new User();

            $current_price_per_gallon =1.5; //current price per gallon  

            $user_id = $_POST['txtUserID'];//get user ID============================================== Need help to take ID from session!
            
            //calculate location_factor
            $check_in_state = ($user->get_user_state($user_id) == "TX")? true:false;//check if the user is in state or not
            $location_factor = ($check_in_state)? 0.02: 0.04;

            //calculate rate_history_factor
            $query = mysqli_query($db->link(), "SELECT * FROM fuel_quotes WHERE userid = $user_id");//get records from fuel_quote tables
            $check_fuel_quote_history = !empty($query)? true:false;//check if the table is empty or not
            $rate_history_factor = ($check_fuel_quote_history)? 0.01 : 0;

            //calculate gallons_requested_factor
            $gallons_requested = $_POST['txtGallon_requested'];
            $gallons_requested_factor = ($gallons_requested > 1000)? 0.02:0.03; 

            $company_profit_factor = 0.1; // always 10%
            
            //Calculate margin
            $margin = $current_price_per_gallon * ($location_factor - $rate_history_factor + $gallons_requested_factor + $company_profit_factor);

            //calculate for suggested price
            $suggested_price = $current_price_per_gallon + $margin;

            echo "Suggested price: ",$suggested_price;//Testing

            //change value for input tag in front end
            $_POST["txtSuggested_price"] = $suggested_price;
        }
    }

?>