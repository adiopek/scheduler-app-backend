<?php

include_once("./db.php");

function importRoles($sourceTemplate, $targetEvent, $mysqli) {

  $query = "INSERT INTO roles
            (event_id, role, person, groupID)
            SELECT ?, role, person, groupID FROM temp_roles
            WHERE temp_roles.template_id = ?";

  $stmt = $mysqli->prepare($query);

  $stmt->bind_param("si", $targetEvent, $sourceTemplate);

  if ($stmt->execute()) {
     $result = "Record updated successfully";
  } else {
     $mysqli->error.__LINE__;
  }

  echo $json_response = json_encode($result);

}

function importEvents($sourceTemplate, $targetEvent, $mysqli) {

  importRoles($sourceTemplate, $targetEvent, $mysqli);

  $query = "SELECT  id,
                    default_name as defName,
                    description as description,
                    default_color as defColor,
                    all_day as allDay,
                    default_start as momentStart,
                    default_end as momentEnd
                    from templates WHERE parent = ? ORDER BY id";

  $stmt = $mysqli->prepare($query);
  $parent = $sourceTemplate;
  $stmt->bind_param("i", $parent);

  if ($stmt->execute()) {
     $result = $stmt->get_result();
  } else {
     $mysqli->error.__LINE__;
  }

  $arr = array();
  if($result->num_rows > 0) {

    while($row = $result->fetch_object()) {
  		$arr[] = $row;
  	}

    foreach ($arr as $template) {
      $query = "INSERT INTO events (name, description, color, parent, allDay, s_date, e_date) VALUES (?,?,?,?,?,?,?)";

      $stmt = $mysqli->prepare($query);

      $name = $template->defName;
      $description = $template->description;
      $parent = $targetEvent;
      $color = $template->defColor;
      $allDay = $template->allDay;
      $start = $template->momentStart;
      $end = $template->momentEnd;

      $stmt->bind_param("sssiiss", $name, $description, $color, $parent, $allDay, $start, $end);

      if ($stmt->execute()) {
         $result = $mysqli->insert_id;
         importEvents($template->id, $result, $mysqli);
      } else {
         $result = $mysqli->error.__LINE__;
      }
      echo $json_response = json_encode($result);
    }

  }

}

if(isset($_GET['eventID'])){

  importEvents($_GET['template'], $_GET['eventID'], $mysqli);

}
?>
