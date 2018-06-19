<?php

include_once("./db.php");

if(isset($_GET['name'])){

  $query = "INSERT INTO events (name, description, color, parent, allDay, s_date, e_date) VALUES (?,?,?,?,?,?,?)";
  $stmt = $mysqli->prepare($query);

  $name = $_GET['name'];
  $description = isset($_GET['description']) ? $_GET['description'] : NULL;
  $parent = isset($_GET['parent']) ? $_GET['parent'] : NULL;
  $color = $_GET['color'];
  $allDay = $_GET['allDay'];
  $start = $_GET['start'];
  $end = $_GET['end'];

  $stmt->bind_param("sssiiss", $name, $description, $color, $parent, $allDay, $start, $end);

  if ($stmt->execute()) {
     $result = $mysqli->insert_id;
  } else {
     $result = $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}
?>
