<?php

include 'config.php';
session_start();

// $user_id = $_SESSION['user_id'];
// $user_name = $_SESSION['user_name'];

// if(!isset($user_id)){
//    header('location:login.php');
// };

if(isset($_POST['add_to_cart'])){
   $user_id = $_SESSION['user_id'];

   if(!($user_id)){
      header('location:login.php');
   }

   $book_name = $_POST['books_name'];
   $book_price = $_POST['books_price'];
   $book_image = $_POST['books_image'];
   $book_quantity = $_POST['books_quantity'];

   $check_cart_numbers = mysqli_query($con, "SELECT * from shopping_cart where book_name = '$book_name' AND user_id = '$user_id'") or die('Запрос не удался');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Книга уже добавлена в корзину!';
   }else{
      mysqli_query($con, "INSERT INTO shopping_cart(user_id,book_name,book_price,book_quantity,book_image) VALUES('$user_id', '$book_name', '$book_price', '$book_quantity', '$book_image')") or die('Запрос не удался');
      $message[] = 'Книга добавлена в корзину!';
   }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Магазин</title>

   <!-- ссылка на Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- подключение кастомного CSS -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>наш магазин</h3>
   <p> <a href="home.php">главная</a> / магазин </p>
</div>

<section class="search-form">
   <form action="" method="post" class="sbox">
      <input type="text" name="search" placeholder="поиск товаров..." class="write">
      <input type="submit" name="submit" value="поиск" class="btn">
   </form>
</section>

<section class="books" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_books = mysqli_query($con, "SELECT * from `books` where book_name LIKE '%{$search_item}%'") or die('Запрос не удался');
         if(mysqli_num_rows($select_books) > 0){
         while($fetch_books = mysqli_fetch_assoc($select_books)){
   ?>
   <form action="" method="post" class="box">
      <a href="book_details.php?book_id=<?php echo $fetch_books['book_id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?php echo $fetch_books['book_image']; ?>" alt="" class="image">
      <div class="name"><?php echo $fetch_books['book_name']; ?></div>
      <?php
         $final_price = $fetch_books['book_price'];
         if($fetch_books['discount'] > 0) {
            $final_price = $fetch_books['book_price'] - ($fetch_books['book_price'] * ($fetch_books['discount'] / 100));
      ?>
         <div class="price"><span class="original-price"><?php echo $fetch_books['book_price']; ?> ₽</span> <?php echo number_format($final_price, 0); ?> ₽</div>
      <?php } else { ?>
         <div class="price"><?php echo number_format($final_price, 0); ?> ₽</div>
      <?php } ?>
      <input type="number" class="qty" name="books_quantity" min="1" value="1">
      <input type="hidden" name="books_name" value="<?php echo $fetch_books['book_name']; ?>">
      <input type="hidden" name="books_price" value="<?php echo $final_price; ?>">
      <input type="hidden" name="books_image" value="<?php echo $fetch_books['book_image']; ?>">
      <input type="submit" class="btn" value="добавить в корзину" name="add_to_cart">
   </form>
   <?php
            }
         }else{
            echo '<p class="empty">ничего не найдено!</p>';
         }
      }
   ?>
   </div>
   
<section class="main-box-cat-aut">

   <form action="" method="post" class="cate-container">
      <select name="categoryName" class="cate-name">
      <option value="" selected disabled> Выберите категорию</option>
         <?php
            $select_cat = mysqli_query($con, "SELECT * FROM book_category") or die('Запрос не удался');
            
            if (mysqli_num_rows($select_cat) > 0) {
               while ($fetch_cat = mysqli_fetch_assoc($select_cat)) {
                  $cat_name = $fetch_cat['book_cate_name'];
                  echo '<option value="' . $cat_name . '">' . $cat_name . '</option>';
               }
            }
            ?>
        </select>
        <button type="submit" name="category" class="btn">Подтвердить</button>
      </form>
   </section>

   <section class="show-books">
      <div class="box-container">
         <?php
               include('config.php');

               if (isset($_POST['categoryName'])) {  
   $category = $_POST['categoryName'];
   $category = mysqli_real_escape_string($con, $category);

   $select_books = mysqli_query($con, "SELECT * FROM books WHERE book_category = '$category'");
   
   if (mysqli_num_rows($select_books) > 0) {
      while ($fetch_books = mysqli_fetch_assoc($select_books)) {
         ?>
            <div class="box">
               <a href="book_details.php?book_id=<?php echo $fetch_books['book_id']; ?>" class="fas fa-eye"></a>
               <img src="uploaded_img/<?php echo ($fetch_books['book_image']); ?>" alt="" class="img">
               <div class="name"><?php echo ($fetch_books['book_name']); ?></div>
               <?php
                  $final_price = $fetch_books['book_price'];
                  if($fetch_books['discount'] > 0) {
                     $final_price = $fetch_books['book_price'] - ($fetch_books['book_price'] * ($fetch_books['discount'] / 100));
                  ?>
                     <div class="price"><span class="original-price"><?php echo $fetch_books['book_price']; ?> ₽</span> <?php echo number_format($final_price, 0); ?> ₽</div>
                  <?php } else { ?>
                     <div class="price"><?php echo number_format($final_price, 0); ?> ₽</div>
                  <?php } ?>
               <input type="number" class="qty" name="books_quantity" min="1" value="1">
               <input type="hidden" name="books_name" value="<?php echo $fetch_books['book_name']; ?>">
               <input type="hidden" name="books_price" value="<?php echo $final_price; ?>">
               <input type="hidden" name="books_image" value="<?php echo $fetch_books['book_image']; ?>">
               <input type="submit" value="добавить в корзину" name="add_to_cart" class="btn">
            </div>
            <?php
        }
      } else {
        echo '<p class="empty">Нет книг в этой категории</p>';
      }
   }
   ?>
         </div>
      </section>
      
      <section class="main-box-cat-aut">
         <form action="" method="post" class="aut-container">
            <select name="authorName" class="aut-name">
            <option value="" selected disabled> Выберите автора</option>
               <?php
            $select_author = mysqli_query($con, "SELECT * FROM book_authors") or die('Запрос не удался');
            
            if (mysqli_num_rows($select_author) > 0) {
               while ($fetch_author = mysqli_fetch_assoc($select_author)) {
                  $author_name = $fetch_author['book_author_name'];
                  echo '<option value="' . $author_name . '">' . $author_name . '</option>';
               }
            }
            ?>
        </select>
        <button type="submit" name="category" class="btn">Подтвердить</button>
      </form>
      </section>

