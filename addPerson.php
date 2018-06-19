<?php

include_once("./db.php");

if(isset($_GET['first_name'])){

  $query = "INSERT INTO people (first_name, last_name, email, phone) VALUES (?,?,?,?)";
  $stmt = $mysqli->prepare($query);

  $first_name = $_GET['first_name'];
  $last_name = $_GET['last_name'];
  $email = isset($_GET['email']) ? $_GET['email'] : NULL;
  $phone = isset($_GET['phone']) ? $_GET['phone'] : NULL;

  $stmt->bind_param("ssss", $first_name, $last_name, $email, $phone);

  if ($stmt->execute()) {
     $result = $mysqli->insert_id;
  } else {
     $result = $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}
?>
