<?php

include('config.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}
;

if (isset($_POST['submit'])) {

   $author_name = mysqli_real_escape_string($con, $_POST['author_name']);

   $select_author_name = mysqli_query($con, "SELECT book_author_name from book_authors where book_author_name = '$author_name'") or die('query failed select');

   if (mysqli_num_rows($select_author_name) > 0) {
      $message[] = 'Автор уже добавлен';
   } else {
      $add_author_query = mysqli_query($con, "INSERT into book_authors(book_author_name) values('$author_name')") or die('query failed insert');
      $message[] = 'Автор успешно добавлен';
   }
}
;

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($con, "DELETE from book_authors where author_id = '$delete_id'") or die('query failed');
   header('location:admin_author.php');
}

if (isset($_POST['update_category'])) {

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];

   mysqli_query($con, "UPDATE book_authors SET book_author_name = '$update_name' where author_id='$update_p_id'") or die('query failed update');

   header('location:admin_author.php');

}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Управление авторами</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <div class="form-container">
      <!-- add Author form -->
      <form action="" method="post">
         <h3>Авторы</h3>
         <input type="text" name="author_name" placeholder="Имя автора" required class="box">
         <input type="submit" name="submit" value="Добавить автора" class="btn">
      </form>
   </div>

   <!-- show Author -->
   <section class="show-books">
      <div class="box-container">
         <?php
         $select_author = mysqli_query($con, "SELECT * from book_authors") or die('query failed');
         if (mysqli_num_rows($select_author) > 0) {
            while ($fetch_author = mysqli_fetch_assoc($select_author)) {
               ?>
               <div class="box">
                  <div class="name"><?php echo $fetch_author['book_author_name']; ?></div>
                  <a href="admin_author.php?update=<?php echo $fetch_author['author_id']; ?>" class="option-btn">Обновить</a>
                  <a href="admin_author.php?delete=<?php echo $fetch_author['author_id']; ?>" class="delete-btn"
                     onclick="return confirm('Удалить этого автора?');">Удалить</a>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">Авторы еще не добавлены!</p>';
         }
         ?>
      </div>
   </section>

   <section class="edit-books-form">
      <?php
      if (isset($_GET['update'])) {
         $update_id = $_GET['update'];
         $update_query = mysqli_query($con, "SELECT * from book_authors where author_id = '$update_id'") or die('query failed');
         if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
               ?>
               <form method="post" class="cate">
                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['author_id']; ?>">
                  <input type="text" name="update_name" value="<?php echo $fetch_update['book_author_name']; ?>" class="box" required
                     placeholder="Введите имя автора">
                  <input type="submit" value="Обновить" name="update_category" class="btn">
                  <input type="reset" value="Отмена" class="option-btn" onclick="document.querySelector('.edit-books-form').style.display='none';">
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