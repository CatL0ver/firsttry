<?php
session_start();
include ("blocks/header.php");

?>

<section class="profile-section mt-5 vh-100 d-flex align-items-center bg-dark">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <h2 class="h3 text-center mb-4">Профиль пользователя</h2>
            <?php
            session_start();
            include ('back/connect.php'); // Подключаемся к базе данных
            
            // Проверяем, авторизован ли пользователь
            if (isset($_SESSION['user_email'])) {
              $email = $_SESSION['user_email'];
              $sql = "SELECT * FROM users WHERE email='$email'";
              $result = $conn->query($sql);

              if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                echo "<p><strong>Имя:</strong> " . $row['firstName'] . "</p>";
                echo "<p><strong>Фамилия:</strong> " . $row['lastName'] . "</p>";
                echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
              }
            } else {
              echo "<p>Вы не авторизованы.</p>";
            }
            ?>
            <div class="text-center mt-4">
              <a href="logout.php" class="btn btn-danger">Выйти</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include ("blocks/footer.php")
  ?>