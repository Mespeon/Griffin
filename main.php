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
        $speech = mysqli_query($conn, "SELECT * FROM `tbl_user` WHERE `id` = '$userid'");
        $user = mysqli_fetch_assoc($speech);
        $msg = "'Hello ".$user['nickname'].", I am Elma, your personal wellness companion'";
        // echo "<script> alert('".$userid."'); </script>";
        $cnt_bad = 0;
        $p_good = 0;
        $p_bad = 0;
        $cnt_good = 0;
        $no = 1;
        $sql = mysqli_query($conn, "SELECT * FROM tbl_ave WHERE `userid` = '$userid' ORDER BY `ave` LIMIT 2");
        
        while ($arow = mysqli_fetch_array($sql)) {
            $ave = $arow['ave'];
            $type = $arow['type'];

            if ($no == 1) {
                $lowest = $type;
                // echo "<script> alert('lowest".$lowest."'); </script>";
            }elseif ($no == 2) {
                $second = $type;
                // echo "<script> alert('second".$second."'); </script>";
            }
            $no++;


        }






        
        date_default_timezone_set('Asia/Manila');
        if (isset($_POST['add_jrn'])) {
            $txtjrn = $_POST['txtjrn'];
            $date = date('Y/m/d');
            echo "<script> var synth = window.speechSynthesis;
            var msg = new SpeechSynthesisUtterance('Your Journal has been Added');
        
            synth.speak(msg); </script>";
            $sql = mysqli_query($conn, "INSERT INTO `tbl_jrn`(`userid`, `txtjrn`, `date`) VALUES ('$userid', '$txtjrn','$date')");
            
        }

        $sql = mysqli_query($conn, "SELECT * FROM `tbl_jrn` WHERE `userid` = '$userid' ORDER BY id DESC LIMIT 1");
        $jrn = mysqli_fetch_array($sql);
        $txtjrn = $jrn['txtjrn'];

        $query = mysqli_query($conn,"SELECT * FROM tbl_bad");
        
            while ($row = mysqli_fetch_array($query))
            {
                $word = $row['bword'];
                if (@preg_match('/\b'.$word.'\b/i',$txtjrn))
                {
                    // echo 'bad\n';
                    $cnt_bad++;
                }
            }


            $gquery = mysqli_query($conn,"SELECT * FROM tbl_pos");
        
            while ($grow = mysqli_fetch_array($gquery))
            {
                $gword = $grow['gword'];
                if (@preg_match('/\b'.$gword.'\b/i',$txtjrn))
                {
                    //echo "<script> alert('".$word."=".$y[0]."'); </script>";
                    // echo 'good';
                    $cnt_good++;
                }
            }
            $tword = $cnt_good + $cnt_bad;
            @$p_good = ($cnt_good/$tword)*100;
            @$p_bad = ($cnt_bad/$tword)*100;

            // $result = 'Bad Word Count: '.@$cnt_bad.'\nGood Word Count: '.@$cnt_good;
            // echo "<script> alert('".$result."'); </script>";

            // if ($sql) {
            //     echo "<script> alert('Journal Added'); </script>";
            // }
            // else
            // {
            //     echo "<script> alert('Error'); </script>";
            // }
        $dataPoints = array( 
            array("label"=>"Positive Thoughts", "y"=>$p_good),
            array("label"=>"Negative Thoughts", "y"=>$p_bad)
        );        
        $eval = "";
        if ($p_good >= 1 && $p_good <= 20.99) {
            $eval = "Very Poor";
            $img = "verypoor.png";
        }elseif ($p_good >= 21 && $p_good <= 40.99) {
            $eval = "Poor";
            $img = "poor.png";
        }elseif ($p_good >= 41 && $p_good <= 50.99) {
            $eval = "Fair";
            $img = "fair.png";
        }elseif ($p_good >= 51 && $p_good <= 70.99) {
            $eval = "Good";
            $img = "good.png";
        }elseif ($p_good >= 71 && $p_good <= 100) {
            $eval = "Very Good";
            $img = "verygood.png";
        }   
    ?>

    <script>

    function result() {
        var synth = window.speechSynthesis;
        var msg = new SpeechSynthesisUtterance('Your Positive Thoughts is <?php echo number_format($p_good,2,'.', ''); ?>% and Your NEgative Thoughts is <?php echo number_format($p_bad,2,'.', ''); ?>%, on my evaluation you are feeling <?php echo $eval; ?>');
    
        synth.speak(msg);
    }
    window.onload = function() {

    var synth = window.speechSynthesis;
    var msg = new SpeechSynthesisUtterance(<?php echo $msg; ?>);
    
    synth.speak(msg);

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Sentiment Analysis"
        },
        subtitles: [{
            text: "Percentage"
        }],
        data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y})",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
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
                <nav class="navbar navbar-default navbar-fixed-top" style="background: #00bdd7;">
                    <div class="container-fluid">
                        <div class="navbar-header">
                        	<div id="menu">
                 				<h4 id="sidebarCollapse" class="glyphicon glyphicon-menu-hamburger" style="color: #fff; margin-left: 15%;"></h4>
               				</div>
                        </div>
                    </div>
                </nav>
            <div class="rown" style="margin-left: 5%; margin-right: 5%; margin-top: 80px;">
                <div class="col-md-6">
                    <div class="row-xs-6">
                        <h1>Daily Task</h1>
                         <ul class="list-group">
                            <?php
                                $tdate = "";
                                $tdate = date('Y/m/d');
                                $task_query = mysqli_query($conn, "SELECT * FROM `tbl_task` WHERE `userid` = '$userid' AND `status` = 'NA'");
                                $task_count = mysqli_num_rows($task_query);
                                
                                if($task_count == 0)
                                {
                                    $low_query = mysqli_query($conn, "SELECT * FROM `tbl_challenge` WHERE `type` = '$lowest' ORDER BY rand() LIMIT 2");
                                    $taskt_query = mysqli_query($conn, "SELECT * FROM `tbl_task` WHERE `userid` = '$userid' AND `status` = 'OK'");
                                    $ccount = mysqli_num_rows($taskt_query);
                                    if ($ccount < 3) {
                                        while ($lrow = mysqli_fetch_array($low_query)) {
                                        $taskid = $lrow['id'];
                                        $taskname = $lrow['task'];
                                        echo "<li class='list-group-item'>".$lrow['task']."<i class='glyphicon glyphicon-ok check' style='left: 35px; color: gray; float: right;'></i></li>";
                                        $check = mysqli_query($conn,"SELECT * FROM `tbl_task` WHERE `taskid` = '$taskid'");
                                        $count = mysqli_num_rows($check);
                                        if ($count == 0) {
                                           $taskl_query = mysqli_query($conn, "INSERT INTO `tbl_task`(`userid`, `taskid`, `taskname`, `status`,`date`) VALUES ('$userid','$taskid','$taskname','NA','$tdate')");
                                        }
                                        
                                    }

                                    $sec_query = mysqli_query($conn, "SELECT * FROM `tbl_challenge` WHERE `type` = '$second' ORDER BY rand() LIMIT 1");
                                    while ($srow = mysqli_fetch_array($sec_query)) {
                                        $taskid = $srow['id'];
                                        $taskname = $srow['task'];
                                        echo "<li class='list-group-item'>".$srow['task']."<i class='glyphicon glyphicon-ok check' style='left: 35px; color: gray; float: right;'></i></li>";
                                        $checks = mysqli_query($conn,"SELECT * FROM `tbl_task` WHERE `taskid` = '$taskid'");
                                        $counts = mysqli_num_rows($checks);
                                        if ($counts == 0) {
                                            $tasks_query = mysqli_query($conn, "INSERT INTO `tbl_task`(`userid`, `taskid`, `taskname`, `status`,`date`) VALUES ('$userid','$taskid','$taskname','NA','$tdate')");
                                        }
                                    }
                                    }
                                    
                                }elseif ($task_count > 0) {
                                    $tasko_query = mysqli_query($conn, "SELECT * FROM `tbl_task` WHERE `userid` = '$userid' AND `status` = 'OK'");
                                    
                                       
                                        while ($trow = mysqli_fetch_array($tasko_query)) {
                                            $taskid = $trow['taskid'];
                                            $taskname = $trow['taskname'];
                                            $status = $trow['status'];
                                            if ($status == 'OK') {
                                                $txtcolor = 'green';
                                            }else
                                            {
                                                $txtcolor = 'gray';
                                            }
                                            echo "<li class='list-group-item'><a href='task.php?taskid=$taskid'>".$taskname."<i class='glyphicon glyphicon-ok check' style='left: 35px; color: ".$txtcolor."; float: right;'></i></a></li>";
                                        }

                                    while ($trow = mysqli_fetch_array($task_query)) {
                                        $taskid = $trow['taskid'];
                                        $taskname = $trow['taskname'];
                                        $status = $trow['status'];
                                        if ($status == 'OK') {
                                            $txtcolor = 'green';
                                        }else
                                        {
                                            $txtcolor = 'gray';
                                        }
                                        echo "<li class='list-group-item'><a href='task.php?taskid=$taskid'>".$taskname."<i class='glyphicon glyphicon-ok check' style='left: 35px; color: ".$txtcolor."; float: right;'></i></a></li>";
                                    }
                                    
                                        
                                }

                            ?>
                          <!-- <li class="list-group-item">Talk to Someone you didn't know <i class="glyphicon glyphicon-ok check" style="left: 35px; color: gray; float: right;"></i></li>
                          <li class="list-group-item">Get Some Sleep<i class="glyphicon glyphicon-ok check" style="left: 35px; color: gray; float: right;"></i></li>
                          <li class="list-group-item">Drink 8 Glasses of Water<i class="glyphicon glyphicon-ok check" style="left: 35px; color: gray; float: right;"></i></li> -->
                        </ul>
                    </div>
                    <div class="row-xs-6"><ul style="padding-left: 0px;"><li class='list-group-item'>
                        <h1 align="center">Emotional Status</h1>
                        <?php
                        $text = "";
                        $img = "";
                            if ($p_good >= 1 && $p_good <= 20.99) {
                                $text = "Very Poor";
                                $img = "verypoor.png";
                            }elseif ($p_good >= 21 && $p_good <= 40.99) {
                                $text = "Poor";
                                $img = "poor.png";
                            }elseif ($p_good >= 41 && $p_good <= 50.99) {
                                $text = "Fair";
                                $img = "fair.png";
                            }elseif ($p_good >= 51 && $p_good <= 70.99) {
                                $text = "Good";
                                $img = "good.png";
                            }elseif ($p_good >= 71 && $p_good <= 100) {
                                $text = "Very Good";
                                $img = "verygood.png";
                            }                      

                        ?>
                        </li><li class='list-group-item'>
                        <table align="center" style="font-size: 15px;">
                            <tr>
                                <td align="center" style="font-size: 25px;">
                                    <?php echo $text; ?>
                                </td>
                                <td style="padding: 10px;text-align: center;" colspan="2">
                                    <img style="height: 50px;" src="images/<?php echo $img; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 10px;">
                                    Positive Thought: <?php echo number_format($p_good,2,'.', '')."%"; ?>
                                </td>
                                <td style="padding: 10px;">
                                    Negative Thought: <?php echo number_format($p_bad,2,'.', '')."%"; ?>
                                </td>
                            </tr>
                        </table>
