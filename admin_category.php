<?php

include('config.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}
;

if (isset($_POST['submit'])) {

   $cat_name = mysqli_real_escape_string($con, $_POST['cat_name']);

   $select_cat_name = mysqli_query($con, "SELECT book_cate_name from book_category where book_cate_name = '$cat_name'") or die('query failed');

   if (mysqli_num_rows($select_cat_name) > 0) {
      $message[] = 'Категория уже добавлена';
   } else {
      $add_cat_query = mysqli_query($con, "INSERT into book_category(book_cate_name) values('$cat_name')") or die('query failed');
      $message[] = 'Категория успешно добавлена';

   }
}
;

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($con, "DELETE from book_category where book_cate_id = '$delete_id'") or die('query failed');
   header('location:admin_category.php');
}

if (isset($_POST['update_category'])) {

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];

   mysqli_query($con, "UPDATE book_category SET book_cate_name = '$update_name' where book_cate_id='$update_p_id'") or die('query failed update');

   header('location:admin_category.php');

}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Управление категориями</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <div class="form-container">
      <!-- Форма добавления категории -->
      <form action="" method="post">
         <h3>Категории</h3>
         <input type="text" name="cat_name" placeholder="Название категории" required class="box">
         <input type="submit" name="submit" value="Добавить категорию" class="btn">
      </form>
   </div>

   <!-- Отображение категорий -->
   <section class="show-books">

      <div class="box-container">

         <?php
         $select_cat = mysqli_query($con, "SELECT * from book_category") or die('query failed');
         if (mysqli_num_rows($select_cat) > 0) {
            while ($fetch_cat = mysqli_fetch_assoc($select_cat)) {
               ?>
               <div class="box">
                  <div class="name"><?php echo $fetch_cat['book_cate_name']; ?></div>
                  <a href="admin_category.php?update=<?php echo $fetch_cat['book_cate_id']; ?>" class="option-btn">Обновить</a>
                  <a href="admin_category.php?delete=<?php echo $fetch_cat['book_cate_id']; ?>" class="delete-btn"
                     onclick="return confirm('Удалить эту категорию?');">Удалить</a>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">Категории еще не добавлены!</p>';
         }
         ?>
      </div>

   </section>

   <!-- Форма редактирования категории -->
   <section class="edit-books-form">

      <?php
      if (isset($_GET['update'])) {
         $update_id = $_GET['update'];
         $update_query = mysqli_query($con, "SELECT * from book_category where book_cate_id = '$update_id'") or die('query failed');
         if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
               ?>
               <form method="post" class="cate">
                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['book_cate_id']; ?>">
                  <input type="text" name="update_name" value="<?php echo $fetch_update['book_cate_name']; ?>" class="box" required
                     placeholder="Введите название категории">
                  <input type="submit" value="Обновить" name="update_category" class="btn">
                  <input type="button" value="Отмена" class="option-btn"  onclick="document.querySelector('.edit-books-form').style.display='none';">
               </form>
               <?php
            }
         }
      } else {
         echo '<script>document.querySelector(".edit-books-form").style.display = "none";</script>';
      }
      ?>

   </section>

   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>