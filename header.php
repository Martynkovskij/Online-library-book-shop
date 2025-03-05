<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
$user_id = $_SESSION['user_id'] ?? null;

?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <p> Новый <a href="login.php">Вход</a> | <a href="register.php">Регистрация</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">BookShop</a>

         <nav class="navbar">
            <a href="home.php">Главная</a>
            <a href="about.php">О нас</a>
            <a href="shop.php">Магазин</a>
            <a href="contact.php">Контакты</a>
            <a href="orders.php">Заказы</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>

            <?php 
               if($user_id){

            ?>
            <div id="user-btn" class="fas fa-user"></div>
            <?php 
               }
            ?>
            <?php
                  $select_cart_count = mysqli_query($con, "SELECT * FROM shopping_cart WHERE user_id = '$user_id'") or die('Ошибка выполнения запроса');
                  $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_num_rows; ?>)</span> </a>
         </div>

         <div class="user-box">
         <p>Имя пользователя: <span><?php echo $_SESSION['user_name']; ?></span></p>
         <p>Электронная почта: <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">Выход</a>
         </div>
      </div>
   </div>

</header>
