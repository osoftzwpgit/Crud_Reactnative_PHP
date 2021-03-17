<?php
$CN=mysqli_connect("localhost", "root");
$DB=mysqli_select_db($CN,"31_reguser");

// $EncodedData=file_get_contents('php://input');
// $_POST=json_decode($EncodedData,true);
 
$_POST ? '' : $_POST = json_decode(trim(file_get_contents('php://input')), true);
// var_dump("Deepa Result");
// var_dump($_POST);


// $Ucode=$DecodedData['Ucode'];
// $Ufirstname=$DecodedData['Ufirstname'];
// $Ulastname=$DecodedData['Ulastname'];

// $Ucode = $_POST['Ucode'];
// $Ufirstname = $_POST['Ufirstname'];
// $Ulastname = $_POST['Ulastname'];

$Ucode=$_POST['Ucode'];
$Ufirstname=$_POST['Ufirstname'];
$Ulastname=$_POST['Ulastname'];
$IQ="insert into reguser(Ucode, Ufirstname, Ulastname) values ($Ucode, '$Ufirstname', '$Ulastname')";

$R=mysqli_query($CN,$IQ);

if($R)
{
    $Message = "Student has been registered successfully";
}
else{
    $Message = "Server error, Please try later !!!";
}

//echo $Message;
//echo $_POST['Ucode'], $_POST['Ufirstname'], $_POST['Ulastname'];

$Response[]=array("Message" => $Message);
echo json_encode($Response);