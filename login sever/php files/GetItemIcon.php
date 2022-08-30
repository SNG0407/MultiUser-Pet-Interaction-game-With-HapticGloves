<?php
require 'ConnectionSettings.php';



// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//variables submited by user
$itemID = "1"; if(isset(($_POST['itemID'])))
{ 
    $itemID = $_POST['itemID']; 
}

$path = "http://43.200.5.117/ItemIcons/" . $itemID. ".png; 

$image = file_get_contents($path);

echo $image

$conn->close();  

?>