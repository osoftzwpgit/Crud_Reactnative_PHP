<?php
$CN=mysqli_connect("localhost", "root");
$DB=mysqli_select_db($CN,"31_cst");

$EncodedData=file_get_contents('php://input');
$DecodedData=json_decode($EncodedData,true);
//var_dump($DecodedData); 

$RollNo=$DecodedData['RollNo'];
$StudentName=$DecodedData['StudentName'];
$Course=$DecodedData['Course'];

//$RollNo = $_POST['RollNo'];
//$StudentName = $_POST['StudentName'];
//$Course = $_POST['Course'];

$IQ="insert into studentmaster(RollNo, StudentName,Course) values ($RollNo, '$StudentName', '$Course')";
//$IQ="insert into studentmaster(RollNo, StudentName,Course) values ( $RollNo, 'name', 'course')";

$R=mysqli_query($CN,$IQ);

if($R)
{
    $Message = "Student has been registered successfully";
}
else{
    $Message = "Server error, Please try later !!!";
}

//echo $Message;
//echo $_POST['RollNo'], $_POST['StudentName'], $_POST['Course'];

$Response[]=array("Message" => $Message);
echo json_encode($Response);

