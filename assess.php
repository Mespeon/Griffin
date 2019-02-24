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
        if (!isset($_SESSION['userid'])) {
            header('location: index.php');
        }
        $user_id = $_SESSION['userid'];
        $speech = mysqli_query($conn, "SELECT * FROM `tbl_user` WHERE `id` = '$userid'");
        $user = mysqli_fetch_assoc($speech);
        $msg = "'Hello ".$user['nickname'].", I am Elma, your personal wellness companion'";
        // echo "<script> alert('".$user_id."'); </script>";

    ?>
    <script>
    window.onload = function() {

        var synth = window.speechSynthesis;
        var msg = new SpeechSynthesisUtterance(<?php echo $msg; ?>);
        msg.rate = 10;
        synth.speak(msg);
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
        <form method="POST">
        <center style="padding-top: 65px; padding-right: 10%; padding-left: 10%">
            <h1>SLEF-ASSESSMENT TEST</h1>
            <table border="1" class="table table-striped table-bordered">
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
                    <tr>
                        <td colspan="7" align="center">Physical Wellness</td>
                    </tr>
                    <?php
                        $no = 1;
                        $query = mysqli_query($conn,"SELECT * FROM `tb_eval` WHERE `type` = 'Physical' ORDER BY rand()");

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

                    <tr>
                        <td colspan="7" align="center">Emotional Wellness</td>
                    </tr>
                    <?php
                        $no = 1;
                        $query = mysqli_query($conn,"SELECT * FROM `tb_eval` WHERE `type` = 'Emotional' ORDER BY rand()");

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

                    <tr>
                        <td colspan="7" align="center">Occupational Wellness</td>
                    </tr>
                    <?php
                        $no = 1;
                        $query = mysqli_query($conn,"SELECT * FROM `tb_eval` WHERE `type` = 'Occupational' ORDER BY rand()");

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

                    <tr>
                        <td colspan="7" align="center">Social Wellness</td>
                    </tr>
                    <?php
                        $no = 1;
                        $query = mysqli_query($conn,"SELECT * FROM `tb_eval` WHERE `type` = 'Social' ORDER BY rand()");

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

                    <tr>
                        <td colspan="7" align="center">Spiritual Wellness</td>
                    </tr>
                    <?php
                        $no = 1;
                        $query = mysqli_query($conn,"SELECT * FROM `tb_eval` WHERE `type` = 'Spiritual' ORDER BY rand()");

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
                        <button type="submit" class="btn btn-info" name="btn_sub">SUBMIT</button>
                    </td>
                </tbody>
            </table>
        </center>
    </form>
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

    <?php
        if(isset($_POST['btn_sub'])){
            $item1 = $_POST['item1'];
            // echo "<script> alert('".$item1."');</script>";
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
            $item46 = $_POST['item46'];
            $item47 = $_POST['item47'];
            $item48 = $_POST['item48'];
            $item49 = $_POST['item49'];
            $item50 = $_POST['item50'];
            $item51 = $_POST['item51'];
            $item52 = $_POST['item52'];
            $item53 = $_POST['item53'];
            $item54 = $_POST['item54'];
            $item55 = $_POST['item55'];



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

            $ave_phy = ($item1+ $item2+ $item3+ $item4+ $item5+ $item6+ $item7+ $item8+ $item9+ $item10+ $item11+ $item12)/12;
            // echo "<script> alert('".$ave_phy."'); </script>";

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

            $ave_emo = ($item13 + $item14 + $item15 + $item16 + $item17 + $item18 + $item19 + $item20 + $item21 + $item22 + $item23 + $item24)/12;
            // echo "<script> alert('".$ave_emo."'); </script>";

            $item25 = $_POST['item25'];
            $item26 = $_POST['item26'];
            $item27 = $_POST['item27'];
            $item28 = $_POST['item28'];
            $item29 = $_POST['item29'];
            $item30 = $_POST['item30'];

            $ave_spirit = ($item25 + $item26 + $item27 + $item28 + $item29 + $item30)/6;
            // echo "<script> alert('".$ave_spirit."'); </script>";



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
            
            $ave_social = ($item31 + $item32 + $item33 + $item34 + $item35 + $item36 + $item37 + $item38 + $item39 + $item40 + $item41 + $item42 + $item43 + $item44 + $item45)/15;


            $item46 = $_POST['item46'];
            $item47 = $_POST['item47'];
            $item48 = $_POST['item48'];
            $item49 = $_POST['item49'];
            $item50 = $_POST['item50'];
            $item51 = $_POST['item51'];
            $item52 = $_POST['item52'];
            $item53 = $_POST['item53'];
            $item54 = $_POST['item54'];
            $item55 = $_POST['item55'];

            $ave_occup = ($item46 + $item47 + $item48 + $item49 + $item50 + $item51 + $item52 + $item53 + $item54 + $item55)/15;



            $sql = mysqli_query($conn,"UPDATE `tbl_result` SET item1='$item1',item2='$item2',item3='$item3',item4='$item4',item5='$item5',item6='$item6',item7='$item7',item8='$item8',item9='$item9',item10='$item10',item11='$item11',item12='$item12',item13='$item13',item14='$item14',item15='$item15',item16='$item16',item17='$item17',item18='$item18',item19='$item19',item20='$item20',item21='$item21',item22='$item22',item23='$item23',item24='$item24',item25='$item25',item26='$item26',item27='$item27',item28='$item28',item29='$item29',item30='$item30',item31='$item31', item32='$item32', item33='$item33', item34='$item34', item35='$item35', item36='$item36', item37='$item37', item38='$item38', item39='$item39', item40='$item40', item41='$item41', item42='$item42', item43='$item43', item44='$item44', item45='$item45',item46='$item46',item47='$item47',item48='$item48',item49='$item49',item50='$item50',item51='$item51',item52='$item52',item53='$item53',item54='$item54',item55='$item55', status='OK' WHERE `userid`='$user_id'");


            $res_phy = mysqli_query($conn,"INSERT INTO `tbl_ave`(`userid`, `ave`, `type`) VALUES ('$user_id','$ave_phy','Physical')");
            $res_emo = mysqli_query($conn,"INSERT INTO `tbl_ave`(`userid`, `ave`, `type`) VALUES ('$user_id','$ave_emo','Emotional')");
            $res_social = mysqli_query($conn,"INSERT INTO `tbl_ave`(`userid`, `ave`, `type`) VALUES ('$user_id','$ave_social','Social')");
            $res_spirit = mysqli_query($conn,"INSERT INTO `tbl_ave`(`userid`, `ave`, `type`) VALUES ('$user_id','$ave_spirit','Spiritual')");
            $res_occup = mysqli_query($conn,"INSERT INTO `tbl_ave`(`userid`, `ave`, `type`) VALUES ('$user_id','$ave_occup','Occupational')");

            if ($sql) {
                echo "<script> alert('SAVED');location.replace('main.php'); </script>";
            }
            else
            {
              echo "<script> alert('NOT SAVED'); </script>";  
            }
        }
    ?>
    </body>
</html>
