<?php
// $servername = "matzgroup17.ipagemysql.com";
// $username = "matzaccounts";
// $password = "matzaccounts@321";
// $dbname = "matzaccounts";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "matzaccounts";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 