<?php

$dataStructure = array(
        
          array("year"     ,4,  1      ,    0,    1     ),
          array("month"    ,4,  1      ,    0,    2     ),
          array("day"      ,5,  1      ,    0,    3     ),
          array("hour"     ,5,  1      ,    0,    10    ),
          array("minute"   ,6,  1      ,    0,    37    ),
          array("second"   ,6,  1      ,    0,    54    ),
          array("windDir"  ,4,  1      ,    0,    10    ),
          array("windSpd"  ,10, 8.9737 ,    0,    35.8  ),
          array("gustMax"  ,11, 1      ,    0,    100   ),
          array("Tempature",10, 10.7684,  -30,    23.5  ),
          array("Pressure" ,10, 5.115  ,  900,    1002.2),
          array("Humidity" ,10, 10.23  ,    0,    56.2  ),
          array("batteryV" ,8,  212.5  ,    3,    3.87  ),
          array("batteryP" ,8,  2.55   ,    0,    68.4  ),
          array("info"     ,8,  1      ,    0,    1     )
        );

$dateSrc = '2007-04-19 12:50'; 
$dataDataTime = DateTime::createFromFormat('j-M-Y', '15-Feb-2009');//new DateTime($dateSrc); 

    
function parseWxData($dataIn, &$dataStructureIn, &$dataTime)
{

    $sumBytes = 0;
    $remBits = 0;
    $shiftCount = 9; //1 byte after starting 32 bits

    //Init working 32bits
    $working8Bytes = hexdec(substr($dataIn, strlen($dataIn)-8 ,8));  // 8bytes


    for ($x = 0; $x < sizeof($dataStructureIn); $x++){
        // Capture size and names
        $varName  = $dataStructureIn[$x][0];
        $bitSize  = $dataStructureIn[$x][1];
        
        //Accumulate bits
        $sumBytes = $sumBytes + $bitSize;
    
        //Send data out and shift
        $dataInt  = $working8Bytes &  (2**$bitSize -1);
        $working8Bytes = ($working8Bytes >> $bitSize) & (2**(32-$bitSize) -1);
        
        // Used to calculate when to shift data into workingbytes.  
        $remBits = $remBits + $bitSize;

        
        // Shift every 5 bits or 1 byte
        if ($remBits >= 4){
            // check how many bytes to shift
            for($ii = 0; $ii < floor($remBits/4); $ii++){
                if ($shiftCount < strlen($dataIn)){
                    //Bring shifted data in
                    $working8Bytes = $working8Bytes | (hexdec(substr($dataIn,strlen($dataIn)-$shiftCount,1)) << (32-$remBits));
                    $shiftCount++;
                    $remBits = $remBits - 4;
                }
                else{
                    $working8Bytes = $working8Bytes;
                }
            }
        }
        
        
        $dataOut[$x] = (($dataInt & (2**$bitSize-1))*(1.0/$dataStructureIn[$x][2]) + $dataStructureIn[$x][3]);
       // echo $dataOut[$x];
       // echo "<br>";
        
    } 
    
    //Create datetime
    $stringTime = $dataStructureIn[0][4] . "-" . $dataStructureIn[1][4] . "-" . $dataStructureIn[2][4]
        . " " . $dataStructureIn[3][4] . ":" . $dataStructureIn[4][4] . ":" . $dataStructureIn[5][4];
   
    
    $dataTime = DateTime::createFromFormat('Y-m-d H:i:s', $stringTime);
    return $dataOut;
}

?>

