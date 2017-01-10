<?php

if (isset($_SESSION["Username"]))
{
    if (isset($_SESSION["Password"]))
    {
        $username = $_POST["Username"];
        $password = $_POST["Password"];


        $expire = time() + (60 * 60);

        $_SESSION["Username"] = $username;
        $_SESSION["Password"] = $password;
    }
}

$servername = "localhost";
$databasename = "classicmodels";
$connection = @new mysqli($servername, $_SESSION["Username"], $_SESSION["Password"], $databasename);
?>