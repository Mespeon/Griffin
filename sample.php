<!DOCTYPE html>
<html>
<head>
	<title>Griffin</title>
</head>
<?php  
	$conn = mysqli_connect('localhost','root','','db_griffin');
	if (!$conn) {
		echo "<script> alert('Not Connected'); </script>";
	}
	$msg = "'Get up 15 minutes earlier'";
?>
<body>
	<script>
		
	</script>
	<center>
		<button onclick="sta()">START</button>
	</center>
</body>
</html>