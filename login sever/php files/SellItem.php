<?php
require 'ConnectionSettings.php';

//variables submited by user
$ID = "1";
if(isset(($_POST['ID'])))
{
    $ID = $_POST['ID'];
}

$itemID = "1";
if(isset(($_POST['itemID'])))
{
    $itemID = $_POST['itemID'];
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


$sql = "SELECT price FROM items WHERE ID = '" . $itemID . "'";
//$sql = "SELECT itemID FROM usersitems WHERE userID = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    //Store item price
    $itemPrice = $result->fetch_assoc()["price"]; //get the value with the key, price

    //Second Sql
    $sql2 = "DELETE FROM usersitems WHERE ID = '" . $ID . "'";

    $result2 = $conn->query($sql2);
    if($result2)
    {
        //If deleted successfully
        $sql3 = "UPDATE `user` SET `coin` = coin+ '" . $itemPrice . "' WHERE `id` = '" . $userID . "'";
        $conn->query($sql3);
    } else {
		echo "Error: could not delete item";
    }
}else {
	echo "0";
}
$conn->close();

?>