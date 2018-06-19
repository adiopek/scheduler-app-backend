<?php

include_once("./db.php");

$query = "SELECT id, name as title, description, s_date as start, e_date as end, allDay, color from events where s_date > ? AND s_date < ? ORDER BY id";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss", $start, $end);

$start = date('Y-m-d', strtotime(substr($_GET['start'],0,10)));
$end = date('Y-m-d', strtotime(substr($_GET['end'],0,10)));

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
