<?php
//include 'DBConfig.php';
// $CN=mysqli_connect("localhost", "root");
// $DB=mysqli_select_db($CN,"31_reguser");
 
$HostName = "localhost";                //Define your host here.
$DatabaseName = "31_reguser";           //Define your database name here.
$HostUser = "root";                     //Define your database username here.
$HostPass = "";                         //Define your database password here.

$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);         // Create connection
 
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
} 
 
$sql = "SELECT * FROM reguser";

$result = $conn->query($sql);
 
if ($result->num_rows >0) {
 while($row[] = $result->fetch_assoc()) {
 
 $tem = $row;
 
 $json = json_encode($tem);
 }
} else {
 echo "No Results Found.";
}
 echo $json;
$conn->close();
?>