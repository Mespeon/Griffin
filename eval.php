<!DOCTYPE html>
<html>
<head>
	<title>Self-Assessment Test</title>
</head>
<?php
	require('conn.php');
?>
<body>
	<form action="POST">
		<center>
			<table border="1">
				<thead>
					<tr>
						<td>No.</td>
						<td>Statement</td>
						<td>1</td>
						<td>2</td>
						<td>3</td>
						<td>4</td>
						<td>5</td>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$query = mysqli_query($conn,"SELECT * FROM `tb_eval` ORDER BY rand()");

						while ($row = mysqli_fetch_array($query)){
							$Itemid = $row['id'];
							$userid = $row['id'];
							$eval = $row['evaluation'];
						echo "<tr>
								<td>".$no."</td>
								<td>".$eval."</td>
								<td>
									<input type='radio' name='item".$Itemid."' value='1' required>
								</td>
								<td>
									<input type='radio' name='item".$Itemid."' value='2' required>
								</td>
								<td>
									<input type='radio' name='item".$Itemid."' value='3' required>
								</td>
								<td>
									<input type='radio' name='item".$Itemid."' value='4' required>
								</td>
								<td>
									<input type='radio' name='item".$Itemid."' value='5' required>
								</td>
							</tr>	
							";
							$no++;
						}
					?>
					<td colspan="7" align="center">
						<button type="submit" name="btn_sub">SUBMIT</button>
					</td>
				</tbody>
			</table>
		</center>
	</form>
	<?php
		if(isset($_POST['btn_sub'])){
			$item1 = $_POST['item1'];
			$item2 = $_POST['item2'];
			$item3 = $_POST['item3'];
			$item4 = $_POST['item4'];
			$item5 = $_POST['item5'];
			$item6 = $_POST['item6'];
			$item7 = $_POST['item7'];
			$item8 = $_POST['item8'];
			$item9 = $_POST['item9'];
			$item10 = $_POST['item10'];
			$item11 = $_POST['item11'];
			$item12 = $_POST['item12'];
			$item13 = $_POST['item13'];
			$item14 = $_POST['item14'];
			$item15 = $_POST['item15'];
			$item16 = $_POST['item16'];
			$item17 = $_POST['item17'];
			$item18 = $_POST['item18'];
			$item19 = $_POST['item19'];
			$item20 = $_POST['item20'];
			$item21 = $_POST['item21'];
			$item22 = $_POST['item22'];
			$item23 = $_POST['item23'];
			$item24 = $_POST['item24'];
			$item25 = $_POST['item25'];
			$item26 = $_POST['item26'];
			$item27 = $_POST['item27'];
			$item28 = $_POST['item28'];
			$item29 = $_POST['item29'];
			$item30 = $_POST['item30'];
			$item31 = $_POST['item31'];
			$item32 = $_POST['item32'];
			$item33 = $_POST['item33'];
			$item34 = $_POST['item34'];
			$item35 = $_POST['item35'];
			$item36 = $_POST['item36'];
			$item37 = $_POST['item37'];
			$item38 = $_POST['item38'];
			$item39 = $_POST['item39'];
			$item40 = $_POST['item40'];
			$item41 = $_POST['item41'];
			$item42 = $_POST['item42'];
			$item43 = $_POST['item43'];
			$item44 = $_POST['item44'];
			$item45 = $_POST['item45'];


			$sql = mysqli_query($conn,"UPDATE tbl_evaluation SET item1=$i1,item2=$i2,item3=$i3,item4=$i4,item5=$i5,item6=$i6,item7=$i7,item8=$i8,item9=$i9,item10=$i10,item11=$i11,item12=$i12,item13=$i13,item14=$i14,item15=$i15,item16=$i16,item17=$i17,item18=$i18,item19=$i19,item20=$i20,item21=$i21,item22=$i22,item23=$i23,item24=$i24,item25=$i25,item26=$i26,item27=$i27,item28=$i28,item29=$i29,item30=$i30,item31=$i31,item32=$i32,item33=$i33,item34=$i34,item35=$i35,item36=$i36,item37=$i37,item38=$i38,item39=$i39,item40=$i40,item41=$i41,item42=$i42,item43=$i43,item44=$i44,item45=$i45, status='OK' WHERE userid='$userid'");
		}
	?>
</body>
</html>
