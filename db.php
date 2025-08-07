<?php
$con = new mysqli("localhost", "root", "", "velox"); // Replace with your DB
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>