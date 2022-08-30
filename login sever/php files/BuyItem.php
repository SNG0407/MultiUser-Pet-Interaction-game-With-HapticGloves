<?php
require 'ConnectionSettings.php';

//variables submited by user
// $ID = "1";
// if(isset(($_POST['ID'])))
// {
//     $ID = $_POST['ID'];
// }

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

$sql1 = "INSERT INTO usersitems (`userID`, `itemID`) VALUES ($userID, $itemID);";
$result1 = $conn->query($sql1);
//echo Checked;
if($result1)
{
    //echo ", Checked1";
    //If Inserted successfully
    $sql_getID = "SELECT ID FROM usersitems WHERE itemID = '" . $itemID . "' AND userID =  '" . $userID . "'";
    $result_getID = $conn->query($sql_getID);
    if ($result_getID->num_rows > 0)
    {
        $numResults = $result_getID->num_rows;
        $counter = 0;
        while($row = $result_getID->fetch_assoc()) {
            if (++$counter == $numResults)
            {
                echo $row["ID"];
            }
        }
        //echo $result_getID->num_rows;
    }
    //echo "ID : $sql_getID";

    //echo ", Checked2";    
    $sql = "SELECT price FROM items WHERE ID = '" . $itemID . "'";
    $result = $conn->query($sql);

    $itemPrice = $result->fetch_assoc()["price"]; //get the value with the key, price
    $sql3 = "UPDATE `user` SET `coin` = coin- '" . $itemPrice . "' WHERE `id` = '" . $userID . "'";
    $conn->query($sql3);
    
    //echo $result_getID; 
}else {
	echo "Error: could not insert item";
}
$conn->close();

?>