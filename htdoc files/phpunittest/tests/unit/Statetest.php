<!DOCTYPE html>
<html>
	<head>
		<title>State test</title>
		
	</head>
	<body>
	<h1> Testing State </h1>
	<p id="StateCheck"> check </p>	
			
	<script>
    var state ="@-#$";
    // to check if a State is selected or not.
   function stateCheck(checkState){
            if (checkState === '') {
                alert("Please select a State !");

                return false;
            } else {
                return true;
            }
        }
        document.getElementById("StateCheck").innerHTML =stateCheck(state);
</script>
	</body>
</html>


