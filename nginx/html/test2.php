<?php 

class OB_FileWriter
{
  private $_filename;
  private $_fp = null;

  public function __construct($filename)
  {
    $this->setFilename($filename);
  }

  public function __destruct()
  {
    if($this->_fp)
      $this->end()
  }

  public function setFilename($filename)
  {
    $this->_filename = $filename;
  }

  public function getFilename()
  {
    return $this->_filename;
  }

public function start()
{
  $this->_fp = @fopen($this->_filename,'w');

  if(!$this->_fp)
    throw new Exception('Cannot open '.$this->_filename.' for writing!');

  ob_start(array($this,'outputHandler'));
}

public function end()
{
  @ob_end_flush();
  if($this->_fp)
    fclose($this->_fp);
  
  $this->_fp = null;
}

public function outputHandler($buffer)
{
  fwrite($this->_fp,$buffer);
}

}



$obfw = new OB_FileWriter('test.txt');
$obfw->start();

//phpinfo(); 

//file_get_contents("php://input");
//parse_str(file_get_contents("php://input"),$post_vars);
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo "this is a get request\n";
    echo $_GET['fruit']." is the fruit\n";
    echo "I want ".$_GET['quantity']." of them\n\n";
} elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "this is a put request\n";
    parse_str(file_get_contents("php://input"),$post_vars);
    echo $post_vars['fruit']." is the fruit\n";
    echo "I want ".$post_vars['quantity']." of them\n\n";


$obfw->end();

?>


<font face="century gothic" size="20px"?
	<center>Hello World</center>
</font>