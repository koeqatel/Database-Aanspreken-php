<?php
session_start();

if (isset($_POST ["Username"]))
{
    if (isset($_POST ["Password"]))
    {
        $username = $_POST["Username"];
        $password = $_POST["Password"];


        $expire = time() + (60 * 60);

        $_SESSION["Username"] = $username;
        $_SESSION["Password"] = $password;
    }
}

$servername = "127.0.0.1";
$databasename = "classicmodels";
$connection = @new mysqli($servername, $_SESSION["Username"], $_SESSION["Password"], $databasename);
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="Stylesheet.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
        <title>DatabaseLogin</title>  

        <!--Javascript--><script type="text/javascript">
            window.onload = function ()
            {
                timedHide(document.getElementById('Flash'), 5);
            };

            function timedHide(element, seconds)
            {
                if (element) {
                    setTimeout(function () {
                        element.style.display = 'none';
                    }, seconds * 1000);
                }
            }
        </script>
    </head>
    <body>  
        <div class="container">
            <br /><br />

            <div class = "col-md-4" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Login
                    </div>
                    <div class = "panel-body">
                        <form method="post" action="index.php">
                            <div class="row">
                                <div class = "col-sm-3" > <label>Username:</label></div>
                                <div class = "col-sm-3" > <input type="text" name="Username"></div>
                            </div>
                            <div class="row">
                                <div class = "col-sm-3" > <label>Password:</label> </div>
                                <div class = "col-sm-3" > <input type="password" name="Password"></div>
                            </div>
                            <div class="row">
                                <div class = "col-sm-3" >
                                    <input type="submit" name="Submit" value="Submit">
                                </div>    
                            </div>
                        </form> 
                    </div>
                    <?php
                    if (isset($_POST ["Username"]))
                    {
                        if (isset($_POST ["Password"]))
                        {
                            if (mysqli_connect_errno($connection))
                            {
                                echo '<div id="Flash">
                                        Incorrect input
                                      </div>';
                            }
                            else
                            {
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=Main.php">';
                            }
                        }
                    }
                    ?>
                </div>
            </div>            
        </div>
    </body>
</html>