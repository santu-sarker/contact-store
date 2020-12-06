<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "contact_store";

function connect()
{
    $connection = mysqli_connect("localhost", "root", "", "contact_store");
    return $connection;
}
