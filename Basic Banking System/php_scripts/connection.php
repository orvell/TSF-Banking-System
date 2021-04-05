<?php
$host="localhost";
$username="id16531458_tsf";
$password="HWR{!|PV3brg|9qb";
$dbname="id16531458_banking_system";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
  die("Could not connect to the database...... " . mysqli_connect_error());
}

?>
