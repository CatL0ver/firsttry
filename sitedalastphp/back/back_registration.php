<?php
session_start();
include ('connect.php');

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$password = $_POST["password"];
$repeatpassword = $_POST["repeatpassword"];
$hashedpassword = md5($password);

if ($password !== $repeatpassword) {
  $_SESSION['registration_message'] = "<div class='alert alert-danger mt-3'>Пароли не совпадают</div>";
  header("Location: ../registration.php");
  exit();
}

$check_email_sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($check_email_sql);
if ($result->num_rows > 0) {
  $_SESSION['registration_message'] = "<div class='alert alert-danger mt-3'>Пользователь с таким email уже существует.</div>";
  header("Location: ../registration.php");
  exit();
}

$sql = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName','$lastName','$email','$hashedpassword')";
if ($conn->query($sql) === TRUE) {
  $_SESSION['registration_message'] = "<div class='alert alert-success mt-3'>Успешная регистрация</div>";
  header("Location: ../registration.php");
  exit();
} else {
  $_SESSION['registration_message'] = "<div class='alert alert-danger mt-3'>Ошибка: " . $conn->error . "</div>";
  header("Location: ../registration.php");
  exit();
}

$conn->close();
?>