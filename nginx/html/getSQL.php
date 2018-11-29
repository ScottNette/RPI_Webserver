<?php 


$servername = "127.0.0.1:3306";
$username = "emptyspace";
$password = "ComP353uter~!";

// Create connection
$conn = new mysqli($servername, $username, $password, "mydb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
echo "\r";

// Create database
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
echo "\r";
$conn->close();


$temperature = $_GET["temperature"];
$wind = $_GET["wind"];
$time = $_GET["time"];


echo "<br>";
echo $temperature;
echo "<br>";
echo $wind;
echo "<br>";
echo $time;
echo "<br>";






?>


<font face="century gothic" size="20px"?
	<center>Hello World</center>
</font>