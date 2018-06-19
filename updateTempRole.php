<?php

include_once("./db.php");

if(isset($_GET['id'])){

  $query = "UPDATE temp_roles SET role = ?,
                                  person = ?,
                                  groupID = ?
                                  WHERE id = ?";

  $stmt = $mysqli->prepare($query);

  $id = $_GET['id'];
  $role = $_GET['role'];
  $person = isset($_GET['person']) ? $_GET['person'] : NULL;
  $group = isset($_GET['group']) ? $_GET['group'] : NULL;

  $stmt->bind_param("siii", $role, $person, $group, $id);

  if ($stmt->execute()) {
     $result = "Record updated successfully";
  } else {
     $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}
?>