<section class="show-books">
   <div class="box-container">

      <?php
include('config.php');

if (isset($_POST['authorName'])) {  
   $author = $_POST['authorName'];
   $author = mysqli_real_escape_string($con, $author);
   
   $select_books = mysqli_query($con, "SELECT * FROM books WHERE book_author = '$author'");
   
   if (mysqli_num_rows($select_books) > 0) {
      while ($fetch_books = mysqli_fetch_assoc($select_books)) {
         ?>
            <div class="box">
               <a href="book_details.php?book_id=<?php echo $fetch_books['book_id']; ?>" class="fas fa-eye"></a>
               <img src="uploaded_img/<?php echo ($fetch_books['book_image']); ?>" alt="" class="img">
               <div class="name"><?php echo ($fetch_books['book_name']); ?></div>
               <?php
                  $final_price = $fetch_books['book_price'];
                  if($fetch_books['discount'] > 0) {
                     $final_price = $fetch_books['book_price'] - ($fetch_books['book_price'] * ($fetch_books['discount'] / 100));
                  ?>
                     <div class="price"><span class="original-price"><?php echo $fetch_books['book_price']; ?> ₽</span> <?php echo number_format($final_price, 0); ?> ₽</div>
                  <?php } else { ?>
                     <div class="price"><?php echo number_format($final_price, 0); ?> ₽</div>
                  <?php } ?>
               <input type="number" class="qty" name="books_quantity" min="1" value="1">
               <input type="hidden" name="books_name" value="<?php echo $fetch_books['book_name']; ?>">
               <input type="hidden" name="books_price" value="<?php echo $final_price; ?>">
               <input type="hidden" name="books_image" value="<?php echo $fetch_books['book_image']; ?>">
               <input type="submit" value="добавить в корзину" name="add_to_cart" class="btn">
            </div>
            
            <?php
        }
    } else {
       echo '<p class="empty">Нет книг от этого автора</p>';
      }
}
?>
</div>
</section>

<section class="show-books">
   
   <h1 class="title">новые книги</h1>

   <div class="box-container">
      
      <?php  
         $select_books = mysqli_query($con, "SELECT * from books") or die('Запрос не удался');
         if(mysqli_num_rows($select_books) > 0){
            while($fetch_books = mysqli_fetch_assoc($select_books)){
      ?>
     <form action="" method="post" class="box">
      <a href="book_details.php?book_id=<?php echo $fetch_books['book_id']; ?>" class="fas fa-eye"></a>
      <img class="image" src="uploaded_img/<?php echo $fetch_books['book_image']; ?>" alt="">
      <div class="name"><?php echo $fetch_books['book_name']; ?></div>
      <?php
         $final_price = $fetch_books['book_price'];
         if($fetch_books['discount'] > 0) {
            $final_price = $fetch_books['book_price'] - ($fetch_books['book_price'] * ($fetch_books['discount'] / 100));
         ?>
            <div class="price"><span class="original-price"><?php echo $fetch_books['book_price']; ?> ₽</span> <?php echo number_format($final_price, 0); ?> ₽</div>
         <?php } else { ?>
            <div class="price"><?php echo number_format($final_price, 0); ?> ₽</div>
         <?php } ?>
      <input type="number" min="1" name="books_quantity" value="1" class="qty">
      <input type="hidden" name="books_name" value="<?php echo $fetch_books['book_name']; ?>">
      <input type="hidden" name="books_price" value="<?php echo $final_price; ?>">
      <input type="hidden" name="books_image" value="<?php echo $fetch_books['book_image']; ?>">
      <input type="submit" value="добавить в корзину" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">Нет книг в наличии!</p>';
      }
      ?>
   </div>

</section>

<?php include 'footer.php'; ?>


<!-- подключение кастомного JS -->
<script src="js/script.js"></script>

</body>
</html>
