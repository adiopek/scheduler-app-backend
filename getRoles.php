<?php

include_once("./db.php");

if(isset($_GET['event'])){
  $query = "SELECT  roles.id,
                    role,
                    people.id AS 'personID',
                    CONCAT(people.first_name, ' ', people.last_name) as 'person',
                    groups.id AS 'groupID',
                    groups.name AS 'group'
                    from roles
                    LEFT JOIN people ON roles.person = people.id
                    LEFT JOIN groups ON roles.groupID = groups.id
                    WHERE roles.event_id = ?";

  $stmt = $mysqli->prepare($query);

  $event = $_GET['event'];

  $stmt->bind_param("i", $event);

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

}

?>
