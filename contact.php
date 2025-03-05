<?php

include 'config.php';
session_start();

// $user_id = $_SESSION['user_id'];
// $user_name = $_SESSION['user_name'];

if (isset($_POST['send'])) {
   $user_id = $_SESSION['user_id'];

   if (!($user_id)) {
      header('location:login.php');
   }

   $name = mysqli_real_escape_string($con, $_POST['name']);
   $email = mysqli_real_escape_string($con, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($con, $_POST['message']);

   // Проверка, отправлялось ли такое же сообщение ранее
   $select_message = mysqli_query($con, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('Ошибка выполнения запроса');

   if (mysqli_num_rows($select_message) > 0) {
      $message[] = 'Сообщение уже отправлено!';
   } else {
      mysqli_query($con, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('Ошибка выполнения запроса');
      $message[] = 'Сообщение успешно отправлено!';
   }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Контакты</title>

   <!-- Подключение Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Подключение кастомного CSS -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Свяжитесь с нами</h3>
      <p> <a href="home.php">Главная</a> / Контакты </p>
   </div>

   <section class="contact">
      <form action="" method="post" class="box1">
         <h3>Оставьте ваше сообщение</h3>
         <input type="text" name="name" required placeholder="Введите ваше имя" class="box">
         <input type="email" name="email" required placeholder="Введите ваш email" class="box">
         <input type="number" name="number" required placeholder="Введите ваш номер" class="box">
         <textarea name="message" class="box" placeholder="Введите ваше сообщение" id="" cols="30" rows="10"></textarea>
         <input type="submit" value="Отправить сообщение" name="send" class="btn">
      </form>

      <form class="box2">
         <h1>ГКТТиД-Читает</h1>
         <p>
            Супер классный сайт по продаже книг для курсового проекта по Базам данных.
         <p> Горячая линия: <span>+375 29 821-21-35</span> </p>
         <p> Служба поддержки: <span>+375 29 243-41-42</span> </p>
         <p> Поддержка: <span>24 * 7</span> </p>
         <p> Email: <span>martynkovskijaleksandr@gmail.com</span> </p>
         <p> Адрес: <span> Гродно, ул.Курчатова 4, блок 13/1</span> </p>
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
      </form>
   </section>

   <section class="about">
      <div class="flex">
         <div class="image">
            <img src="img/character-man-sitting-sofa-reading-book-3d-illustration_175994-17759.jpg" alt="">
         </div>

         <div class="content">
            <h3>О нас</h3>
            <p>Сайт созданный крутым разработчиком, который любит базы данных! </p>
            <a href="about.php" class="btn">Читать далее</a>
         </div>
      </div>
   </section>

   <?php include 'footer.php'; ?>

   <!-- Подключение кастомного JS -->
   <script src="js/script.js"></script>

</body>

</html>
