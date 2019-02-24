<?php
	$conn = mysqli_connect('localhost','root','','db_griffin');
	if (!$conn) {
		echo "<script> alert('Not Connected'); </script>";
	}
?>