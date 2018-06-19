<?php

include_once("./db.php");

if(isset($_GET['id'])){

  $query = "UPDATE events SET s_date = ?, e_date = ?, allDay = ? WHERE id = ?";
  $stmt = $mysqli->prepare($query);

  $parent = NULL;
  $description = NULL;

  $id = $_GET['id'];
  $newStart = $_GET['newStart'];
  $newEnd = $_GET['newEnd'];
  $allDay = $_GET['allDay'];

  $stmt->bind_param("ssii", $newStart, $newEnd, $allDay, $id);

  if ($stmt->execute()) {
     $result = "Record updated successfully";
  } else {
     $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}
?>
