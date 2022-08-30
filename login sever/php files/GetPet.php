<?php
require 'ConnectionSettings.php';

//variables submited by user
$petID = "1"; if(isset(($_POST['petID'])))
{ 
    $petID = $_POST['petID']; 
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT ownerID, name, description, price, image, 3D FROM pet WHERE petID = '" . $petID . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
  // output data of each row
  $rows = array(); //Creating an array

  while($row = $result->fetch_assoc()) 
  {
    $rows[] = $row;
  }
  //after the whole array is created
  echo json_encode($rows);
} else {
  echo "0 result";
}
$conn->close();  

?>