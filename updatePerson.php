<?php

include_once("./db.php");

if(isset($_GET['id'])){

  $query = "UPDATE people SET     first_name = ?,
                                  last_name = ?,
                                  email = ?,
                                  phone = ?
                                  WHERE id = ?";

  $stmt = $mysqli->prepare($query);

  $id = $_GET['id'];
  $firstName = $_GET['first_name'];
  $lastName = $_GET['last_name'];
  $email = isset($_GET['email']) ? $_GET['email'] : NULL;
  $phone = isset($_GET['phone']) ? $_GET['phone'] : NULL;

  $stmt->bind_param("ssssi", $firstName, $lastName, $email, $phone, $id);

  if ($stmt->execute()) {
     $result = "Record updated successfully";
  } else {
     $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}
?>
