<?php
session_start();
include ("blocks/header.php");
include ("back/connect.php");

if (!isset($_SESSION['user_email'])) {
  // Если пользователь не авторизован, выводим отладочное сообщение и завершаем выполнение скрипта
  echo "Пользователь не авторизован.";
  exit;
}

$sql_courses = "SELECT * FROM courses";
$result_courses = $conn->query($sql_courses);

// Создание массива $courses, содержащего информацию о курсах
$courses = array();
if ($result_courses->num_rows > 0) {
  while ($row = $result_courses->fetch_assoc()) {
    $courses[$row['id']] = $row;
  }
}

// Проверяем, существует ли сессионная переменная для корзины
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array(); // Если нет, создаем пустую корзину
}

// Обработчик удаления товара из корзины
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  if (isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]); // Удаляем товар из корзины по его ID
  }
  header("Location: cart.php"); // Перенаправляем пользователя на страницу корзины
  exit;
}

// Функция для подсчета общей суммы в корзине
function calculateTotal()
{
  $total = 0;
  foreach ($_SESSION['cart'] as $id => $quantity) {
    // В данном примере предполагается, что цена каждого товара хранится в массиве $_SESSION['cart']
    // Необходимо убедиться, что цены доступны из базы данных или другого источника данных
    // Здесь предполагается, что в $courses - массив с информацией о курсах, включая их цены
    global $courses;
    if (isset($courses[$id])) {
      $total += $courses[$id]['price'] * $quantity;
    }
  }
  return $total;
}
?>
<section class="vh-100 d-flex align-items-center">
  <div class="container">
    <h1>Корзина</h1>
    <?php if (!empty($_SESSION['cart'])): ?>
      <table class="table">
        <thead>
          <tr>
            <th>Фото и название</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
            <tr>
              <td>
                <img src="img/courses/<?php echo $courses[$id]['image']; ?>" alt="Product Image" width="200">
                <?php echo $courses[$id]['title']; ?>
              </td>
              <td>
                <?php echo $courses[$id]['price']; ?>₽
              </td>
              <td>
                <?php echo $quantity; ?>
              </td>
              <td>
                <?php echo $courses[$id]['price'] * $quantity; ?>₽
              </td>
              <td><a href="cart.php?action=remove&id=<?php echo $id; ?>">Удалить</a></td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="4"><strong>Итого:</strong></td>
            <td colspan="2">
              <?php echo calculateTotal(); ?>₽
            </td>
          </tr>
        </tbody>
      </table>
    <?php else: ?>
      <p>Ваша корзина пуста.</p>
    <?php endif; ?>
    <a href="courses.php" class="btn btn-primary">Продолжить покупки</a>
  </div>
</section>
<?php
include ("blocks/footer.php");
?>