</li></ul>
                    </div>
                </div>
                <div class="col-md-6"><div class="row-md-6">
                        <h1>Journal</h1>
                        <form method="POST">
                        <textarea class="form-control" placeholder="How are you? You can always share on what you feel." rows="10" name="txtjrn"></textarea><br>
                        <input type="submit" class="btn btn-info" name="add_jrn" value="Add Journal">
                        <input type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="result()"  value="Show Sentimental Analysis">
                        </form>
                    </div>
                    <div class="row-md-6">
                        <h1>Daily Quote</h1>
                        <?php
                            $date = "";
                            $_SESSION['quo_date'] = date('Y/m/d');
                            $quote = mysqli_query($conn, "SELECT * FROM `tbl_quote` ORDER BY rand() LIMIT 1");
                            if ($_SESSION['quo_date'] != $date) {
                                while ($qrow = @mysqli_fetch_array($quote)) {
                                    $quote = $qrow['quote'];
                                    $author = $qrow['author'];
                                    echo "<h4>".$quote." -<i>".$author."</i></h4>";
                                }
                                $date = $_SESSION['quo_date'];
                            }
                            
                        ?>
                    </div>
                    
                </div>
            </div>
            </div> 
            <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sentimental Analysis</h4>
                      </div>
                      <div class="modal-body">
                        <center>
                            <div class="row-xs-6" id="chartContainer" style="height: 380px; width: 100%;"></div>
                        </center>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>
            <!--End of Modal -->
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
