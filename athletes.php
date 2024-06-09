<!DOCTYPE html>
<html lang ="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width"/>

<title>Athletes php</title>
<link rel="stylesheet" href="tasks_1_2_3.css">

</head>

<body>

<h1> Athletes Page </h1>

<?php
$COUNTRY_ID = $_GET['country_id'];
$PART_NAME = $_GET['part_name'];

if ($COUNTRY_ID == ""){
    //case where no country ID has been entered
    echo "<h3> NO COUNTRY HAS BEEN ENTERED</h3>";
    echo "<p> Please retry and enter a country ID</p>";
} else if ($PART_NAME == ""){
    //case where no name value has been entered
    echo "<h3> NO NAME HAS BEEN ENTERED</h3>";
    echo "<p> Please retry and enter a name</p>";
} else {    
    //define server variables

    $servername = "sci-mysql";
    $dbname = "coa123cdb";
    $username = "coa123cycle";
    $password = "bgt87awx!@2FD";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query and result
    $query = "SELECT cyclist.name, COUNT(event.event_name) AS 'nb_events' FROM country JOIN cyclist ON country.iso_id = cyclist.iso_id JOIN event ON cyclist.cyclist_id = event.cyclist_id WHERE cyclist.iso_id = '$COUNTRY_ID' AND cyclist.name LIKE '%$PART_NAME%' GROUP BY cyclist.name ;";
    $result = mysqli_query($conn, $query);

    //echo the SQL search string and total number of search results
    //echo "<h4> SQL QUERY </h4><h5>".$query."</h5>";
    //echo "<h5>Number of results : ".mysqli_num_rows($result)."</h5>";

    //
    echo "<table> <tr><td> Cyclist Name </td><td> Nb Events </td></tr>";
    if (mysqli_num_rows($result) > 0){ 
        // output data of each row 
        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            echo "<tr><td>".$row["name"]."</td><td>".$row["nb_events"]."</td></tr>";
        }
    } else {
        echo "<tr><td>NO</td><td>RESULTS</td></tr>";
    } 
    echo "</table>";

    mysqli_close($conn);
}

?>

</body>
</html>