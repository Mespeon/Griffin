<html>
<head>
    <title>ELMA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="icon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    function tagomoto() {
        var x = document.getElementById("Login");
        var y = document.getElementById("Login");
        if (x.style.display === "none") {
        x.style.display = "block";
        } else {
        x.style.display = "none";
        }
    }
    </script>
    <script>
    function show(shown, hidden) {
                document.getElementById(shown).style.display='block';
                document.getElementById(hidden).style.display='none';
                return false;
            }
    </script>
</head>
<?php
    require('conn.php');
    session_start();
?>
<body>
    <!-- Start Page --> 
    <div data-role="page" id="Login">
        <div data-role="header" data-position="fixed" data-fullscreen="true">
        </div>
        <div data-role="main" class="ui-content">
            <div style="margin-top: 5%;">
            <center><img src="logo.png" width="200"><br><br>
            <div style="width: 80%; max-width: 400px"><br>
            <form method="POST">
                <div class="input-group" style="padding-bottom: 2%">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input type="text" class="form-control" name="user-login" placeholder="Enter Email">
                </div>
                <div class="input-group" style="padding-bottom: 2%">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input class="form-control" type="password" name="pass-login" placeholder="Password">
                </div>
                <input type="submit" class="btn btn-info" value="Login" name="login-button" style="width: 40%; background-color:#00bdd7;"><br><br>
                <span>Don't have account yet? <a onclick="return show('Register','Login');" style="cursor: pointer;"> Sign Up Now </a></span>
            </form>
            </center>
            </div> 
        </div>

        <div data-role="footer" data-position="fixed" data-fullscreen="true">   
        </div>
    </div>
    <!-- <div class="overlay"> <img src="loading.gif"></div> -->
    <div data-role="page" id="Register" style="display: none;">
        <div data-role="header" data-position="formixed" data-fullscreen="true">
        </div>
        <div data-role="main" class="ui-content">
            <div style="margin-top: 0%;">
            <center><br><br><br>
            <div style="width: 80%; max-width: 400px;"><br>
            <form method="POST"><img src="logo.png" width="60" style="float: left;">
                <h1>Create Account</h1><p>Please complete your details</p><br><br>
                <div class="input-group" style="padding-bottom: 2%">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" name="user-fname" placeholder="Nickname">
                </div>
                <div class="input-group" style="padding-bottom: 2%">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <select class="form-control" name="gender" placeholder="Gender">
                    <option selected hidden="">Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
                </div>
                <div class="input-group" style="padding-bottom: 2%">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                <input type="text" class="form-control" name="age" placeholder="Age">
                </div>
                <div class="input-group" style="padding-bottom: 2%">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input class="form-control" type="text" name="email" placeholder="Email">
                </div>
                <div class="input-group" style="padding-bottom: 2%">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input class="form-control" type="password" name="pass-reg" placeholder="Password">
                </div>
                <div class="input-group" style="padding-bottom: 2%">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input class="form-control" type="password" name="cpass-reg" placeholder="Confirm Password">
                </div>
                <span id='message'></span><br><br>
                <input type="submit" class="btn btn-info" value="Register" style="width: 40%; background-color:#00bdd7;" name="register-button"><br><br>
                <span>Have an account? <a onclick="return show('Login','Register');" style="cursor: pointer;">Sign in </a></span>
            </form>
            </center>
            </div> 
        </div>

        <div data-role="footer" data-position="fixed" data-fullscreen="true">   
        </div>
    </div>
       
        <?php
            if (isset($_POST['login-button'])) {
                $email = $_POST['user-login'];
                $pass = md5($_POST['pass-login']);

                $query = mysqli_query($conn, "SELECT * FROM `tbl_user` WHERE `email` = '$email' AND `password` = '$pass'");
                $acct = mysqli_fetch_assoc($query);
                $count = mysqli_num_rows($query);

                if ($count == 1) {
                    $id = $acct['id'];
                    $sql = mysqli_query($conn, "SELECT * FROM  `tbl_result` WHERE `userid` = '$id'");
                    $res = mysqli_fetch_assoc($sql);

                    $status = $res['status'];
                    if ($status == 'OK') {
                        echo "<script> location.replace('main.php'); </script>";
                        $_SESSION['userid'] = $acct['id'];
                    }
                    else
                    {
                        echo "<script> location.replace('assess.php'); </script>";
                        $_SESSION['userid'] = $acct['id'];
                    }
                    
                }
                else
                {
                    echo "<script> alert('Error'); </script>";
                }
            }

            if (isset($_POST['register-button'])) {
                // echo "<script> alert('SAVED'); </script>";
                $nick = $_POST['user-fname'];
                $gender = $_POST['gender'];
                $age = $_POST['age'];
                $email = $_POST['email'];
                $pass = $_POST['pass-reg'];
                $cpass = $_POST['cpass-reg'];

                if ($pass == $cpass) {
                    $pass = md5($pass);
                    $cpass = md5($cpass);
                    $sql = mysqli_query($conn, "INSERT INTO `tbl_user`(`nickname`, `age`, `gender`, `email`, `password`) VALUES ('$nick', '$age', '$gender', '$email', '$pass')");
                    $query = mysqli_query($conn, "SELECT * FROM `tbl_user` WHERE `nickname` = '$nick' AND `email` = '$email'");
                    $user = mysqli_fetch_assoc($query);
                    $id = $user['id'];
                    $sql = mysqli_query($conn, "INSERT INTO `tbl_result`(`userid`) VALUES ('$id')");

                    if ($sql) {
                        echo "<script> alert('SAVED'); </script>";
                    }else{
                        echo "<script> alert('Error'); </script>";
                    }
                }
                
            }
            
        ?>
 <script>
            $('#pass-reg, #cpass-reg').on('keyup', function () {
              if ($('#pass-reg').val() == $('#cpass-reg').val()) {
                $('#cpass-reg').html('Password match').css('border-color', 'green');
              } else 
                $('#cpass-reg').html('Password not match').css('border-color', 'red');
            });
        </script>       
</body>
</html>