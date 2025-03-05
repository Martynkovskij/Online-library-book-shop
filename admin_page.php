<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>панель администратора</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">панель управления</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($con, "SELECT total_price from orders WHERE payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <div class="icon">
         <img class="card-img-top" src="img/book-shelf-fill.png" alt="Card image cap" />
         </div>
         <h3><?php echo number_format($total_pendings, 0); ?> ₽</h3>
         <p>ожидающие оплаты</p>
         <a href="admin_orders.php" class="option-btn">Подробнее</a>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($con, "SELECT total_price from orders WHERE payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <div class="icon">
            <img src="img/wallet-3-fill.png" alt="">
         </div>
         <h3><?php echo number_format($total_completed, 0); ?> ₽</h3>
         <p>завершённые платежи</p>
         <a href="admin_orders.php" class="option-btn">Подробнее</a>
      </div>

      <div class="box">
         <?php 
            $select_orders = mysqli_query($con, "SELECT * from orders") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <div class="icon">
            <img src="img/book-read-fill.png" alt="">
         </div>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>заказов размещено</p>
         <a href="admin_orders.php" class="option-btn">Подробнее</a>
      </div>

      <div class="box">
         <?php 
            $select_books = mysqli_query($con, "SELECT * from books") or die('query failed');
            $number_of_books = mysqli_num_rows($select_books);
         ?>
         <div class="icon">
            <img src="img/book-3-line.png" alt="">
         </div>
         <h3><?php echo $number_of_books; ?></h3>
         <p>книг добавлено</p>
         <a href="admin_books.php" class="option-btn">Подробнее</a>
      </div>

      <div class="box">
         <?php 
            $select_users = mysqli_query($con, "SELECT * from users WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <div class="icon">
            <img src="img/user-3-fill.png" alt="">
         </div>
         <h3><?php echo $number_of_users; ?></h3>
         <p>обычные пользователи</p>
         <a href="admin_users.php" class="option-btn">Подробнее</a>
      </div>

      <div class="box">
         <?php 
            $select_admins = mysqli_query($con, "SELECT * from users WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <div class="icon">
            <img src="img/shield-user-fill.png" alt="">
         </div>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>администраторы</p>
         <a href="admin_users.php" class="option-btn">Подробнее</a>
      </div>

      <div class="box">
         <?php 
            $select_account = mysqli_query($con, "SELECT * from users") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <div class="icon">
            <img src="img/file-list-3-fill.png" alt="">
         </div>
         <h3><?php echo $number_of_account; ?></h3>
         <p>всего аккаунтов</p>
         <a href="admin_users.php" class="option-btn">Подробнее</a>
      </div>

      <div class="box">
         <?php 
            $select_messages = mysqli_query($con, "SELECT * from `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <div class="icon">
            <img src="img/message-fill.png" alt="">
         </div>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>новые сообщения</p>
         <a href="admin_contacts.php" class="option-btn">Подробнее</a>
      </div>

   </div>

</section>

<!-- admin dashboard section ends -->

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
