<?php ob_start();

require_once('header.php');

$form_ok = true;

if (empty($_POST['racer_name'])) {
	$form_ok = false;
	echo 'Racer Name is Required<br />';
}

if (empty($_POST['age'])) {
	$form_ok = false;
	echo 'Age is Required<br />';
}

if (empty($_POST['sex'])) {
	$form_ok = false;
	echo 'Sex is Required<br />';
}

if (empty($_POST['phone_num'])) {
	$form_ok = false;
	echo 'Phone Number is Required<br />';
}

if ($form_ok = true) {
	$racer_name = $_POST['racer_name'];
	$age = $_POST['age'];
	$sex = $_POST['sex'];
	$phone_num = $_POST['phone_num'];
	$team_id = $_POST['team_id'];
	
	//form is good, so save to db
	require_once('db.php');
	$sql = "INSERT INTO racers (racer_name, age, sex, phone_num, team_id) VALUES (:racer_name, :age, :sex, :phone_num, :team_id)";
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':racer_name', $racer_name, PDO::PARAM_STR, 50);
	$cmd->bindParam(':age', $age, PDO::PARAM_INT);
	$cmd->bindParam(':sex', $sex, PDO::PARAM_STR, 50);
	$cmd->bindParam(':phone_num', $phone_num, PDO::PARAM_STR, 15);
	$cmd->bindParam(':team_id', $team_id, PDO::PARAM_INT);
	$cmd->execute();
	$conn = null;
	
	header('location:roster.php?team_id=' . $team_id);
}
else {
	echo('Your entry could not be saved.  Click <a href="javascript:history.go(-1)">Here</a> to go back.');
}

?>

</body>
</html>

<?php ob_flush(); ?>