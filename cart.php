<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($con, "UPDATE shopping_cart SET book_quantity = '$cart_quantity' where cart_id = '$cart_id'") or die('Ошибка запроса');
   $message[] = 'Количество в корзине обновлено!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($con, "DELETE from shopping_cart where cart_id = '$delete_id'") or die('Ошибка запроса');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($con, "DELETE from shopping_cart where user_id = '$user_id'") or die('Ошибка запроса');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Корзина</title>

   <!-- ссылка на Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- подключение кастомного CSS -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Корзина покупок</h3>
   <p> <a href="home.php">Главная</a> / Корзина </p>
</div>

<section class="shopping-cart">

   <h1 class="title">Добавленные книги</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($con, "SELECT * from shopping_cart where user_id = '$user_id'") or die('Ошибка запроса');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
      <div class="box">
         <a href="cart.php?delete=<?php echo $fetch_cart['cart_id']; ?>" class="fas fa-times" onclick="return confirm('Удалить этот товар из корзины?');"></a>
         <img src="uploaded_img/<?php echo $fetch_cart['book_image']; ?>" alt="">
         <div class="name"><?php echo $fetch_cart['book_name']; ?></div>
         <div class="price"><?php echo number_format($fetch_cart['book_price'], 0); ?> ₽</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['cart_id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['book_quantity']; ?>">
            <input type="submit" name="update_cart" value="Обновить" class="option-btn">
         </form>
         <div class="sub-total">Итого: <span><?php echo number_format(($fetch_cart['book_quantity'] * $fetch_cart['book_price']), 0); ?> ₽</span></div>
      </div>
      <?php
      $grand_total += ($fetch_cart['book_quantity'] * $fetch_cart['book_price']);
         }
      }else{
         echo '<p class="empty">Ваша корзина пуста</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Удалить все товары из корзины?');">Удалить все</a>
   </div>

   <div class="cart-total">
      <p>Общая сумма: <span><?php echo number_format($grand_total, 0); ?> ₽</span></p>
      <div class="flex">
         <a href="shop.php" class="option-btn">Продолжить покупки</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Перейти к оформлению</a>
      </div>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- подключение кастомного JS -->
<script src="js/script.js"></script>

</body>
</html>
