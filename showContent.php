<!DOCTYPE html>
<html>
  <body>
    <?php
    include "connect.php";

    $pickedDB = $_GET['database'];
    $pickedTable = $_GET['table'];
    $conTable = new mysqli($serverName, $username, $password, $pickedDB);

    if (mysqli_connect_errno($conTable)) {
      echo 'There was an error with the connection!';
    }

    echo "<table>";
    $sqlT = "SHOW COLUMNS FROM $pickedTable";
    $resultT = mysqli_query($conTable, $sqlT);
    while ($rowT = mysqli_fetch_array($resultT)) {
      echo '<td style="text-align: center;  border-bottom: black solid 1px;"><b>' . $rowT['Field'] . "</b></td>";
    }


    $sqlC = "SELECT * FROM $pickedTable";
    $resultC = mysqli_query($conTable, $sqlC);
    while ($rowC = mysqli_fetch_array($resultC)) {
      echo "<tr>";
      for ($i = 0; $i < mysqli_num_fields($resultC); $i++) {
        echo '<td style="text-align: center;"><b>' . $rowC[$i] . "</b></td>";
      }
      echo "</tr>";
    }
    echo "</table>";



    mysqli_close($con);
    ?>
  </body>
</html>