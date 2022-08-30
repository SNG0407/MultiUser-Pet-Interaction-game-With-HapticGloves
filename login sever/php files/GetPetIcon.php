<?php
require 'ConnectionSettings.php';



// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//variables submited by user
$petID = "1"; if(isset(($_POST['petID'])))
{ 
    $petID = $_POST['petID']; 
}

$path = "http://43.200.5.117/petIcons/" . $petID. ".png; 

$image = file_get_contents($path);

echo $image

$conn->close();  

?>