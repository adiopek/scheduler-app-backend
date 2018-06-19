<?php

include_once("./db.php");

if(isset($_GET['groupID'])){

  $query = "INSERT INTO groups_people (personID, groupID) VALUES (?,?)";
  $stmt = $mysqli->prepare($query);

  $groupID = $_GET['groupID'];
  $personID = $_GET['personID'];

  $stmt->bind_param("ii", $personID, $groupID);

  if ($stmt->execute()) {
     $result = $mysqli->insert_id;
  } else {
     $result = $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}
?>
