<?php

include 'config.php';

if(isset($_POST['add_to_cart'])){

   $book_name = $_POST['book_name'];
   $book_price = $_POST['book_price'];
   $book_image = $_POST['book_image'];
   $book_quantity = $_POST['book_quantity'];

   $check_cart_numbers = mysqli_query($con, "SELECT * from shopping_cart where book_name = '$book_name' AND user_id = '$user_id'") or die('Ошибка запроса');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Уже добавлено в корзину!';
   }else{
      mysqli_query($con, "INSERT INTO shopping_cart(user_id, book_name, book_price, book_quantity, book_image) VALUES('$user_id', '$book_name', '$book_price', '$book_quantity', '$book_image')") or die('Ошибка запроса');
      $message[] = 'Продукт добавлен в корзину!';
   }

};

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>страница поиска</title>

   <!-- ссылка на font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- ссылка на кастомный css файл -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>страница поиска</h3>
   <p> <a href="home.php">главная</a> / поиск </p>
</div>

<section class="search-form">
   <form action="" method="post" class="sbox">
      <input type="text" name="search" placeholder="поиск товаров..." class="write">
      <input type="submit" name="submit" value="поиск" class="btn">
   </form>
</section>

<section class="products" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_books = mysqli_query($con, "SELECT * from `books` where book_name LIKE '%{$search_item}%'") or die('Ошибка запроса');
         if(mysqli_num_rows($select_books) > 0){
         while($fetch_books = mysqli_fetch_assoc($select_books)){
   ?>
   <form action="" method="post" class="box">
      <img src="uploaded_img/<?php echo $fetch_books['book_image']; ?>" alt="" class="image">
      <div class="name"><?php echo $fetch_books['book_name']; ?></div>
      <div class="price">$<?php echo $fetch_books['book_price']; ?> </div>
      <input type="number"  class="qty" name="product_quantity" min="1" value="1">
      <input type="hidden" name="books_name" value="<?php echo $fetch_books['book_name']; ?>">
      <input type="hidden" name="books_price" value="<?php echo $fetch_books['book_price']; ?>">
      <input type="hidden" name="books_image" value="<?php echo $fetch_books['book_image']; ?>">
      <input type="submit" class="btn" value="добавить в корзину" name="add_to_cart">
   </form>
   <?php
            }
         }else{
            echo '<p class="empty">ничего не найдено!</p>';
         }
       };
   ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- ссылка на кастомный js файл -->
<script src="js/script.js"></script>

</body>
</html>
