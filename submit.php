<?php

$servername = "sci-mysql";
$dbname = "coa123cdb";
$username = "coa123cycle";
$password = "bgt87awx!@2FD";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$ISO_1 = $_GET['country_1'];
$ISO_2 = $_GET['country_2'];


$query = "SELECT DISTINCT(iso_id) FROM country WHERE iso_id = '$ISO_1' OR iso_id = '$ISO_2';";
$result = mysqli_query($conn, $query);

$allDataArray = array();
if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $allDataArray[] = $row;
    }
}
// return the result as a JSON-encoded array
echo json_encode($allDataArray);

mysqli_close($conn);

?>