<?php ob_start();

require_once('header.php');

//get racers for selected team

if (is_numeric($_GET['team_id'])) {
	$team_id = $_GET['team_id'];
	
	require_once('db.php');

	$sql = "SELECT racer_name, age, sex, phone_num FROM racers WHERE team_id = :team_id ORDER BY racer_name";
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':team_id', $team_id, PDO::PARAM_INT);
	$cmd->execute();
	$result = $cmd->fetchAll();

	echo '<table border="1">
		<tr><td>Racer</td>
		<td>Age</td>
		<td>Sex</td>
		<td>Phone</td></tr>'
	;

	foreach ($result as $row) {
		echo '<tr><td>' . $row['racer_name'] . '</td>
			<td>' . $row['age'] . '</td>
			<td>' . $row['sex'] . '</td>
			<td>' . $row['phone_num'] . '</td></tr>';
	}

	$conn = null;

	echo '</table>';	
}
else {
	header('location:default.php');
}

ob_flush(); ?>
