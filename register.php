<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($con, $_POST['name']);
   $email = mysqli_real_escape_string($con, $_POST['email']);
   $pass = mysqli_real_escape_string($con, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($con, md5($_POST['cpassword']));
   // $user_type = $_POST['user_type'];

   $select_users = mysqli_query($con, "SELECT * from users where email = '$email' AND password = '$pass'") or die('Ошибка запроса');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'Пользователь уже существует!';
   }else{
      if($pass != $cpass){
         $message[] = 'Пароли не совпадают!';
      }else{
         mysqli_query($con, "INSERT into users(name, email, password) VALUES('$name', '$email', '$cpass')") or die('Ошибка запроса');
         $message[] = 'Регистрация прошла успешно!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>регистрация</title>

   <!-- ссылка на font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- ссылка на кастомный css файл -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

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
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>зарегистрируйтесь сейчас</h3>
      <input type="text" name="name" placeholder="введите ваше имя" required class="box">
      <input type="email" name="email" placeholder="введите ваш email" required class="box">
      <input type="password" name="password" placeholder="введите ваш пароль" required class="box">
      <input type="password" name="cpassword" placeholder="подтвердите ваш пароль" required class="box">
      <!-- <select name="user_type" class="box">
         <option value="user">пользователь</option>
         <option value="admin">администратор</option>
      </select> -->
      <input type="submit" name="submit" value="зарегистрироваться" class="btn">
      <p>уже есть аккаунт? <a href="login.php">войдите сейчас</a></p>
   </form>

</div>

</body>
</html>
