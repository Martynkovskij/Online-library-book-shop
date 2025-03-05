<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];
$user_name =$_SESSION['user_name'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($con, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($con, $_POST['email']);
   $method = mysqli_real_escape_string($con, $_POST['method']);
   $address = mysqli_real_escape_string($con, 'квартира № '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_books[] = '';

   $cart_query = mysqli_query($con, "SELECT * from shopping_cart where user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_books[] = $cart_item['book_name'].' ('.$cart_item['book_quantity'].') ';
         $sub_total = ($cart_item['book_price'] * $cart_item['book_quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_books = implode(', ',$cart_books);

   $order_query = mysqli_query($con, "SELECT * from orders where name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_books = '$total_books' AND total_price = '$cart_total'") or die('query failed display');

   if($cart_total == 0){
      $message[] = 'Ваша корзина пуста';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Заказ уже оформлен!'; 
      }else{
         mysqli_query($con, "INSERT INTO orders(user_id, name, number, email, method, address, total_books, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_books', '$cart_total', '$placed_on')") or die('query failed insert');
         $message[] = 'Заказ успешно оформлен!';
         mysqli_query($con, "DELETE from shopping_cart where user_id = '$user_id'") or die('query failed');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Оформление заказа</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Оформление заказа</h3>
   <p> <a href="home.php">Главная</a> / Оформление заказа </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($con, "SELECT * from shopping_cart where user_id = '$user_id'") or die('query failed display order');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['book_price'] * $fetch_cart['book_quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['book_name']; ?> <span>(<?php echo number_format($fetch_cart['book_price'], 0).' ₽'.' x '. $fetch_cart['book_quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">Ваша корзина пуста</p>';
   }
   ?>
   <div class="grand-total"> Общая сумма: <span><?php echo number_format($grand_total, 0); ?> ₽</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Оформить заказ</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Ваше имя:</span>
            <input type="text" name="name" required placeholder="Введите ваше имя">
         </div>

         <div class="inputBox">
            <span>Ваш номер:</span>
            <input type="number" name="number" required placeholder="Введите ваш номер">
         </div>

         <div class="inputBox">
            <span>Ваш email:</span>
            <input type="email" name="email" required placeholder="Введите ваш email">
         </div>

         <div class="inputBox">
            <span>Способ оплаты:</span>
            <select name="method">
               <option value="наложенный платеж">наложенный платеж</option>
               <option value="кредитная карта">кредитная карта</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>

         <div class="inputBox">
            <span>Адрес:</span>
            <input type="number" min="0" name="flat" required placeholder="например, квартира">
         </div>

         <div class="inputBox">
            <span>Улица:</span>
            <input type="text" name="street" required placeholder="например, название улицы">
         </div>

         <div class="inputBox">
            <span>Город:</span>
            <input type="text" name="city" required placeholder="например, Гродно">
         </div>
         
         <div class="inputBox">
            <span>Область:</span>
            <input type="text" name="state" required placeholder="например, Гродненская область">
         </div>

         <div class="inputBox">
            <span>Страна:</span>
            <input type="text" name="country" required placeholder="например, Беларусь">
         </div>

         <div class="inputBox">
            <span>Почтовый индекс:</span>
            <input type="number" min="0" name="pin_code" required placeholder="например, 288721">
         </div>
      </div>
      <input type="submit" value="Оформить заказ" class="btn" name="order_btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link -->
<script src="js/script.js"></script>

</body>
</html>
