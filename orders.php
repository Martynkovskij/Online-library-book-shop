<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

   if(!($user_id)){
      header('location:login.php');
   }
   // $user_id = $_SESSION['user_id'];
   // $user_name =$_SESSION['user_name'];
   
   // if(!isset($user_id)){
   //    header('location:login.php');
   // }

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Заказы</title>

   <!-- ссылка на font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- ссылка на кастомный css файл -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Ваши заказы</h3>
   <p> <a href="home.php">Главная</a> / Заказы </p>
</div>

<section class="placed-orders">

   <h1 class="title">Размещенные заказы</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($con, "SELECT * from orders where user_id = '$user_id'") or die('Ошибка запроса');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> Размещен : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Имя : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Номер : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> E-mail : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Адрес : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Метод оплаты : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> Ваши заказы : <span><?php echo $fetch_orders['total_books']; ?></span> </p>
         <p> Общая цена : <span><?php echo number_format($fetch_orders['total_price'], 0); ?> ₽</span> </p>
         <p> Статус оплаты : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">Еще нет размещенных заказов!</p>';
      }
      ?>
   </div>

</section>


<?php include 'footer.php'; ?>

<!-- ссылка на кастомный js файл -->
<script src="js/script.js"></script>

</body>
</html>
