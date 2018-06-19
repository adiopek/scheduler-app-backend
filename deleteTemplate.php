<?php

include_once("./db.php");

if(isset($_GET['id'])){

  $query = "DELETE FROM templates WHERE id=?";

  $stmt = $mysqli->prepare($query);

  $id = $_GET['id'];

  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
     $result = $stmt->get_result();
  } else {
     $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}

?>
