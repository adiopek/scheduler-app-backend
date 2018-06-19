<?php

include_once("./db.php");

$query = "SELECT  id,
                  name,
                  description
                  FROM groups";

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
