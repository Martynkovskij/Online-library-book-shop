<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Панель <span>Администратора</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Главная</a>
         <a href="admin_books.php">Книги</a>
         <a href="admin_category.php">Категории</a>
         <a href="admin_author.php">Авторы</a>
         <a href="admin_orders.php">Заказы</a>
         <a href="admin_users.php">Пользователи</a>
         <a href="admin_contacts.php">Сообщения</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Имя пользователя : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">Выйти</a>
         <div>новый <a href="login.php">вход</a> | <a href="register.php">регистрация</a></div>
      </div>

   </div>

</header>
