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

$ISO_2 = $_GET['country_2'];

$query = "SELECT name FROM cyclist WHERE iso_id = '$ISO_2';";
$result = mysqli_query($conn, $query);

//
/*
echo "<h2>$ISO_1</h2><ul>";
if (mysqli_num_rows($result_2) > 0){ 
    // output data of each row 
    while ($row = mysqli_fetch_array($result_2, MYSQL_ASSOC)) {
        echo "<li>".$row["name"];
    }
}
echo "</ul>";
*/

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