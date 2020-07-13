<?php
    session_start();
    include_once 'processes/fuel_quote_controller.php';
    
    //init classes
    $user = new User();
    $f_quote = new Fuel_quote();


    //catch method POST
    if($_SERVER["REQUEST_METHOD"]=="POST"){

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
                    User ID:
                    <input type='number' id='txtUserID' name='txtUserID' value="2" readonly>
                    
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
                        $user = new User();
                        echo "<textarea type='text' style='width: 200px;' id='txtDeliverry_address' name='txtDeliverry_address' placeholder='" . $user->get_user_address(2) . "' cols='40' rows='3' readonly></textarea>";
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