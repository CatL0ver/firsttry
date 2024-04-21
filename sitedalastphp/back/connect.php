<?php
$conn = mysqli_connect("localhost", "root", "", "winterriders");
if ($conn->connect_error) {
  die("Connected failed" . $conn->connect_error);
}
?>