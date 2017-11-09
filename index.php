<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Databases</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type='text/javascript' src='js/jquery.mousewheel.min.js'></script>

  </head>
  <script>
    $(function () {
      $(".nav-tabs").mousewheel(function (event, delta) {
        this.scrollLeft -= (delta * 50);
        event.preventDefault();
      });
    });

    function getTables(database) {
      document.getElementById("DBName").innerHTML = database;

      if (database == "") {
        document.getElementById("tables").innerHTML = "<b>No database selected.<b/>";
        return;
      } else {
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tables").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "showTables.php?database=" + database, true);
        xmlhttp.send();
      }
      setTimeout(function () {
      }, 10);
    }

    function getContent(database, table) {
      var tabs = document.getElementsByClassName("tabs");
      for (i = 0; i < tabs.length; i++) {
        tabs[i].className = "tabs";
      }

      document.getElementById(table).className += " active";

      if (table == "") {
        document.getElementById("content").innerHTML = "<b>No table selected.</b>";
        return;
      } else {
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("content").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "showContent.php?database=" + database + "&table=" + table, true);
        xmlhttp.send();
      }
    }

    function getCustom() {
      var query = document.getElementById("sqlTextarea").value;
      var database = document.getElementById("DBName").innerHTML;

      if (query == "") {
        document.getElementById("content").innerHTML = "<b>No query found.</b>";
        return;
      } else {
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("content").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "showCustom.php?database=" + database + "&query=" + query, true);
        xmlhttp.send();
      }
    }

//    alert();
  </script>
  <body>
    <?php
    include "connect.php";
    ?>
    <div class="row">
      <input id="sqlTextarea" class="col-md-10 col-md-offset-1 textarea" type="text" onkeypress="javascript: if (event.keyCode == 13)
            getCustom();" placeholder="Custom query">
    </div>
    <br />
    <!-- start sidebar -->
    <div id="sidebar" class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Databases.</div>
        <div class="panel-body">
          <ul class="item-list">
            <?php
            $res = mysqli_query($con, "SHOW DATABASES");
            while ($row = mysqli_fetch_assoc($res)) {
              ?>
              <li class="list-item" onclick="getTables('<?= $row["Database"] ?>');"><?= $row["Database"] ?></li>
              <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
    <!-- end sidebar -->

    <div class="row col-md-9">

      <!-- start content -->
      <div id="mainPanel">

        <!--start navtabs-->
        <ul class="nav nav-tabs" id="tables" style="margin: 0px 10px -2px 10px">
          <li class="tabs"><a href="#" class="tabcontent">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
        </ul>
        <!--end navtabs-->


        <div class="panel panel-default">
          <div class="panel-heading" id='DBName'>No database selected.</div>
          <div class="panel-body"  style="overflow: auto; max-height: 450px;">
            <div id="content" style="text-align: center;"><b>No database selected.</b></div>
          </div>
        </div>
      </div>         
      <!-- end content -->
    </div>
  </body>   
</html>
