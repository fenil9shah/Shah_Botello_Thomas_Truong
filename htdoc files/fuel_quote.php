<?php
    session_start();
    include_once 'processes/fuel_quote_controller.php';
    include_once 'processes/pricing_module.php';
    
    error_reporting(0);

    //init classes
    $user = new User1();
    $f_quote = new Fuel_quote();

    $userID = $_SESSION['id'];

    $gallons_requested = $_POST['txtGallon_requested'];

    $price = new pricingModule();
    $suggested = $price->get_suggested_price($gallons_requested);

    //catch method POST
    if ($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['submit'])){
        $suggested = $price->get_suggested_price($gallons_requested);
        $total = $gallons_requested * $suggested;

        $f_quote->validation_inputs($total, $suggested);
        $f_quote->get_fuel_quote_history_by_user_id($userID);

        $gallons_requested = 0.00;
        $suggested = $price->get_suggested_price($gallons_requested);
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
        <form action="" method="POST">
            <header>
                <div class="Header">
                    FUEL QUOTE FORM
                </div>
            </header>
        
            <div class="SectionInput">
                <div class="Gallons">
                        Gallons Requested:
                        <input type="number" size="15" id="txtGallon_requested" name="txtGallon_requested" min="0" max="999999999999999" placeholder="<?=$gallons_requested?>" onfocus="this.placeholder = ''" required>
                        <script>
                            function calculateTotal(){
                                document.getElementById("txtTotal_due").value = document.getElementById("txtGallon_requested").value * document.getElementById("txtSuggested_price").value;
                            
                            }
                        </script>
                </div>
                <div class="Address">
                    Delivery Address:
                    <?php
                        $user = new User1();
                        echo "<textarea type='text' style='width: 200px;' id='txtDeliverry_address' name='txtDeliverry_address' placeholder='" . $user->get_user_address($userID) . "' cols='40' rows='3' readonly></textarea>";
                    ?>
                    
                </div>
                <div class="Delivery">
                    Delivery Date:
                    <input type="date" id="txtDelivery_date" name="txtDelivery_date" required>
                    <script type="text/javascript">
                        function checkDateInput() {
                            var dateString = document.getElementById('txtDelivery_date').value;
                            var inputDate = new Date(dateString);
                            var today = new Date();
                            if ( inputDate < today ) {
                                $('txtDelivery_date').after('<p>You cannot enter a date in the past!.</p>');
                                return false;
                            }
                            alert(dateString);
                            return true;
                        }
                    </script>
                </div>
                <div class="Suggested">
                    Suggested Price:
                    <input type="text" id="txtSuggested_price" name="txtSuggested_price" value="<?=$suggested?>" readonly>
                    
                </div>
                <div class="Total_input">
                    Total Amount Due:
                    <input type="text" id="txtTotal_due" name="txtTotal_due" value="<?=$gallons_requested * $suggested?>" readonly>
                  
                </div>
                <div class="Buttons">
                    <button type = "price" id="checkPrice">Get Price</button>
                    <button type="submit" name = "submit">Submit</button>
                    <button type="reset">Reset</button>
                    <button onclick="location.href='fuel_quote_history.php'"type="button">Show History</button>
                </div>
            </div>
        </form>
         
    </div>
    
</body>
</html>
