<?php

include_once("./db.php");

if(isset($_GET['groupID'])){
  $query = "SELECT  groups_people.id,
                    people.first_name,
                    people.last_name,
                    people.email,
                    people.phone
                    from groups_people
                    JOIN people ON groups_people.personID = people.id
                    WHERE groups_people.groupID = ?";

  $stmt = $mysqli->prepare($query);

  $groupID = $_GET['groupID'];

  $stmt->bind_param("i", $groupID);

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
