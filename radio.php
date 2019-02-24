<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="mystyle.css">
  <script src="jquery-1.12.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="shortcut icon" type="image/png" href="images/favicon.png"/> 
  <title>CDSL-TBI ver 1.0</title>
  <style>
	th{
		text-align: center;
	}
  .navbar {
      margin-bottom: 0;
      background-color: #337ab7;
      border: 0;
  }
  .navbar li a, .navbar .navbar-brand { 
      color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
      color: #fff !important;
  }
  .navbar-nav li.active a {
      color: #fff !important;
      background-color: #337ab7 !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
  }
  .open .dropdown-toggle {
      color: #fff;
      background-color: #337ab7 !important;
  }
  .dropdown-menu li a {
      color: #000 !important;
  }
  .dropdown-menu li a:hover {
      background-color: #337ab7 !important;
  }
  </style>
</head>

<body>
<?php
	include "dbconnection.php";
	session_start();
?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">TBI v1.0</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav navbar-left">
			<li><a href="main.php">HOME</a></li>
			<li class="active"><a href="evaluation.php">EVALUATION</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<?php
					$sql = "SELECT * FROM tbl_student WHERE user_id=".$_SESSION['uname'];
					$query = mysqli_query($conn,$sql);
					$row = mysqli_fetch_array($query);
					
					echo "WELCOME! ".$row['studentname'];
				?>
			  <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="changepassword.php">Change Password</a></li>
				<li><a href="logout.php">Logout</a></li>
			  </ul>
			</li>
		</ul>
    </div>
  </div>
</nav>

