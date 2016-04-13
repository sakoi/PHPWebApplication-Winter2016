<?php
//connect
require_once('../db.php');
// select and store
$sql = "Select * FROM game";


//if specific game
if(!empty($_GET['name'])) {
    $sql .= " WHERE name = :name";

}

$cmd = $conn->prepare($sql);

if(!empty($_GET['name'])){
    $cmd->bindParam(':name', $_GET['name'], PDO::PARAM_STR);
}

$cmd->execute();
$games = $cmd->fetchAll();

//convert to json
$json_object = json_encode($games);

// display data
echo $json_object;

//disconnect
$conn = null;

?>