<?php

include_once("./db.php");

$query = "SELECT id, name as title, s_date as start, e_date as end, allDay, color from events where id = ?";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id);

$id = $_GET['id'];

if ($stmt->execute()) {
   $result = $stmt->get_result();
} else {
   $mysqli->error.__LINE__;
}

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;
	}
}

echo $json_response = json_encode($arr);

?>
