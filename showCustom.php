<?php

include "connect.php";

$pickedDB = $_GET['database'];
if ($_GET['database'] != "No database selected.") {
  $conCust = new mysqli($serverName, $username, $password, $pickedDB);

  $sqlCust = $_GET["query"];
  $resultCust = mysqli_query($conCust, $sqlCust);
  if ($resultCust != false) {
    while ($rowCust = mysqli_fetch_array($resultCust)) {
      echo "<pre>";
      print_r($rowCust);
      echo "</pre>";
    }
  } else {
    echo "Invalid query.";
  }
} else {
  echo "No database selected.";
}
?>

