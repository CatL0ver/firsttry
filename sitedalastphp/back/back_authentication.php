<?php
session_start();
include ('connect.php'); // Подключаемся к базе данных

$email = $_POST["email"];
$password = $_POST["password"];
$hashedPassword = md5($password);

$sql = "SELECT * FROM users WHERE email='$email' AND password='$hashedPassword'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  $_SESSION['user_email'] = $email;
  header("Location: ../profile.php"); // Перенаправляем пользователя на панель управления или другую страницу после успешной авторизации
  exit();
} else {
  $_SESSION['login_message'] = "Неправильная электронная почта или пароль";
  header("Location: ../authorization.php"); // Перенаправляем обратно на страницу авторизации с сообщением об ошибке
  exit();
}
$conn->close();
?>