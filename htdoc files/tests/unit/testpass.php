<!DOCTYPE html>
<html>
	<head>
		<title>Test Password</title>
		
	</head>
	<body>
	<h1> Testing Password</h1>
	<p id="demo"> check </p>	
			
		<script>
			var pas1= "texjt__    iyy12242";
			var pas2= "texjt__    iyy12242";
		
			//function to check if the entered password match each other or not.
			function checkPassword(p1,p2) {
				
				if (p1 != p2) {
					alert("Password did not match")
					return false;
				} else {
					alert("Password matched")
					return true;
				}
			}
			document.getElementById("demo").innerHTML = checkPassword(pas1, pas2);
		</script>
	
	</body>
</html>