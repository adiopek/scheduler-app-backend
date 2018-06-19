<?php

include_once("./db.php");

if(isset($_GET['templateName'])){

  $query = "INSERT INTO templates (default_name, description, default_color, default_start, default_end, parent, all_day)
            VALUES (?,?,?,?,?,?,?)";
  $stmt = $mysqli->prepare($query);

  $parent = NULL;
  $description = NULL;

  $name = $_GET['templateName'];
  $parent = isset($_GET['parent']) ? $_GET['parent'] : NULL;
  $description = isset($_GET['description']) ? $_GET['description'] : NULL;
  $color = $_GET['color'];
  $momentStart = $_GET['momentStart'];
  $momentEnd = $_GET['momentEnd'];
  $allDay = $_GET['allDay'];

  $stmt->bind_param("sssssii", $name, $description, $color, $momentStart, $momentEnd, $parent, $allDay);

  if ($stmt->execute()) {
     $result = $mysqli->insert_id;
  } else {
     $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}
?>
