<?php
session_start();
include ("blocks/header.php");
?>

<section class="bg-dark p-3 p-md-4 p-xl-5 d-flex align-items-center vh-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5 ">
        <div class="card border-0 shadow-sm rounded-4 ">
          <div class="card-body p-3 p-md-4 p-xl-5 ">
            <div class="row ">
              <div class="col-12">
                <div class="mb-5">
                  <h2 class="h3">Авторизация</h2>
                </div>
              </div>
            </div>
            <form action="back/back_authentication.php" method="post">
              <div class="row gy-3 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                    <label for="email" class="form-label">Email</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" value="" placeholder="Password"
                      required>
                    <label for="password" class="form-label">Пароль</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-2xl btn-primary" type="submit">Войти</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-12">
                <hr class="mt-5 mb-4 border-secondary-subtle">
                <p class="m-0 text-secondary text-center">Нет аккаунта?<a href="registration.php"
                    class="link-primary text-decoration-none">Зарегистрироваться</a></p>
              </div>
            </div>
            <?php
            session_start();
            if (isset($_SESSION['login_message'])) {
              echo '<div class="alert alert-danger mt-3">' . $_SESSION['login_message'] . '</div>';
              unset($_SESSION['login_message']);
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php
include ("blocks/footer.php");
?>