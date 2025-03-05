<?php

include 'config.php';
// session_start();

// $user_id = $_SESSION['user_id'];

//    if(!($user_id)){
//       header('location:login.php');
//    }
//    $user_id = $_SESSION['user_id'];
//    $user_name =$_SESSION['user_name'];
   
//    if(!isset($user_id)){
//       header('location:login.php');
//    };
?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>О нас</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>О нас</h3>
   <p> <a href="home.php">Главная</a> / О нас </p>
</div>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="img/e-learning-isometric-composition-with-students-near-shelves-with-books-mobile-device-screen.png" alt="">
        </div>

        <div class="content">
            <h3>Почему выбирают нас?</h3>
            <p>Наша цель — предоставлять значимый, увлекательный и вдохновляющий контент для детей, который выходит далеко за рамки их обычных учебников. С этой точки зрения мы относимся к каждой книге как к произведению искусства.</p>
            <a href="shop.php" class="btn">Купить сейчас</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>Что мы предлагаем?</h3>
            <p>Широкий ассортимент книг, предлагаемых нами, включает сказки, басни, учебные книги, справочники, книги общих знаний, книги по грамматике, раскраски, книги с заданиями, книги с наклейками и многое другое.</p>
            <a href="contact.php" class="btn">Связаться с нами</a>
        </div>

        <div class="image">
            <img src="img/e-learning-smartphone-isometric.png" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="img/hand-drawn-flat-design-book-club-illustration.png" alt="">
        </div>

        <div class="content">
            <h3>Кто мы?</h3>
            <p>Наш книжный магазин — это мета-поисковая система для сравнения цен на книги и проверки их наличия во всех популярных индийских книжных магазинах.</p>
            <a href="#reviews" class="btn">Отзывы клиентов</a>
        </div>

    </div>

</section>

<!-- Раздел отзывов -->
<section id="testimonials">
    <!-- Заголовок отзывов -->
    <div class="r-header" id="reviews">
        <span>Отзывы</span>
        <h1>Что говорят клиенты</h1>
    </div>

