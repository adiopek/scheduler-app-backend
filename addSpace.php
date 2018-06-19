<?php

include_once("./db.php");

if(isset($_GET['spaceName'])){

$query = "INSERT INTO spaces (name, description) VALUES (?,?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss", $name, $description);

$name = $_GET['spaceName'];
$description = $_GET['description'];

if ($stmt->execute()) {
   $result = $mysqli->affected_rows;
} else {
   $mysqli->error.__LINE__;
}

echo $json_response = json_encode($result);

}
?>