<div class="col-md-12">
<?php	
	if($_GET['for']=="faculty")
	{
?>
	<div class="container col-md-offset-2 col-md-8"  style="margin-top:5%;">
		<h3 align="center"><strong>FACULTY EVALUATION</strong></h3>
		
		<div class="row">
			<div class="col-md-3">
			<?php
				$sql = "SELECT * FROM tbl_faculty WHERE user_id=".$_GET['fac'];
				$query = mysqli_query($conn,$sql);
				$row = mysqli_fetch_array($query);
				$fno = $row['user_id'];
				$ln = $row['lastname'];
				$fn = $row['firstname'];
				$mn = $row['middlename'];
				$img = $row['image'];
				$imgsrc = "images//faculty//" . $img;
				echo "<img src='$imgsrc' class='img-responsive'>"; 
			?>			
			</div>	
			<div class="col-md-9">
				<form class="form-horizontal" role="form">
					 <div class="form-group">
						<p class="control-label col-sm-3">Faculty Name:</p>				
						<label class="control-label col-sm-9" style="text-align:left;"><?php echo $fno." - ".$ln.", ".$fn." ".$mn; ?></label>
					 </div>
					 <div class="form-group">
						<p class="control-label col-sm-3">Subject:</p>
						<?php
							$sql = "SELECT * FROM tbl_subject WHERE subj_code='".$_GET['subj']."'";
							$query = mysqli_query($conn,$sql);
							$row = mysqli_fetch_array($query);
							$code = $row['subj_code'];
							$desc = $row['subj_desc'];
						?>							
						<label class="control-label col-sm-9" style="text-align:left;"><?php echo $code." - ".$desc; ?></label>
					 </div>
					 <div class="form-group">
						<p class="control-label col-sm-3">Section:</p>
						<label class="control-label col-sm-9" style="text-align:left;"><?php echo $_GET['sec']; ?></label>
					 </div>				 
					 <div class="form-group">
						<p class="control-label col-sm-3">Day and Time:</p>
						<label class="control-label col-sm-9" style="text-align:left;"><?php echo $_GET['sched']; ?></label>
					 </div>				 
					 <div class="form-group">
						<p class="control-label col-sm-3">Room:</p>
						<label class="control-label col-sm-9" style="text-align:left;"><?php echo $_GET['room']; ?></label>
					 </div>					 
				</form>	
			</div>
		</div>
		<div class="row text-danger">
			<p><strong><span class="glyphicon glyphicon-info-sign"></span> Please select an item to the right that corresponds to your answer to each statement.</strong></p>
		</div>	
		<form method="POST">		
			<div class="row">
				 <table class="table table-hover">
					<thead>
						<tr>
							<th colspan="1" width="65%"></th>
							<th width="7%" style="text-align:center;">Never<br>(1)</th>
							<th width="7%" style="text-align:center;">Sometimes<br>(2)</th>
							<th width="7%" style="text-align:center;">Regularly<br>(3)</th>
							<th width="7%" style="text-align:center;">Often<br>(4)</th>
							<th width="7%" style="text-align:center;">Always<br>(5)</th>			
						</tr>
					</thead>
					<tbody>
					<?php
						$sql = "SELECT * FROM tbl_item";
						$query = mysqli_query($conn,$sql);
						$no=1;
						while($item_row = mysqli_fetch_array($query))
						{
							$choice_index = $item_row['itemID'];
							$choice_item = $item_row['itemStatement'];
							if($no<=17)
							{
					?>			
							<tr>
								<td>
									<label style="text-align:left;"><?php echo $no.". ".$choice_item; ?></label>
								</td>		
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="1" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="2" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="3" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="4" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="5" required>
								</td>				  
							</tr>
					<?php
							}
							else
							{
					?>
							<tr>
								<td>
									<label style="text-align:left;"><?php echo $no.". ".$choice_item; ?></label>
								</td>
								<td colspan="5">
									<textarea class="form-control col-md-12" rows="5" name="<?php echo 'i'.$choice_index; ?>"></textarea>
								</td>	
							<tr>
					<?php
							}
							$no++;
						}
					?>				
					</tbody>
				</table>
			</div>
			<button type="submit" class="col-md-offset-10 col-md-2 btn btn-primary btn-lg" name="btnsubmit">SUBMIT</button>
		</form>
	</div>
<?php
	}
	else if($_GET['for']=="caf")
	{
?>

	<div class="container col-md-offset-2 col-md-8" style="margin-top:5%;">
		<h3 align="center"><strong>CLASSROOM AND FACILITY EVALUATON</strong></h3>			
		<div class="row text-danger">
			<p><strong><span class="glyphicon glyphicon-info-sign"></span> Please select an item to the right that corresponds to your answer to each statement.</strong></p>
		</div>	
		<form method="POST">
			<div class="row">
				 <table class="table table-hover">
					<thead>
					  <tr>
						<th colspan="1" width="70%">CLASSROOM</th>
						<th width="10%" style="text-align:center;">YES</th>
						<th width="10%" style="text-align:center;">NO</th>
						<th width="10%" style="text-align:center;">N/A</th>		
					  </tr>
					</thead>
					<tbody>
					<?php
						$sql = "SELECT * FROM tbl_cafitem";
						$query = mysqli_query($conn,$sql);
						$no=1;
						while($item_row = mysqli_fetch_array($query))
						{
							$choice_index = $item_row['cafitemID'];
							$choice_item = $item_row['cafitemStatement'];
							if($no<=9)
							{
					?>			
							<tr>
								<td>
									<label style="text-align:left;"><?php echo $no.". ".$choice_item; ?></label>
								</td>		
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="1" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="2" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="3" required>
								</td>				  
							</tr>
					<?php
							}

							$no++;
						}
					?>				
					</tbody>
				</table>
			</div>
			<div class="row">
				 <table class="table table-hover">
					<thead>
					  <tr>
						<th colspan="1" width="70%">COMPUTER LABORATORY ROOM</th>
						<th width="10%" style="text-align:center;">YES</th>
						<th width="10%" style="text-align:center;">NO</th>
						<th width="10%" style="text-align:center;">N/A</th>		
					  </tr>
					</thead>
					<tbody>
					<?php
						$sql = "SELECT * FROM tbl_cafitem";
						$query = mysqli_query($conn,$sql);
						$no=1;
						while($item_row = mysqli_fetch_array($query))
						{
							$choice_index = $item_row['cafitemID'];
							$choice_item = $item_row['cafitemStatement'];
							if($no>=10&&$no<=13)
							{
					?>			
							<tr>
								<td>
									<label style="text-align:left;"><?php echo $no.". ".$choice_item; ?></label>
								</td>		
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="1" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="2" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="3" required>
								</td>				  
							</tr>
					<?php
							}

							$no++;
						}
					?>				
					</tbody>
				</table>
			</div>			
			
			<div class="row">
				 <table class="table table-hover">
					<thead>
					  <tr>
						<th colspan="1" width="70%">NAT/SCI LABORATORY ROOM</th>
						<th width="10%" style="text-align:center;">YES</th>
						<th width="10%" style="text-align:center;">NO</th>
						<th width="10%" style="text-align:center;">N/A</th>		
					  </tr>
					</thead>
					<tbody>
					<?php
						$sql = "SELECT * FROM tbl_cafitem";
						$query = mysqli_query($conn,$sql);
						$no=1;
						while($item_row = mysqli_fetch_array($query))
						{
							$choice_index = $item_row['cafitemID'];
							$choice_item = $item_row['cafitemStatement'];
							if($no>=14&&$no<=19)
							{
					?>			
							<tr>
								<td>
									<label style="text-align:left;"><?php echo $no.". ".$choice_item; ?></label>
								</td>		
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="1" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="2" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="3" required>
								</td>				  
							</tr>
					<?php
							}

							$no++;
						}
					?>				
					</tbody>
				</table>
			</div>						

			<div class="row">
				 <table class="table table-hover">
					<thead>
					  <tr>
						<th colspan="1" width="70%">RESTROOM</th>
						<th width="10%" style="text-align:center;">YES</th>
						<th width="10%" style="text-align:center;">NO</th>
						<th width="10%" style="text-align:center;">N/A</th>		
					  </tr>
					</thead>
					<tbody>
					<?php
						$sql = "SELECT * FROM tbl_cafitem";
						$query = mysqli_query($conn,$sql);
						$no=1;
						while($item_row = mysqli_fetch_array($query))
						{
							$choice_index = $item_row['cafitemID'];
							$choice_item = $item_row['cafitemStatement'];
							if($no>=20&&$no<=22)
							{
					?>			
							<tr>
								<td>
									<label style="text-align:left;"><?php echo $no.". ".$choice_item; ?></label>
								</td>		
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="1" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="2" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="3" required>
								</td>				  
							</tr>
					<?php
							}

							$no++;
						}
					?>				
					</tbody>
				</table>
			</div>						

			<div class="row">
				 <table class="table table-hover">
					<thead>
					  <tr>
						<th colspan="1" width="70%">DRINKING FOUNTAINS</th>
						<th width="10%" style="text-align:center;">YES</th>
						<th width="10%" style="text-align:center;">NO</th>
						<th width="10%" style="text-align:center;">N/A</th>		
					  </tr>
					</thead>
					<tbody>
					<?php
						$sql = "SELECT * FROM tbl_cafitem";
						$query = mysqli_query($conn,$sql);
						$no=1;
						while($item_row = mysqli_fetch_array($query))
						{
							$choice_index = $item_row['cafitemID'];
							$choice_item = $item_row['cafitemStatement'];
							if($no>=23&&$no<=25)
							{
					?>			
							<tr>
								<td>
									<label style="text-align:left;"><?php echo $no.". ".$choice_item; ?></label>
								</td>		
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="1" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="2" required>
								</td>	
								<td style="text-align:center;">
									<input type="radio" name="<?php echo 'i'.$choice_index; ?>" value="3" required>
								</td>				  
							</tr>				
					<?php
							}
							$no++;
						}
					?>				
					</tbody>
				</table>
			</div>									
	
			<div class="row">
				 <table class="table table-hover">
					<tbody>
					<?php
						$sql = "SELECT * FROM tbl_cafitem";
						$query = mysqli_query($conn,$sql);
						$no=1;
						while($item_row = mysqli_fetch_array($query))
						{
							$choice_index = $item_row['cafitemID'];
							$choice_item = $item_row['cafitemStatement'];
							if($no==26)
							{
					?>			
							<tr>
								<td>
									<label style="text-align:left;"><?php echo $choice_item; ?></label>
								</td>
								<td colspan="5">
									<textarea class="form-control col-md-12" rows="5" name="<?php echo 'i'.$choice_index; ?>" required></textarea>
								</td>	
							<tr>
					<?php
							}

							$no++;
						}
					?>				
					</tbody>
				</table>
			</div>						
			<button type="submit" class="col-md-offset-10 col-md-2 btn btn-primary btn-lg" name="btnsubmitcaf">SUBMIT</button>

		</form>
	</div>
	
<?php		
	}
