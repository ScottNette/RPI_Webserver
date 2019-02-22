<?php 

include 'init.php';
echo phpversion();
//if(isset($_POST['update']))
if(isset($_GET["data"]))
{
    $dataRaw = $_GET["data"];

    //$dataRaw = $_POST["data"];
   // $servername = "127.0.0.1:3306";

    //$dataRaw = "0115d711f41520064506b6954321";

    //----------------------------------------------
    $dataTimeStr = $dataDataTime->format('Y-m-d H:i:s');
    echo $dataTimeStr. "<br>";

    
    $dataOut = parseWxData($dataRaw, $dataStructure, $dataDataTime);
   // echo $dataDataTime->format('Y-m-d H:i:s') . "<br>";

    
    
    //----------------------------------------------
    $sqlName[0] = '`DateTime`';
    $sqlData[0] = '\''.$dataDataTime->format('Y-m-d H:i:s').'\'';
    for ($ii = 6; $ii < sizeof($dataStructure); $ii++){
        $sqlName[$ii-5] = '`'.$dataStructure[$ii][0] . '`';
        $sqlData[$ii-5] = $dataStructure[$ii][4] ;
        
       echo $sqlName[$ii-5] . ' = ' . $sqlData[$ii-5]; 
       //echo "<br>";
   //     echo $dataStructure[$ii][0] . " = " . $dataOut[$ii];
        echo "<br>";
    }
    $sqlName[sizeof($dataStructure)-5] = '`RawData`';
    $sqlData[sizeof($dataStructure)-5] = '\''.$dataRaw.'\'';
    
    //var_dump($sqlName);

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

    echo "------";



    $sql = "CREATE TABLE IF NOT EXISTS `mystation` (`ID` int(11) NOT NULL AUTO_INCREMENT, 
      `DateTime` char(19) NOT NULL COMMENT 'Date and Time of Readings',
      `windDir` decimal(12,1) NOT NULL COMMENT 'Wind Direction',
      `windSpd` decimal(12,4) NOT NULL COMMENT '(MPH)',
      `gustMax` decimal(12,4) NOT NULL COMMENT '(MPH)',
      `Tempature` decimal(12,4) NOT NULL COMMENT '(F)',
      `Pressure` decimal(12,4) NOT NULL COMMENT '(hPA)',
      `Humidity` decimal(12,4) NOT NULL COMMENT '(%)',
      `batteryV` decimal(12,4) NOT NULL COMMENT '(V)',
      `batteryP` decimal(12,4) NOT NULL COMMENT '(%)',
      `Info` decimal(12,0) NOT NULL COMMENT 'General Info',
      `RawData` char(28) NOT NULL COMMENT 'Raw Data',
       PRIMARY KEY (ID));";

    if ($conn->query($sql) === TRUE) {
        echo "created Table";

    } else {
        echo "table exists or error: " . $conn->error;
    }

     echo "<br>";
    echo "<br>";
    echo implode(', ', $sqlName);
    echo "<br>";
    echo implode(', ', $sqlData);
    echo "<br>";
    echo $dataStructure[14][4];
    echo "<br>";
    
//$sql = "INSERT INTO `mystation` (`DateTime`, `windDir`, `windSpd`, `gustMax`, `Tempature`,  `Pressure`, `Humidity`, `batteryV`, `batteryP`, `Info`,`RawData`) VALUES (`$dataTimeStr`, `\$dataStructure[6][4]`, `\$dataStructure[7][4]`, `\$dataStructure[8][4]`, `\$dataStructure[9][4]`, `\$dataStructure[10][4]`, `\$dataStructure[11][4]`, `\$dataStructure[12][4]`, `\$dataStructure[13][4]`, `\$dataStructure[14][4]`, `\$dataRaw`);";

    
     $sql = 'INSERT INTO `mystation` (' . implode(', ', $sqlName) . ') VALUES  (' . implode(', ', $sqlData) . ')';
//$sql = "INSERT INTO `mystation` (`DateTime`, `windDir`, `windSpd`, `Tempature`, `Pressure`) VALUES
//('$dataTimeStr', 5, 6, 2, 1);";


    
    echo $sql;
    echo "<br>";
    echo "<br>";
    
    if ($conn->query($sql) === TRUE) {
        echo "Inserted Data";

    } else {
        echo "Added data error: " . $conn->error;
    }

    echo "\r";



    $conn->close();

    
    
    
}
?>

 <form action="<?php $_PHP_SELF ?>" method="post">
  dataString: <input type="text" name="data"  value="" ><br>
 
  <input type="submit" name = "update" value="Update">
</form>

<font face="century gothic" size="20px"?
	<center>Hello World</center>
</font>
