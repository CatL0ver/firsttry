<?php
include ("blocks/header.php");
include ("back/connect.php");


if (isset($_POST['action']) && $_POST['action'] == 'addToCart') {
  $id = intval($_POST['id']);
  $quantity = 1;
  if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] += $quantity;
  } else {
    $_SESSION['cart'][$id] = $quantity;
  }
  exit;
}
?>
?>



<section class="courses bg-dark">
  <div class="container-fluid ">
    <div class="row gap-5 justify-content-center">
      <h1 class="text-center text-light mt-5">Горнолыжная школа</h1>
      <?php
      $sql = "SELECT * FROM courses WHERE id IN (1, 2, 3)";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          ?>
          <div class="card col-xl-3 col-lg-8 col-md-9 col-sm-8 bg-image">
            <img class="card-img-top pt-2" src="img/courses/<?php echo $row['image']; ?>" alt="Card image cap"
              data-image="img/courses/<?php echo $row['image']; ?>">
            <div class="card-body">
              <h5 class="card-title fs-4">
                <?php echo $row['title']; ?>
              </h5>
              <p class="card-text ">
                <?php echo nl2br($row['description']); ?>
              </p>
              <p>–
                <?php echo nl2br($row['details']); ?>
              </p>
            </div>
            <div class="d-flex gap-3 align-items-center mb-3">
              <a href="#" class="btn btn-outline-primary addToCart" data-id="<?php echo $row['id']; ?>"
                data-name="<?php echo $row['title']; ?>" data-price="<?php echo $row['price']; ?>">Выбрать</a>
              <a href="#" class="nav-link "><strong>
                  от
                  <?php echo $row['price']; ?>₽
                </strong></a>
            </div>
          </div>
          <?php
        }
      } else {
        echo "0 results";
      }
      ?>
    </div>


    <div class="row gap-5 justify-content-center">
      <h1 class="text-center text-light mt-5">Прокат снаряжения</h1>
      <?php
      $sql = "SELECT * FROM 
      rental WHERE id IN (1, 2, 3)";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          ?>
          <div class="card col-xl-3 col-lg-8 col-md-9 col-sm-8 bg-image">
            <img class="card-img-top pt-2" src="img/courses/<?php echo $row['image']; ?>" alt="Card image cap"
              data-image="img/courses/<?php echo $row['image']; ?>">
            <div class="card-body">
              <h5 class="card-title">
                <?php echo $row['title']; ?>
              </h5>
              <p class="card-text">
                <?php echo nl2br($row['description']); ?>
              </p>
              <p>–
                <?php echo nl2br($row['details']); ?>
              </p>
            </div>
            <div class="d-flex gap-3 align-items-center mb-3">
              <a href="#" class="btn btn-outline-primary addToCart" data-id="<?php echo $row['id']; ?>"
                data-name="<?php echo $row['title']; ?>" data-price="<?php echo $row['price']; ?>">Выбрать</a>
              <a href="#" class="nav-link "><strong>
                  <?php echo $row['price']; ?>₽
                </strong></a>
            </div>
          </div>
          <?php
        }
      } else {
        echo "0 results";
      }
      $conn->close();
      ?>
    </div>
  </div>
</section>

<section class="about_courses">
      <div class="container">
      <div class="row border rounded">
          <div class="col-12 d-flex align-items-center p-0 about-card">
            <div class="about-img">
              <img src="img/courses/b1.jpeg" alt="" class="img" >
            </div>
            <div class="ms-5">
              <h4>Ставим технику катания</h4>
              <p>Мы знаем, как сделать так, чтобы вы перестали уставать на склоне, а траектория спуска стала идеальной. Наш инструктор поставит технику и поможет быстро и безопасно освоить или исправить навыки катания — прогресс точно не заставит себя долго ждать!
            </p>
            </div>
          </div>
        </div>
      <div class="row border rounded mt-5">
          <div class="col-12 d-flex align-items-center p-0 about-card">
            <div class="about-img">
              <img src="img/courses/b2.jpeg" alt=""  >
              </div>
            <div class="ms-5">
              <h4>Ставим технику катания</h4>
              <p>Мы знаем, как сделать так, чтобы вы перестали уставать на склоне, а траектория спуска стала идеальной. Наш инструктор поставит технику и поможет быстро и безопасно освоить или исправить навыки катания — прогресс точно не заставит себя долго ждать!
            </p>
            </div>
          </div>
        </div>
      <div class="row border rounded mt-5">
          <div class="col-12 d-flex align-items-center p-0 about-card">
            <div class="about-img">
              <img src="img/courses/b3.jpeg" alt="" class="img" >
            </div>
            <div class="ms-5">
              <h4>Ставим технику катания</h4>
              <p>Мы знаем, как сделать так, чтобы вы перестали уставать на склоне, а траектория спуска стала идеальной. Наш инструктор поставит технику и поможет быстро и безопасно освоить или исправить навыки катания — прогресс точно не заставит себя долго ждать!
            </p>
            </div>
          </div>
        </div>
      </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/courses.js"></script>
</body>
</html>



<?php
include ("blocks/footer.php");
?>