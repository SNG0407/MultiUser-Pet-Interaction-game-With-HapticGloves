<?php
require 'ConnectionSettings.php';

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT petID, ownerID, name, description, price, image, 3D FROM pet";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
  //echo $result->num_rows;
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