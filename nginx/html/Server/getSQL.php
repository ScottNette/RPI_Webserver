<?php 


$numData = $_GET["numData"];
$type = $_GET["type"];


$config = parse_ini_file('/var/www/db.ini');
// Create connection
$conn = new mysqli("localhost",$config['username'],$config['password'], $config['db']);

// Check connection
if ($conn->connect_error) {
    die($conn->connect_error);
} 




$result = $conn->query("SELECT * 
							FROM ( 
									SELECT * 
									FROM mystation 
									ORDER BY 
										ID DESC 
									LIMIT $numData 
									) q 
									ORDER BY 
                                    ID ASC" );
                                    



 
if (mysqli_num_rows($result) > 0) {
  
    if ($type == "windSpd"){
        $data = array("Date, Wind Speed\n");
    } elseif ($type == "windDir"){
        $data = array("Date, Wind direction\n");
    } elseif ($type == "temp"){
        $data = array("Date, Temperature\n");
    } elseif ($type == "press"){
        $data = array("Date, Pressure\n");
    } elseif ($type == "humid"){
        $data = array("Date, Humidity\n");
    }
  


   //echo "ID	 	DateTime		TempOutCur		HumidityCur		PressOutCur		WindOutCur    WindDirOutCur<br>";
    while($row = mysqli_fetch_assoc($result)) {
    //   echo $row["ID"] . "," . $row["DateTime"] . "," . $row["TempOutCur"] . "," . $row["HumOutCur"] ."," . $row["PressOutCur"] ."," . $row["WindOutCur"] ."," . $row["WindDirOutCur"] . " <br>";
        if ($type == "windSpd"){           
            $data[] = implode("",array("*", str_replace("-","/",(string)$row['DateTime']),",", (string)$row['WindOutCur'],"\n"));
        } elseif ($type == "windDir"){
            $data[] = implode("",array("*", str_replace("-","/",(string)$row['DateTime']),",", (string)$row['WindDirOutCur'],"\n"));
        } elseif ($type == "temp"){
            $data[] = implode("",array("*", str_replace("-","/",(string)$row['DateTime']),",", (string)$row['TempOutCur'],"\n"));
        } elseif ($type == "press"){
            $data[] = implode("",array("*", str_replace("-","/",(string)$row['DateTime']),",", (string)$row['PressOutCur'],"\n"));
        } elseif ($type == "humid"){
            $data[] = implode("",array("*", str_replace("-","/",(string)$row['DateTime']),",", (string)$row['HumOutCur'],"\n"));
        }
    
        //$data['ID'][] = $row["ID"];
        //$data['DateTime'][] = $row["DateTime"];
       // $data['Temp'][] = $row["TempOutCur"];
        //$data['Hum'][] = $row["HumOutCur"];
        //$data['Press'][] = $row["PressOutCur"];
        //$data['Wind'][] = $row["WindOutCur"];
        //$data['WindDir'][] = $row["WindDirOutCur"];
       //echo "".$row['ID']."," <br>";

    }
 }

 //echo "<br>";
//$json = json_encode($data);
echo str_replace(",*","\n",implode(",",$data));

//echo $data;

//print_r($data);

$result->close();
$conn->close();

?>