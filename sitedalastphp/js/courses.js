$(document).ready(function () {
  $('.addToCart').click(function () {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var price = $(this).data('price');
    $.ajax({
      url: '../courses.php',
      type: 'post',
      data: {
        action: 'addToCart',
        id: id,
        name: name,
        price: price
      },
      success: function () {
        alert('Товар успешно добавлен в корзину');
      }
    });
  });
});