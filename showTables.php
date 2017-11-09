<?php
include "connect.php";
$pickedDB = $_GET['database'];

$res = mysqli_query($con, "SHOW TABLES FROM $pickedDB");
while ($row = mysqli_fetch_assoc($res)) {
  ?>
  <li class="tabs" id="<?= $row["Tables_in_$pickedDB"] ?>" onclick="getContent('<?= $pickedDB ?>', '<?= $row["Tables_in_$pickedDB"] ?>')"><a class="tabcontent"><?= $row["Tables_in_$pickedDB"] ?></a></li>
    <?php
  }
  ?>