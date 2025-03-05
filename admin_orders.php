<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($con, "UPDATE orders SET payment_status = '$update_payment' WHERE order_id = '$order_update_id'") or die('query failed');
   $message[] = 'статус оплаты был обновлён!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($con, "DELETE FROM orders WHERE order_id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>заказы</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">размещённые заказы</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($con, "SELECT * from orders") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> пользователь id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> размещён : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> имя : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> номер : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> адрес : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> количество книг : <span><?php echo $fetch_orders['total_books']; ?></span> </p>
         <p> общая цена : <span><?php echo number_format($fetch_orders['total_price'], 0); ?> ₽</span> </p>
         <p> метод оплаты : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['order_id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">ожидает</option>
               <option value="completed">завершено</option>
            </select>
            <input type="submit" value="обновить" name="update_order" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['order_id']; ?>" onclick="return confirm('удалить этот заказ?');" class="delete-btn">удалить</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">ещё нет размещённых заказов!</p>';
      }
      ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
