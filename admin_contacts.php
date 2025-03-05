<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($con, "DELETE FROM `message` WHERE message_id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Сообщения</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">Сообщения</h1>

   <div class="box-container">
   <?php
      $select_message = mysqli_query($con, "SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
      
   ?>
   <div class="box">
      <p> ID пользователя: <span><?php echo $fetch_message['user_id']; ?></span> </p>
      <p> Имя: <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> Номер: <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> Email: <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> Сообщение: <span><?php echo $fetch_message['message']; ?></span> </p>
      <a href="admin_contacts.php?delete=<?php echo $fetch_message['message_id']; ?>" onclick="return confirm('Удалить это сообщение?');" class="delete-btn">Удалить сообщение</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">У вас нет сообщений!</p>';
   }
   ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>