<!DOCTYPE html>
<html>
<head>
	<title>Lab 5</title>
	<link type="text/css" rel="stylesheet" href="styles.css" />

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

	<!-- Font Awesome Css -->
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


</head>

<body>
<div>

<ul>

<?php

require_once('db.php');

$sql = "SELECT team_id, team_name FROM teams";
$cmd = $conn->prepare($sql);
$cmd->execute();
$result = $cmd->fetchAll();

//loop through results to create links to roster page
foreach ($result as $row) {
	echo '<li><a href="roster.php?team_id=' . $row['team_id'] . '">' . $row['team_name'] . '</a></li>';
}

//$conn = null;

?>

	<li><a href="search.php">Search</a></li>
	<li><a href="add_racer.php">Add Racer</a></li>
</ul>

</div>