<?php 

$temperature = $_GET["temperature"];
$wind = $_GET["wind"];
$time = $_GET["time"];

$servername = "127.0.0.1:3306";

$config = parse_ini_file('/var/www/db.ini');
// Create connection
$conn = new mysqli("localhost",$config['username'],$config['password']);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
echo "\r";

// Create database
$sql = "CREATE DATABASE " . $config['db'];

//$sql = "CREATE DATABASE Test_1128";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
	
} else {
    echo "Error creating database: " . $conn->error;
}
echo "\r";

$sql = "USE " . $config['db'];
if ($conn->query($sql) === TRUE) {
    echo "Selected database";
	
} else {
    echo "Database not selected or error: " . $conn->error;
}
echo "\r";

$sql = "CREATE TABLE IF NOT EXISTS `mystation` (`ID` int(11) NOT NULL, `DateTime` datetime NOT NULL COMMENT 'Date and Time of Readings',
  `TempOutCur` decimal(4,1) NOT NULL COMMENT 'Current Outdoor Temperature',
  `HumOutCur` int(11) NOT NULL COMMENT 'Current Outdoor Humidity');";
  
if ($conn->query($sql) === TRUE) {
    echo "created Table";
	
} else {
    echo "table exists or error: " . $conn->error;
}
echo "\r";


$sql = "INSERT INTO `mystation` (`ID`, `DateTime`, `TempOutCur`, `HumOutCur`) VALUES
(1, '2015-02-12 22:00:00', $temperature, $wind);";

if ($conn->query($sql) === TRUE) {
    echo "Inserted Data";
	
} else {
    echo "Added data error: " . $conn->error;
}

echo "\r";



echo $temperature;
echo "\r";
echo $wind;
echo "\r";
echo $time;
echo "\r";


$conn->close();




?>


<font face="century gothic" size="20px"?
	<center>Hello World</center>
</font>