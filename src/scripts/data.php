<?php

  namespace App\scripts;
  use Mysqli;


class SQLHandle
{
    public static function databaseConnect()
    {
        $servername = "localhost";
        $username = "admin";
        $password = "password";
        $dbname = "pudli";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");
        return $conn;
    }
}
?>
