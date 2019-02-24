<?php
	require('conn.php');
	session_start();
    if (!$_SESSION['userid']) {
        header('index.php');
    }
    $userid = $_SESSION['userid'];
    $taskid = $_REQUEST['taskid'];
    $query = mysqli_query($conn, "UPDATE `tbl_task` SET `status` = 'OK' WHERE `taskid` = '$taskid' AND `userid` = '$userid'");
    if ($query) {
    	echo "<Script> alert('Updated');location.replace('main.php'); </script>";
    }
?>