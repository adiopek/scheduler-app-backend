<?php

include_once("./db.php");

if(isset($_GET['role'])){

  $query = "INSERT INTO roles (event_id, role, person, groupID) VALUES (?,?,?,?)";
  $stmt = $mysqli->prepare($query);

  $role = $_GET['role'];
  $event = $_GET['event'];
  $person = isset($_GET['person']) ? $_GET['person'] : NULL;
  $group = isset($_GET['group']) ? $_GET['group'] : NULL;

  $stmt->bind_param("isii", $event, $role, $person, $group);

  if ($stmt->execute()) {
     $result = $mysqli->insert_id;
  } else {
     $result = $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}
?>
