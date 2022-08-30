<?php
require 'ConnectionSettings.php';

//variables submited by user
$userID = "1"; if(isset(($_POST['userID'])))
{ 
    $userID = $_POST['userID']; 
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully". "<br>";


$sql = "SELECT itemID FROM usersitems WHERE userID = '" . $userID . "'";
//$sql = "SELECT itemID FROM usersitems WHERE userID = 1";
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