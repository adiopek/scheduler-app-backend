<?php

include_once("./db.php");

$query = "SELECT  id,
                  default_name as defName,
                  description as description,
                  default_color as defColor,
                  all_day as allDay,
                  default_start as momentStart,
                  default_end as momentEnd,
                  parent
                  from templates WHERE parent IS NULL ORDER BY id";

$stmt = $mysqli->prepare($query);

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
