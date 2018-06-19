<?php

include_once("./db.php");

if(isset($_GET['targetID'])){

  $query = "INSERT INTO temp_roles
            (template_id, role, person, groupID)
            SELECT ?, role, person, groupID FROM temp_roles
            WHERE temp_roles.template_id = ?";

  $stmt = $mysqli->prepare($query);

  $targetTemplate = $_GET['targetID'];
  $sourceTemplate = $_GET['sourceID'];
  
  $stmt->bind_param("ii", $targetTemplate, $sourceTemplate);

  if ($stmt->execute()) {
     $result = "Record updated successfully";
  } else {
     $result = $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}

?>
