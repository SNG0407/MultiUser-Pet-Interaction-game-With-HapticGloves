<?php
require 'ConnectionSettings.php';

$petID = "1";
if(isset(($_POST['petID'])))
{
    $petID = $_POST['petID'];
}

$userID = "1"; if(isset(($_POST['userID'])))
{
    $userID = $_POST['userID'];
}

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully". "<br>";

$sql1 = "INSERT INTO userspets (`userID`, `petID`) VALUES ($userID, $petID);";
$result1 = $conn->query($sql1);
//echo Checked;
if($result1)
{
    //echo ", Checked1";
    //If Inserted successfully
    $sql_getID = "SELECT ID FROM userspets WHERE petID = '" . $petID . "' AND userID =  '" . $userID . "'";
    $result_getID = $conn->query($sql_getID);
    if ($result_getID->num_rows > 0)
    {
        $numResults = $result_getID->num_rows;
        $counter = 0;
        while($row = $result_getID->fetch_assoc()) {
            if (++$counter == $numResults)
            {
                echo $row["ID"]; //lasted ID
            }
        }
        //echo $result_getID->num_rows;
    }
    //echo "ID : $sql_getID";

    //echo ", Checked2";    
    $sql = "SELECT price, onwerID FROM pet WHERE petID = '" . $petID . "'";
    $result = $conn->query($sql);

    $itemPrice = $result->fetch_assoc()["price"]; //get the value with the key, price
    $ownerID = $result->fetch_assoc()["onwerID"];

    $sql3 = "UPDATE `user` SET `coin` = coin- '" . $itemPrice . "' WHERE `id` = '" . $userID . "'";
    $conn->query($sql3);

    $sql4 = "UPDATE `user` SET `coin` = coin+ '" . $itemPrice . "' WHERE `id` = '" . $ownerID . "'";
    $conn->query($sql4);

    //echo $result_getID; 
}else {
	echo "Error: could not insert item";
}
$conn->close();

?>