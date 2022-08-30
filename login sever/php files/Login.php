<?php
require 'ConnectionSettings.php';

//variables submited by user
$loginUser = ""; if(isset(($_POST['loginUser'])))
{ 
    $loginUser = $_POST['loginUser']; 
    //echo "It's not Null <br>"; 
}else{echo "It's Null"; }
$loginpass = ""; if(isset(($_POST['loginpass']))){ $loginpass = $_POST['loginpass']; }else{$loginpass = "123";}
//$loginUser = isset($_POST['loginUser']);
//$loginpass = isset($_POST["loginpass"]);

/*
if(isset($_POST['loginUser']))
{$loginUser= $_POST["loginUser"];}

if(isset($_POST["loginpass"]))
{$loginpass= $_POST["loginpass"];}
*/

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully". "<br>";

//Normal Statement and Query Which can be Injected and hacked
//$sql = "SELECT password, id FROM user WHERE username = '" . $loginUser . "'";
//$result = $conn->query($sql);

//Prepared Statment Preventing Injection Converting all input into a string
$sql = "SELECT password, id FROM user WHERE username = ?";
$statement = $conn->prepare($sql);
$statement->bind_param("s", $loginUser); //s = string, if it gets two values say 'ss'
$statement->execute();
$result = $statement->get_result();


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    
    if($row["password"]== $loginpass)
    {
        //echo "Login Success.";
        echo $row["id"];
    }
    else{
        echo "WrongPassword";
    }
  }
} else {
  echo "NoUserName";
}
$conn->close();  

?>