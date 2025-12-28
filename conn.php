<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "explore";

$conn = mysqli_connect("$server", "$username", "$password", "$database");
if ($conn) {
    // echo "database connected". mysqli_error($conn);
} else {
    // echo "database not connected". mysqli_error($conn);
}




?>