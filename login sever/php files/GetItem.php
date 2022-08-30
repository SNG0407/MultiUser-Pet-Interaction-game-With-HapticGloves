<?php
require 'ConnectionSettings.php';

//variables submited by user
$itemID = "2"; if(isset(($_POST['itemID'])))
{ 
    $itemID = $_POST['itemID']; 
}
/*
$loginUser = ""; if(isset(($_POST['loginUser'])))
{ 
    $loginUser = $_POST['loginUser']; 
}else{echo "It's Null"; }
$loginpass = ""; if(isset(($_POST['loginpass'])))
{ 
    $loginpass = $_POST['loginpass']; 
}else{$loginpass = "123";}
*/



// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully". "<br>";


$sql = "SELECT name, description, price FROM items WHERE ID = '" . $itemID . "'";
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