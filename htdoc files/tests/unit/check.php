<!DOCTYPE html>
<html>
	<head>
		<title>Test calculation total</title>
		
	</head>
	<body>
	<h1> Testing Total</h1>
	<p id="txtTotal_due"> check </p>	
			
		<script>
            
                        function calculateTotal(){
                            var txtSuggested_price= 55.24a;
                            var txtGallon_requested =50;
                            return txtGallon_requested * txtSuggested_price;
                           
                        }
                        document.getElementById("txtTotal_due").innerHTML =calculateTotal();
                   
		</script>
	
	</body>
</html>


