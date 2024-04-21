<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link
    href="https://fonts.googleapis.com/css?family=Rubik:300,regular,500,600,700,800,900,300italic,italic,500italic,600italic,700italic,800italic,900italic"
    rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/style.css">
  <title>Document</title>
</head>

<body>
  <header class="header">
    <nav class="navbar navbar-expand-lg header-menu bg-dark fixed-top border-bottom border-light">
      <div class="container">
        <img src="img/лого.svg" alt="">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
          aria-controls="navbarText" aria-expanded="false" aria-label="Переключатель навигации">
          <img src="img/burger.svg" alt="Menu Icon">
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarText">
          <ul class="navbar-nav align-items-center gap-4">
            <li class="nav-item">
              <a class="nav-link menu-link cstm-hvr" aria-current="page" href="index.php">ГЛАВНАЯ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link menu-link cstm-hvr" href="courses.php">КУРСЫ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link menu-link cstm-hvr" href="#">ПРОГРАММА КУРСА</a>
            </li>
            <?php if (isset($_SESSION['user_email'])): ?>
              <li class="nav-item">
                <a class="nav-link menu-link cstm-hvr" href="cart.php">КОРЗИНА</a>
              </li>
              <li class="nav-item">
                <a href="profile.php" class="btn btn-outline-light">Профиль</a>
              </li>
            <?php else: ?>
              <li class="nav-item">
                <a href="authorization.php" class="btn btn-outline-light">Войти</a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>