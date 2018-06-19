<?php

include_once("./db.php");

if(isset($_GET['name'])){

  $query = "INSERT INTO groups (name, description) VALUES (?,?)";
  $stmt = $mysqli->prepare($query);

  $name = $_GET['name'];
  $description = isset($_GET['description']) ? $_GET['description'] : NULL;

  $stmt->bind_param("ss", $name, $description);

  if ($stmt->execute()) {
     $result = $mysqli->insert_id;
  } else {
     $result = $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}
?>
