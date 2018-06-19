<?php

include_once("./db.php");

if(isset($_GET['template'])){
  $query = "SELECT  temp_roles.id,
                    role,
                    people.id AS 'personID',
                    CONCAT(people.first_name, ' ', people.last_name) as 'person',
                    groups.id AS 'groupID',
                    groups.name AS 'group'
                    from temp_roles
                    LEFT JOIN people ON temp_roles.person = people.id
                    LEFT JOIN groups ON temp_roles.groupID = groups.id
                    WHERE temp_roles.template_id = ?";

  $stmt = $mysqli->prepare($query);

  $template = $_GET['template'];

  $stmt->bind_param("i", $template);

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
