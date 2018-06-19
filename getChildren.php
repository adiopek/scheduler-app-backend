<?php

include_once("./db.php");

if(isset($_GET['parent'])){

  $query = "SELECT  id,
                    s_date as start,
                    e_date as end,
                    name as title,
                    allDay,
                    color,
                    parent
                    from events WHERE parent=? ORDER BY id";

  $stmt = $mysqli->prepare($query);

  $parent = $_GET['parent'];

  $stmt->bind_param("i", $parent);

  if ($stmt->execute()) {
     $result = $stmt->get_result();
  } else {
     $mysqli->error.__LINE__;
  }

  $arr = array();
  if($result->num_rows > 0) {
  	while($row = $result->fetch_assoc()) {
  		$arr[] = $row;
  	}
  }

  echo $json_response = json_encode($arr);
}

?>
