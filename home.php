<?php

include 'config.php';
session_start();

if(isset($_POST['add_to_cart'])){
    $user_id = $_SESSION['user_id'];

    if(!($user_id)){
        header('location:login.php');
    }

    $book_name = $_POST['book_name'];
    $book_price = $_POST['book_price'];
    $book_image = $_POST['book_image'];
    $book_quantity = $_POST['book_quantity'];

    $check_cart_numbers = mysqli_query($con, "SELECT * FROM shopping_cart WHERE book_name = '$book_name' AND user_id = '$user_id'") or die('Ошибка запроса');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'Уже добавлено в корзину!';
    }else{
        mysqli_query($con, "INSERT INTO shopping_cart(user_id, book_name, book_price, book_quantity, book_image) VALUES('$user_id', '$book_name', '$book_price', '$book_quantity', '$book_image')") or die('Ошибка запроса');
        $message[] = 'Книга добавлена в корзину!';
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Главная</title>

   <!-- Подключение Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Подключение Swiper.js -->
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

   <!-- Подключение пользовательского CSS -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home" id="home">
    <div class="row">
        <div class="content">
            <h3>Скидки до 75%</h3>
            <p>Книги на сайте со скидкой до 75%! Успейте купить по выгодной цене.</p>
            <a href="shop.php" class="btn">Купить сейчас</a>
        </div>
        <div class="swiper book-slider">
            <div class="swiper-wrapper">
                <?php
                    $select_discount_books = mysqli_query($con, "SELECT * FROM books WHERE discount > 0 AND discount <= 75 ORDER BY discount DESC LIMIT 5") or die('Ошибка запроса');
                    if(mysqli_num_rows($select_discount_books) > 0){
                        while($fetch_discount_books = mysqli_fetch_assoc($select_discount_books)){
                            $final_price = $fetch_discount_books['book_price'] - ($fetch_discount_books['book_price'] * ($fetch_discount_books['discount'] / 100));
                ?>
                    <div class="swiper-slide">
                        <div class="book-card">
                            <a href="book_details.php?book_id=<?php echo $fetch_discount_books['book_id']; ?>">
                                <img src="uploaded_img/<?php echo $fetch_discount_books['book_image']; ?>" alt="<?php echo $fetch_discount_books['book_name']; ?>">
                                <div class="book-info">
                                    <h4><?php echo $fetch_discount_books['book_name']; ?></h4>
                                    <div class="price">
                                        <span class="original-price"><?php echo number_format($fetch_discount_books['book_price'], 0); ?> ₽</span>
                                        <span class="discount-price"><?php echo number_format($final_price, 0); ?> ₽</span>
                                    </div>
                                    <div class="discount-badge">-<?php echo $fetch_discount_books['discount']; ?>%</div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                        }
                    } else {
                        $select_books = mysqli_query($con, "SELECT * FROM books LIMIT 5") or die('Ошибка запроса');
                        while($fetch_books = mysqli_fetch_assoc($select_books)){
                ?>
                    <div class="swiper-slide">
                        <div class="book-card">
                            <a href="book_details.php?book_id=<?php echo $fetch_books['book_id']; ?>">
                                <img src="uploaded_img/<?php echo $fetch_books['book_image']; ?>" alt="<?php echo $fetch_books['book_name']; ?>">
                                <div class="book-info">
                                    <h4><?php echo $fetch_books['book_name']; ?></h4>
                                    <div class="price">
                                        <span class="discount-price"><?php echo number_format($fetch_books['book_price'], 0); ?> ₽</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Услуги -->
<section class="services_container">
    <div class="icon">
        <div class="free-dilevery">
            <img src="img/truck-fill.png" alt="">
            <h3>Бесплатная доставка</h3>
            <p>Быстрая и бесплатная доставка</p>
        </div>
        <div class="free-dilevery">
            <img src="img/customer-service-2-fill.png" alt="">
            <h3>Поддержка 24/7</h3>
            <p>Круглосуточная поддержка</p>
        </div>
        <div class="free-dilevery">
            <img src="img/wallet-3-fill.png" alt="">
            <h3>Оплата при получении</h3>
            <p>Оплачивайте книги при получении</p>
        </div>
    </div>
</section>

<!-- Лучшие продажи -->
<section class="books">
    <div class="f-heading"><h1><span>Бестселлеры</span></h1></div>
    <div class="box-container">
        <?php  
            $select_books = mysqli_query($con, "SELECT books.*, COALESCE(COUNT(order_details.book_id), 0) as sales 
                FROM books 
                LEFT JOIN order_details ON books.book_id = order_details.book_id 
                GROUP BY books.book_id 
                ORDER BY sales DESC, books.book_name ASC 
                LIMIT 4") or die('Ошибка запроса');
            if(mysqli_num_rows($select_books) > 0){
                while($fetch_books = mysqli_fetch_assoc($select_books)){
                    $final_price = $fetch_books['book_price'];
                    if($fetch_books['discount'] > 0) {
                        $final_price = $fetch_books['book_price'] - ($fetch_books['book_price'] * ($fetch_books['discount'] / 100));
                    }
        ?>
        <form action="" method="post" class="box">
            <a href="book_details.php?book_id=<?php echo $fetch_books['book_id']; ?>" class="fas fa-eye"></a>
            <img class="image" src="uploaded_img/<?php echo $fetch_books['book_image']; ?>" alt="<?php echo $fetch_books['book_name']; ?>">
            <div class="name"><?php echo $fetch_books['book_name']; ?></div>
            <?php if($fetch_books['discount'] > 0) { ?>
                <div class="price"><span class="original-price"><?php echo $fetch_books['book_price']; ?> ₽</span> <?php echo number_format($final_price, 0); ?> ₽</div>
            <?php } else { ?>
                <div class="price"><?php echo number_format($final_price, 0); ?> ₽</div>
            <?php } ?>
            <input type="number" min="1" name="book_quantity" value="1" class="qty">
            <input type="hidden" name="book_name" value="<?php echo $fetch_books['book_name']; ?>">
            <input type="hidden" name="book_price" value="<?php echo $final_price; ?>">
            <input type="hidden" name="book_image" value="<?php echo $fetch_books['book_image']; ?>">
            <input type="submit" value="Добавить в корзину" name="add_to_cart" class="btn">
        </form>
        <?php
                }
            }else{
                echo '<p class="empty">Книг пока нет!</p>';
            }
        ?>
    </div>
    <div class="load-more" style="margin-top: 2rem; text-align:center">
        <a href="shop.php" class="option-btn">Загрузить еще</a>
    </div>
</section>

<?php include 'footer.php'; ?>

<!-- Подключение Swiper.js -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Подключение пользовательского JS -->
<script src="js/script.js"></script>
</body>
</html>
