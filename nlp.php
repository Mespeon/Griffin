<!DOCTYPE html>
<html>
<head>
	<title>NLP</title>
	<?php
		$cnnt = mysqli_connect("localhost", "root", "", "db_griffin");
		$cnt_bad = 0;
		$p_good = 0;
		$p_bad = 0;
	$cnt_good = 0;
	if (isset($_POST['btn_check'])) {
		$x = $_POST['checker'];
		
		$query = mysqli_query($cnnt,"SELECT * FROM tbl_bad");
        
            while ($row = mysqli_fetch_array($query))
            {
                $word = $row['bword'];
                if (@preg_match('/\b'.$word.'\b/i',$x))
                {
                    // echo 'bad\n';
                    $cnt_bad++;
                }

            }


            $gquery = mysqli_query($cnnt,"SELECT * FROM tbl_pos");
        
            while ($grow = mysqli_fetch_array($gquery))
            {
                $gword = $grow['gword'];
                if (preg_match('/\b'.$gword.'\b/i',$x))
                {
                    //echo "<script> alert('".$word."=".$y[0]."'); </script>";
                    // echo 'good';
                    $cnt_good++;
                }

            }
            $tword = $cnt_good + $cnt_bad;
            @$p_good = ($cnt_good/$tword)*100;
            @$p_bad = ($cnt_bad/$tword)*100;

            $result = 'Bad Word Count: '.@$cnt_bad.'\nGood Word Count: '.@$cnt_good;
            echo "<script> alert('".$result."'); </script>";
	}
		$dataPoints = array( 
			array("label"=>"Positive Words", "y"=>$p_good),
			array("label"=>"Negative Words", "y"=>$p_bad)
		);
	?>

	<script>
	window.onload = function() {


	var chart = new CanvasJS.Chart("chartContainer", {
		animationEnabled: true,
		title: {
			text: "Natural Language Process"
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

</head>
<body>

<form method="post">
	<label>Enter Comment Here:</label>
	<br>
	<input type="text" name="checker" size="100">
	<br>
	<button name="btn_check">CHECK</button>
</form>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="chart/canvasjs.min.js"></script>
</body>
</html>