<?php
class db
{

    static private $conn = null;
    static public function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        // Create connection
        $conn = db::$conn;
        if (!$conn) {
            $conn = new mysqli($servername, $username, $password, "ban_hang");
        }
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");
        return $conn;
    }
}
