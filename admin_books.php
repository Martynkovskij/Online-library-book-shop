<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_book'])){

   $name = mysqli_real_escape_string($con, $_POST['name']);
   $price = $_POST['price'];
   $cat = $_POST['category'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $info = $_POST['book_info'];
   $author = $_POST['author'];

   $select_book_name = mysqli_query($con, "SELECT book_name from books where book_name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_book_name) > 0){
      $message[] = 'Название книги уже добавлено';
   }else{
      $add_book_query = mysqli_query($con, "INSERT into books (book_name, book_category, book_author, book_price, book_image, book_info) values('$name', '$cat', '$author', '$price' ,'$image', '$info')") or die('query failed insert');

      if($add_book_query){
         if($image_size > 2000000){
            $message[] = 'Размер изображения слишком большой';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Книга успешно добавлена!';
         }
      }else{
         $message[] = 'Не удалось добавить книгу!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($con, "SELECT book_image from books where book_id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($con, "DELETE from books where book_id = '$delete_id'") or die('query failed');
   header('location:admin_books.php');
}

if(isset($_POST['update_book'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];
   $update_cat = $_POST['update_category'];
   $update_info = $_POST['update_info'];
   $update_author = $_POST['update_author'];

   mysqli_query($con, "UPDATE books SET book_name = '$update_name', book_price = '$update_price', book_category = '$update_cat', book_author = '$update_author'  , book_info = '$update_info' where book_id = '$update_p_id'") or die('query failed update');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'Размер файла изображения слишком большой';
      }else{
         mysqli_query($con, "UPDATE books SET book_image = '$update_image' where book_id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }
   $message[] = 'Книга успешно обновлена';

   header('location:admin_books.php');

}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Управление книгами</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- Раздел управления книгами -->

<section class="add-books">

   <form action="" method="post" enctype="multipart/form-data">
      <h2>Добавить книгу</h2>
      <input type="text" name="name" class="box" placeholder="Введите название книги" required>
      <input type="number" min="0" name="price" class="box" placeholder="Введите цену книги" required>
      <select name="category" class="cat">
         <option value="">Выберите категорию книги</option>
         <?php
                include('config.php');
                $select_cat = mysqli_query($con,"SELECT * from book_category") or die('query failed');
                
                if(mysqli_num_rows($select_cat) > 0){
                   while ($fetch_cat = mysqli_fetch_assoc($select_cat)){
                      ?>
            <option><?php echo $fetch_cat['book_cate_name']; ?></option>
            <?php }
                }?>
        </select>
        <select name="author" class="aut">
         <option value="">Выберите автора</option>
         <?php
                include('config.php');
                $select_author = mysqli_query($con,"SELECT * from book_authors") or die('query failed');
                
                if(mysqli_num_rows($select_author) > 0){
                   while ($fetch_author = mysqli_fetch_assoc($select_author)){
                      ?>
            <option><?php echo $fetch_author['book_author_name']; ?></option>
            <?php }
                }?>
        </select>

        <textarea name="book_info" class="box" cols="30" rows="4" placeholder="Введите информацию о книге" maxlength="10000" required></textarea>
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="Добавить книгу" name="add_book" class="btn">
   </form>

</section>

<!-- Раздел отображения книг -->

<section class="show-books">

   <div class="box-container">

      <?php
         $select_books = mysqli_query($con, "SELECT * from books") or die('query failed');
         if(mysqli_num_rows($select_books) > 0){
            while($fetch_books = mysqli_fetch_assoc($select_books)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_books['book_image']; ?>" alt="">
         <div class="name"><?php echo $fetch_books['book_name']; ?></div>
         <?php
            $final_price = $fetch_books['book_price'];
            if($fetch_books['discount'] > 0) {
               $final_price = $fetch_books['book_price'] - ($fetch_books['book_price'] * ($fetch_books['discount'] / 100));
         ?>
            <div class="price"><span class="original-price"><?php echo number_format($fetch_books['book_price'], 0); ?> ₽</span> <?php echo number_format($final_price, 0); ?> ₽</div>
         <?php } else { ?>
            <div class="price"><?php echo number_format($fetch_books['book_price'], 0); ?> ₽</div>
         <?php } ?>
         <a href="admin_books.php?update=<?php echo $fetch_books['book_id']; ?>" class="option-btn">Обновить</a>
         <a href="admin_books.php?delete=<?php echo $fetch_books['book_id']; ?>" class="delete-btn" onclick="return confirm('Удалить эту книгу?');">Удалить</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">Книги еще не добавлены!</p>';
      }
      ?>
   </div>

</section>

<!-- Форма редактирования книги -->

<section class="edit-books-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($con, "SELECT * from books where book_id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['book_id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['book_image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['book_image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['book_name']; ?>" class="box" required placeholder="Введите название книги">
      <input type="number" name="update_price" value="<?php echo $fetch_update['book_price']; ?>" min="0" class="box" required placeholder="Введите цену книги">
      <select name="update_category" class="cat">
         <option><?php echo $fetch_update['book_category']; ?></option>
         <?php
                include('config.php');
                $select_cat = mysqli_query($con,"SELECT * from book_category") or die('query failed');
                
                if(mysqli_num_rows($select_cat) > 0){
                   while ($fetch_cat = mysqli_fetch_assoc($select_cat)){
                      ?>
            <option><?php echo $fetch_cat['book_cate_name']; ?></option>
            <?php }
                }?>
        </select>
        <select name="update_author" class="aut">
         <option><?php echo $fetch_update['book_author']; ?></option>
         <?php
                include('config.php');
                $select_author = mysqli_query($con,"SELECT * from book_authors") or die('query failed');
                
                if(mysqli_num_rows($select_author) > 0){
                   while ($fetch_author = mysqli_fetch_assoc($select_author)){
                      ?>
            <option><?php echo $fetch_author['book_author_name']; ?></option>
            <?php }
                }?>
        </select>

        <textarea name="update_info" class="box" cols="30" rows="4" placeholder="Введите информацию о книге" required><?php echo $fetch_update['book_info']; ?></textarea>
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="Обновить" name="update_book" class="btn">
      <input type="reset" value="Отмена" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-books-form").style.display = "none";</script>';
      }
   ?>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>