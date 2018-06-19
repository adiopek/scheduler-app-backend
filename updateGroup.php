<?php

include_once("./db.php");

if(isset($_GET['id'])){

  $query = "UPDATE groups SET     name = ?,
                                  description = ?
                                  WHERE id = ?";

  $stmt = $mysqli->prepare($query);

  $id = $_GET['id'];
  $name = $_GET['name'];
  $description = isset($_GET['description']) ? $_GET['description'] : NULL;

  $stmt->bind_param("ssi", $name, $description, $id);

  if ($stmt->execute()) {
     $result = "Record updated successfully";
  } else {
     $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}
?>
