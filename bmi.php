<!DOCTYPE html>
<html lang ="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>

<title>BMI php</title>
<link rel="stylesheet" href="tasks_1_2_3.css">

</head>

<body>

<h1> BMI Calculator</h1>

<?php
$MIN_WEIGHT = $_GET['min_weight'];
$MAX_WEIGHT = $_GET['max_weight'];
$MIN_HEIGHT = $_GET['min_height'];
$MAX_HEIGHT = $_GET['max_height'];


echo '<h5>Min Weight : '.$MIN_WEIGHT.'</h5>';
echo '<h5>Max Weight : '.$MAX_WEIGHT.'</h5>';
echo '<h5>Min Height : '.$MIN_HEIGHT.'</h5>';
echo '<h5>Max Height : '.$MAX_HEIGHT.'</h5>';

//$message = "Hello World";
//echo '<h5>'.$message.'</h5';

echo "<table>";
for($i=$MIN_WEIGHT-5 ;$i <= $MAX_WEIGHT; $i=$i+5){
	echo '<tr>';
	for($j=$MIN_HEIGHT-5 ;$j <= $MAX_HEIGHT; $j=$j+5) {
		if ($i == $MIN_WEIGHT-5 && $j == $MIN_HEIGHT-5){
            echo '<td> Weight, Height </td>';
        } else if ($i == $MIN_WEIGHT-5){
            echo '<td>'.($j).'</td>';
        } else if ($j == $MIN_HEIGHT-5) {
            echo '<td>'.($i).'</td>';
        } else {
            $BMI = ($i/(($j/100) ** 2));
            echo '<td>'.round($BMI,3).'</td>';
        }
	}
	echo '</tr>';
}
echo "</table>";
?>
</body>
</html>