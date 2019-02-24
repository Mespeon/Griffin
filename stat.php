<html>
    <head>
        <title>ELMA</title>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="style.css">
	    <link rel="shortcut icon" href="icon.png">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="assets/css/custom.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    </head>

    <?php
        require('conn.php');
        session_start();
        if (!$_SESSION['userid']) {
            header('index.php');
        }

        $userid = $_SESSION['userid'];

        $sql = mysqli_query($conn, "SELECT * FROM tbl_result WHERE `userid` = '$userid'");
        $res = mysqli_fetch_assoc($sql);

        $item1 = $res['item1'];
        $item2 = $res['item2'];
        $item3 = $res['item3'];
        $item4 = $res['item4'];
        $item5 = $res['item5'];
        $item6 = $res['item6'];
        $item7 = $res['item7'];
        $item8 = $res['item8'];
        $item9 = $res['item9'];
        $item10 = $res['item10'];
        $item11 = $res['item11'];
        $item12 = $res['item12'];

        $ave_phy = ($item1+ $item2+ $item3+ $item4+ $item5+ $item6+ $item7+ $item8+ $item9+ $item10+ $item11+ $item12)/12;
        // echo "<script> alert('".$ave_phy."'); </script>";

        if ($ave_phy >= 4.5 && $ave_phy <= 5) {
        	$pcolor = "green";
        }
        elseif ($ave_phy >= 3.5 && $ave_phy <= 4.49) {
        	$pcolor = "yellowgreen";
        }
        elseif ($ave_phy >= 2.5 && $ave_phy <= 3.49) {
        	$pcolor = "yellow";
        }
        elseif ($ave_phy >= 1.5 && $ave_phy <= 2.49) {
        	$pcolor = "Orange";
        }
        elseif ($ave_phy >= 1 && $ave_phy <= 1.49) {
        	$pcolor = "Red";
        }

        $item13 = $res['item13'];
        $item14 = $res['item14'];
        $item15 = $res['item15'];
        $item16 = $res['item16'];
        $item17 = $res['item17'];
        $item18 = $res['item18'];
        $item19 = $res['item19'];
        $item20 = $res['item20'];
        $item21 = $res['item21'];
        $item22 = $res['item22'];
        $item23 = $res['item23'];
        $item24 = $res['item24'];

        $ave_emo = ($item13 + $item14 + $item15 + $item16 + $item17 + $item18 + $item19 + $item20 + $item21 + $item22 + $item23 + $item24)/12;
        // echo "<script> alert('".$ave_emo."'); </script>";
        if ($ave_emo >= 4.5 && $ave_emo <= 5) {
        	$ecolor = "green";
        }
        elseif ($ave_emo >= 3.5 && $ave_emo <= 4.49) {
        	$ecolor = "yellowgreen";
        }
        elseif ($ave_emo >= 2.5 && $ave_emo <= 3.49) {
        	$ecolor = "yellow";
        }
        elseif ($ave_emo >= 1.5 && $ave_emo <= 2.49) {
        	$ecolor = "Orange";
        }
        elseif ($ave_emo >= 1 && $ave_emo <= 1.49) {
        	$ecolor = "Red";
        }

        $item25 = $res['item25'];
        $item26 = $res['item26'];
        $item27 = $res['item27'];
        $item28 = $res['item28'];
        $item29 = $res['item29'];
        $item30 = $res['item30'];

        $ave_spirit = ($item25 + $item26 + $item27 + $item28 + $item29 + $item30)/6;
        // echo "<script> alert('".$ave_spirit."'); </script>";
        if ($ave_spirit >= 4.5 && $ave_spirit <= 5) {
        	$scolor = "green";
        }
        elseif ($ave_spirit >= 3.5 && $ave_spirit <= 4.49) {
        	$scolor = "yellowgreen";
        }
        elseif ($ave_spirit >= 2.5 && $ave_spirit <= 3.49) {
        	$scolor = "yellow";
        }
        elseif ($ave_spirit >= 1.5 && $ave_spirit <= 2.49) {
        	$scolor = "Orange";
        }
        elseif ($ave_spirit >= 1 && $ave_spirit <= 1.49) {
        	$scolor = "Red";
        }

        $item31 = $res['item31'];
        $item32 = $res['item32'];
        $item33 = $res['item33'];
        $item34 = $res['item34'];
        $item35 = $res['item35'];
        $item36 = $res['item36'];
        $item37 = $res['item37'];
        $item38 = $res['item38'];
        $item39 = $res['item39'];
        $item40 = $res['item40'];
        $item41 = $res['item41'];
        $item42 = $res['item42'];
        $item43 = $res['item43'];
        $item44 = $res['item44'];
        $item45 = $res['item45'];
        
        $ave_social = ($item31 + $item32 + $item33 + $item34 + $item35 + $item36 + $item37 + $item38 + $item39 + $item40 + $item41 + $item42 + $item43 + $item44 + $item45)/15;
        // echo "<script> alert('".$ave_spirit."'); </script>";
        if ($ave_social >= 4.5 && $ave_social <= 5) {
            $socolor = "green";
        }
        elseif ($ave_social >= 3.5 && $ave_social <= 4.49) {
            $socolor = "yellowgreen";
        }
        elseif ($ave_social >= 2.5 && $ave_social <= 3.49) {
            $socolor = "yellow";
        }
        elseif ($ave_social >= 1.5 && $ave_social <= 2.49) {
            $socolor = "Orange";
        }
        elseif ($ave_social >= 1 && $ave_social <= 1.49) {
            $socolor = "Red";
        }

        $item46 = $res['item46'];
        $item47 = $res['item47'];
        $item48 = $res['item48'];
        $item49 = $res['item49'];
        $item50 = $res['item50'];
        $item51 = $res['item51'];
        $item52 = $res['item52'];
        $item53 = $res['item53'];
        $item54 = $res['item54'];
        $item55 = $res['item55'];

        $ave_occup = ($item46 + $item47 + $item48 + $item49 + $item50 + $item51 + $item52 + $item53 + $item54 + $item55)/15;
        // echo "<script> alert('".$ave_spirit."'); </script>";
        if ($ave_occup >= 4.5 && $ave_occup <= 5) {
            $ocolor = "green";
        }
        elseif ($ave_occup >= 3.5 && $ave_occup <= 4.49) {
            $ocolor = "yellowgreen";
        }
        elseif ($ave_occup >= 2.5 && $ave_occup <= 3.49) {
            $ocolor = "yellow";
        }
        elseif ($ave_occup >= 1.5 && $ave_occup <= 2.49) {
            $ocolor = "Orange";
        }
        elseif ($ave_occup >= 1 && $ave_occup <= 1.49) {
            $ocolor = "Red";
        }


    ?>
    <script>
	window.onload = function () {

	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		exportEnabled: true,
		theme: "light2", // "light1", "light2", "dark1", "dark2"
		title:{
			text: "Wellness Dimensional Result"
		},
		data: [{
			type: "column", //change type to bar, line, area, pie, etc
			//indexLabel: "{y}", //Shows y value on all Data Points
			indexLabelFontColor: "#5A5757",
			indexLabelPlacement: "outside",
			dataPoints: [
				{ y: <?php echo $ave_phy; ?>, label: "Physical", color : "<?php echo $pcolor; ?>" },
				{ y: <?php echo $ave_occup; ?>, label: "Occupational",color : "<?php echo $pcolor; ?>" },	
				{ y: <?php echo $ave_spirit; ?>, label: "Spiritual", color : "<?php echo $scolor; ?>"},
				// { y: <?php echo $ave_phy; ?>, label: "Intellectual",color : "<?php echo $scolor; ?>"},
				{ y: <?php echo $ave_social; ?>, label: "Social", color : "<?php echo $socolor; ?>" },
				{ y: <?php echo $ave_emo; ?>, label: "Emotional", color : "<?php echo $ecolor; ?>" }
			]
		}]
	});
	chart.render();

	}
	</script>

    <body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header" style="border-bottom: 7px solid #00a3c7;">
                    <center><img src="logo.png" width="165"><br><br>
                    <div style="color: #000;text-align: center;">griffin@elma.com</div>
                    </center>
                </div>
                <ul class="list-unstyled">
                    <li>
                        <a href="main.php">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-cog"></i>
                            Settings
                        </a>
                        <a href="stat.php">
                            <i class="glyphicon glyphicon-stats"></i>
                            Statistics
                        </a>
                        
                    </li>
 
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-send"></i>
                            Contact
                        </a>
                    </li>
                    <li style="border-top: 2.5px solid #00a3c7;">
                    </li>
                </ul>
                <center>    
                <ul class="list-unstyled listing">
                    <li><a href="logout.php" class="article">LOGOUT</a></li>
                </ul>
                </center>
            </nav>
            <!-- Page Content Holder -->
            <div id="content">
                <nav class="navbar navbar-default navbar-fixed-top" style="background: #00bdd7">
                    <div class="container-fluid">
                        <div class="navbar-header">
                        	<div id="menu">

                 				<h4 id="sidebarCollapse" class="glyphicon glyphicon-menu-hamburger" style="color: #fff; margin-left: 15%;"></h4>
               				</div>
                        </div>
                    </div>
                </nav>
        		
        		<div style="margin-right: 10%; margin-left: 10%;margin-top: 10%">
                	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    <table align="center" style="font-size: 15px;">
                        <tr>
                            <td>
                                <div style="height: 20px;width: 20px;background-color: green;"></div></td>
                            <td style="padding:5px;">Excellent</td>
                            <td><div style="height: 20px;width: 20px;background-color: yellowgreen;"></div></td>
                            <td style="padding:5px;">Very Good</td>
                            <td><div style="height: 20px;width: 20px;background-color: yellow;"></div></td>
                            <td style="padding:5px;">Good</td>
                            <td><div style="height: 20px;width: 20px;background-color: orange;"></div></td>
                            <td style="padding:5px;">Fair</td>
                            <td><div style="height: 20px;width: 20px;background-color: red;"></div></td>
                            <td style="padding:5px;">Poor</td>
                        </tr>
                    </table>
            	</div>

          	</div> 
        <div class="overlay"></div>


        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#dismiss, .overlay').on('click', function () {
                    $('#sidebar').removeClass('active');
                    $('.overlay').fadeOut();
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').addClass('active');
                    $('.overlay').fadeIn();
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>

<script src="chart/canvasjs.min.js"></script>
    </body>
</html>
