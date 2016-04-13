<?php

require_once('header.php');

//require_once('db.php');

//get the search term(s)
$user_search = $_POST['keywords'];

//split this into a list based on the spaces between each word
$search_words = explode(' ', $user_search);

//start the sql
//can add connection here
$sql = "SELECT * FROM racers WHERE ";
$where = "";
$counter = 1;

//now check the list in a loop
foreach ($search_words as $word) {
	if ($counter == 1) {
		$where = $where . " racer_name LIKE '%$word%' ";
	}
	else {
		$where = $where . " OR racer_name LIKE '%$word%'";	
	}

	$counter++;
}

$sql = $sql . $where;

$next_direction = "DESC";

if (isset($_GET['sort'])) {
	$order = " ORDER BY $_GET[sort]";
	
	if (isset($_GET['direction'])) {
		$direction = $_GET['direction'];
		
		if ($direction == "DESC") {
			$next_direction = "ASC";
		}
		else {
			$next_direction = "DESC";
		}
	}
	else {
		$direction = "ASC";
		$next_direction = "DESC";
	}	
	$sql .= $order . ' ' . $direction;
}

$cmd = $conn->prepare($sql);
$cmd->execute();
$result = $cmd->fetchAll();

echo '<table border="1"><tr>
<td><a href="search_results.php?keywords=' . $user_search .'&sort=racer_name
&direction=' . $next_direction .'">Racer name</a></td>
<td><a href="search_results.php?keywords=' . $user_search .'&sort=age
&direction=' . $next_direction .'">Age</a></td>
<td><a href="search_results.php?keywords=' . $user_search .'&sort=sex
&direction=' . $next_direction .'">Sex</a></td>
<td><a href="search_results.php?keywords=' . $user_search .'&sort=phone_num
&direction=' . $next_direction .'">Phone</a></td></tr>';

foreach ($result as $row) {
	echo '<tr><td>' . $row['racer_name'] . '</td>
	<td>' . $row['age'] . '</td>
	<td>' . $row['sex'] . '</td>
	<td>' . $row['phone_num'] . '</td></tr>';

}

echo '</table>';
$conn = null;

?>

</body>

</html>