<div class="review_container">
    <!-- Отзыв 1 -->
    <div class="review_box">
        <!-- Верхняя часть -->
        <div class="box_top">
            <!-- Профиль -->
            <div class="profile">
                <!-- Изображение -->
                <div class="img">
                    <img src="img/testimonial-perfil-2.png" alt="#">
                </div>
            </div>
                <!-- Имя пользователя -->
                <div class="user-name">
                    <strong>Дядя Вова</strong>
                    <span>@Vov4ik</span>
                </div>
            
            <!-- Оценка -->
            <div class="reviews">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-half-line.png" alt="">
                <img src="img/star-line.png" alt="#">
                
            </div>
        </div>
        <!-- Комментарий клиента -->
        <div class="client_comment">
            <p>
                Этот сайт — лучший для продажи книг в электронной коммерции с возможностью оплаты при доставке. Книги очень удобны в использовании.
            </p>
        </div>
    
    </div>

    <!-- Отзыв 2 -->
    <div class="review_box">
        <!-- Верхняя часть -->
        <div class="box_top">
            <!-- Профиль -->
            <div class="profile">
                <!-- Изображение -->
                <div class="img">
                    <img src="img/pic-1.png" alt="#">
                </div>
            </div>
                <!-- Имя пользователя -->
                <div class="user-name">
                    <strong>Стары Бох</strong>
                    <span>@oldgod228</span>
                </div>
            
            <!-- Оценка -->
            <div class="reviews">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-half-line.png" alt="">
                <img src="img/star-line.png" alt="#">
                <img src="img/star-line.png" alt="#">
                
            </div>
        </div>
        <!-- Комментарий клиента -->
        <div class="client_comment">
            <p>
                Этот сайт — лучший для продажи книг в электронной коммерции с возможностью оплаты при доставке. Книги очень удобны в использовании.
            </p>
        </div>
    
    </div>

    <!-- Отзыв 3 -->
    <div class="review_box">
        <!-- Верхняя часть -->
        <div class="box_top">
            <!-- Профиль -->
            <div class="profile">
                <!-- Изображение -->
                <div class="img">
                    <img src="img/pic-3.png" alt="#">
                </div>
            </div>
                <!-- Имя пользователя -->
                <div class="user-name">
                    <strong>Саня Путин</strong>
                    <span>@Putin</span>
                </div>
            
            <!-- Оценка -->
            <div class="reviews">
            <img src="img/star-fill.png" alt="#">
                <img src="img/star-half-line.png" alt="">
                <img src="img/star-line.png" alt="#">
                <img src="img/star-line.png" alt="#">
                <img src="img/star-line.png" alt="#"> 
            </div>
        </div>
        <!-- Комментарий клиента -->
        <div class="client_comment">
            <p>
                Этот сайт — лучший для продажи книг в электронной коммерции с возможностью оплаты при доставке. Книги очень удобны в использовании.
            </p>
        </div>
    
    </div>

    <!-- Отзыв 4 -->
    <div class="review_box">
        <!-- Верхняя часть -->
        <div class="box_top">
            <!-- Профиль -->
            <div class="profile">
                <!-- Изображение -->
                <div class="img">
                    <img src="img/testimonial-perfil-4.png" alt="#">
                </div>
            </div>
                <!-- Имя пользователя -->
                <div class="user-name">
                    <strong>Миша Арсенал</strong>
                    <span>@arsenal</span>
                </div>
            
            <!-- Оценка -->
            <div class="reviews">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-half-line.png" alt="">
                
            </div>
        </div>
        <!-- Комментарий клиента -->
        <div class="client_comment">
            <p>
                Этот сайт — лучший для продажи книг в электронной коммерции с возможностью оплаты при доставке. Книги очень удобны в использовании.
            </p>
        </div>
    
    </div>

    <!-- Отзыв 5 -->
    <div class="review_box">
        <!-- Верхняя часть -->
        <div class="box_top">
            <!-- Профиль -->
            <div class="profile">
                <!-- Изображение -->
                <div class="img">
                    <img src="img/pic-5.png" alt="#">
                </div>
            </div>
                <!-- Имя пользователя -->
                <div class="user-name">
                    <strong>Даня Ишак</strong>
                    <span>@ishak</span>
                </div>
            
            <!-- Оценка -->
            <div class="reviews">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
            </div>
        </div>
        <!-- Комментарий клиента -->
        <div class="client_comment">
            <p>
                Этот сайт — лучший для продажи книг в электронной коммерции с возможностью оплаты при доставке. Книги очень удобны в использовании.
            </p>
        </div>
    
    </div>

    <!-- Отзыв 6 -->
    <div class="review_box">
        <!-- Верхняя часть -->
        <div class="box_top">
            <!-- Профиль -->
            <div class="profile">
                <!-- Изображение -->
                <div class="img">
                    <img src="img/testimonial-perfil-2.png" alt="#">
                </div>
            </div>
                <!-- Имя пользователя -->
                <div class="user-name">
                    <strong>Димка Ультраправый</strong>
                    <span>@ultradima</span>
                </div>
            
            <!-- Оценка -->
            <div class="reviews">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-fill.png" alt="#">
                <img src="img/star-line.png" alt="">
                <img src="img/star-line.png" alt="">

                
            </div>
        </div>
        <!-- Комментарий клиента -->
        <div class="client_comment">
            <p>
                Этот сайт — лучший для продажи книг в электронной коммерции с возможностью оплаты при доставке. Книги очень удобны в использовании.
            </p>
        </div>
    
    </div>
</div>

<div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="contact.php" class="option-btn">Оставить отзыв</a>
   </div>
</section>

<section class="authors">

   <h1 class="title">Разработчики</h1>

   <div class="box-container">

      <div class="box">
         <img src="img/author-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Инна Алексейченко</h3>
      </div>

      <div class="box">
         <img src="img/author-3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Александр Мартынковский</h3>
      </div>

      <div class="box">
         <img src="images/author-5.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Екатерина Петрукович</h3>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>