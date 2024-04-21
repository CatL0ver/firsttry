<?php
session_start();
include ("blocks/header.php")
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
                                    <h2 class="h3">Регистрация</h2>
                                </div>
                            </div>
                        </div>
                        <form action="back/back_registration.php" method="post">
                            <div class="row gy-3 overflow-hidden">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="firstName"
                                            placeholder="First Name" required>
                                        <label for="firstName" class="form-label">Имя</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="lastName" placeholder="First Name"
                                            required>
                                        <label for="lastName" class="form-label">Фамилия</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="name@example.com" required>
                                        <label for="email" class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" value=""
                                            placeholder="Password" required>
                                        <label for="password" class="form-label">Пароль</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="repeatpassword" value=""
                                            placeholder="Password" required>
                                        <label for="repeatpassword" class="form-label">Повторите пароль</label>
                                    </div>
                                </div>
                                <?php
                                if (isset($_SESSION['registration_message'])) {
                                    echo $_SESSION['registration_message'];
                                    unset($_SESSION['registration_message']);
                                }
                                ?>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="iAgree"
                                            id="iAgree" required>
                                        <label class="form-check-label text-secondary" for="iAgree">
                                            Я принимаю условия
                                            <a href="#!" class=" text-decoration-none">пользовательского
                                                соглашения</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-2xl btn-primary"
                                            type="submit">зарегистрироваться</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <hr class="mt-5 mb-4 border-secondary-subtle">
                                <p class="m-0 text-secondary text-center">Уже есть аккаунт?<a href="authorization.php"
                                        class="link-primary text-decoration-none">Войти</a></p>
                            </div>
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