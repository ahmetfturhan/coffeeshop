<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("connection failed: " . $conn->connect_error);
}
//echo "Connected succesfully";

$CoffeeName=$_POST['CoffeeName'];
$Description=$_POST['Description'];
//$CoffeeID=$_POST['CoffeeID'];
session_start();
$CoffeeID = $_SESSION['newCofID'];
$small=$_POST['small'];
$medium=$_POST['medium'];
$large=$_POST['large'];

$sql = "INSERT INTO `coffee` (`CoffeeID`, `Name`, `Description`) VALUES ('$CoffeeID', '$CoffeeName', '$Description')";
 
if ($conn->query($sql) === TRUE) {
   
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql1 = "INSERT INTO `size` (`CoffeeID`, `Type`, `Cost`) VALUES('$CoffeeID', 'small', '$small')";
$sql2 = "INSERT INTO `size` (`CoffeeID`, `Type`, `Cost`) VALUES('$CoffeeID', 'medium', '$medium')";
$sql3 = "INSERT INTO `size` (`CoffeeID`, `Type`, `Cost`) VALUES('$CoffeeID', 'large', '$large')";

if ($conn->query($sql1) === TRUE) {
    
} else {
	echo "Error: " . $sql1 . "<br>" . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
    
} else {
	echo "Error: " . $sql2 . "<br>" . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
	echo "<script>alert('new coffee added succesfully')</script>";
	header("Location: admin.php"); 
	exit();
} else {
	echo "Error: " . $sql3 . "<br>" . $conn->error;
}
?>