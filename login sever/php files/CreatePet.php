<?php
require 'ConnectionSettings.php';

//variables submited by user
$ownerID = "ownerID null"; if(isset(($_POST['userID'])))
{ 
    $ownerID = $_POST['userID']; 
}

$name = "pet"; if(isset(($_POST['name'])))
{ 
    $name = $_POST['name']; 
}

$description = "pet description"; if(isset(($_POST['description'])))
{ 
    $description = $_POST['description']; 
}

$price = "10000"; if(isset(($_POST['price'])))
{ 
    $price = $_POST['price']; 
}

$image = "image null"; if(isset(($_POST['image'])))
{ 
    $image = $_POST['image']; 
}

$3D = "3D null"; if(isset(($_POST['3D'])))
{ 
    $3D = $_POST['3D']; 
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT name FROM pet WHERE name = '" . $name . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  //Tell user that that name is already taken
  echo "This pet name is already taken";

} else {
//Insert the user and password into the database
  echo "Create pet... ";
  $sql2 = "INSERT INTO pet (ownerID, name, description, price, image, 3D) VALUES ('" . $ownerID . "', '" . $name . "', '" . $description . "', '" . $price . "', '" . $image . "', '" . $3D . "')";
  if ($conn->query($sql2) === TRUE) {
  echo "New pet created successfully";
} else {
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}

}
$conn->close();  

?>