?>


</div>

<footer id="footer" style="text-align:center;">
	<p>Copyright 2017 &copy; All Rights Reserved <a href="">Colegio de San Lorenzo</a></p>
</footer>	

<?php
	if(isset($_POST['btnsubmit']))
	{
		
		$i1=$_POST['i1'];
		$i2=$_POST['i2'];
		$i3=$_POST['i3'];
		$i4=$_POST['i4'];
		$i5=$_POST['i5'];
		$i6=$_POST['i6'];
		$i7=$_POST['i7'];
		$i8=$_POST['i8'];
		$i9=$_POST['i9'];
		$i10=$_POST['i10'];
		$i11=$_POST['i11'];
		$i12=$_POST['i12'];
		$i13=$_POST['i13'];
		$i14=$_POST['i14'];
		$i15=$_POST['i15'];
		$i16=$_POST['i16'];
		$i17=$_POST['i17'];
		$i18=$_POST['i18'];
		$i19=$_POST['i19'];
		$i20=$_POST['i20'];

		echo "<script> alert('".$i18."'); </script>";
		
		$sql = "UPDATE tbl_evaluation SET item1=$i1,item2=$i2,item3=$i3,item4=$i4,item5=$i5,item6=$i6,item7=$i7,item8=$i8,item9=$i9,item10=$i10,item11=$i11,item12=$i12,item13=$i13,item14=$i14,item15=$i15,item16=$i16,item17=$i17,item18='$i18',item19='$i19',item20='$i20',status='OK' WHERE student_id=".$_SESSION['uname']." AND faculty_id='$fno' AND sched_id=".$_GET['sid'];

		$query = mysqli_query($conn,$sql);
		if($query)
		{
			echo "<script>alert('Your evaluation is successfully saved! Thank you for taking the time to answer this survey.');location.replace('evaluation.php');</script>";
		}
		else
		{
			echo "<script>alert('Error in saving your evaluation!')</script>";
		}
	}
	
	if(isset($_POST['btnsubmitcaf']))
	{
		
		$i1=$_POST['i1'];
		$i2=$_POST['i2'];
		$i3=$_POST['i3'];
		$i4=$_POST['i4'];
		$i5=$_POST['i5'];
		$i6=$_POST['i6'];
		$i7=$_POST['i7'];
		$i8=$_POST['i8'];
		$i9=$_POST['i9'];
		$i10=$_POST['i10'];
		$i11=$_POST['i11'];
		$i12=$_POST['i12'];
		$i13=$_POST['i13'];
		$i14=$_POST['i14'];
		$i15=$_POST['i15'];
		$i16=$_POST['i16'];
		$i17=$_POST['i17'];
		$i18=$_POST['i18'];
		$i19=$_POST['i19'];
		$i20=$_POST['i20'];
		$i21=$_POST['i21'];
		$i22=$_POST['i22'];
		$i23=$_POST['i23'];
		$i24=$_POST['i24'];
		$i25=$_POST['i25'];
		$i26=$_POST['i26'];

		$sql = "UPDATE tbl_cafevaluation SET c1=$i1,c2=$i2,c3=$i3,c4=$i4,c5=$i5,c6=$i6,c7=$i7,c8=$i8,c9=$i9,clr1=$i10,clr2=$i11,clr3=$i12,clr4=$i13,nlr1=$i14,nlr2=$i15,nlr3=$i16,nlr4=$i17,nlr5=$i18,nlr6=$i19,rest1=$i20,rest2=$i21,rest3=$i22,df1=$i23,df2=$i24,df3=$i25,comment='$i26',status='OK' WHERE student_id=".$_SESSION['uname']." AND acad_yr='".$_SESSION['ay']."' AND semester='".$_SESSION['sem']."'";
		
		$query = mysqli_query($conn,$sql);

		if($query)
		{
			echo "<script>alert('Your classroom and facility evaluation is successfully saved! Thank you for taking the time to answer this survey.');location.replace('evaluation.php');</script>";
		}
		else
		{
			echo "<script>alert('Error in saving your classroom and facility evaluation!')</script>";
		}
	}	
?>
</body>
</html>
