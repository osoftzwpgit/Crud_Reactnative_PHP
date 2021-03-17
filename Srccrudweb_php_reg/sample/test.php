<?php
$CN=mysqli_connect("localhost", "root");
$DB=mysqli_select_db($CN,"31_cst");

$RollNo=$POST['RollNo'];
$StudentName=$POST['StudentName'];
$Course=$POST['Course'];

$IQ="insert into studentmaster(RollNo, StudentName,Course) values ($RollNo, '$StudentName', '$Course')";

$R=mysqli_query($CN,$IQ);

if($R)
{
    $Message = "Student has been registered successfully";
}
else{
    $Message = "Server error, Please try later !!!";
}

echo $Message;
