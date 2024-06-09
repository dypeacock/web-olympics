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

$query = "SELECT iso_id, AVG(YEAR(CURDATE()) - YEAR(dob)) AS avg_age FROM cyclist GROUP BY iso_id ORDER BY avg_age ASC;";
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