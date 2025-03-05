<?php

include 'config.php';
session_start();

if (isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['user_id'];

    if (!($user_id)) {
        header('location:login.php');
    }

    $book_name = $_POST['book_name'];
    $book_price = $_POST['book_price'];
    $book_image = $_POST['book_image'];
    $book_quantity = $_POST['book_quantity'];

    $check_cart_numbers = mysqli_query($con, "SELECT * from shopping_cart where book_name = '$book_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Этот товар уже добавлен в корзину!';
    } else {
        mysqli_query($con, "INSERT INTO shopping_cart(user_id, book_name, book_price, book_quantity, book_image) VALUES('$user_id', '$book_name', '$book_price', '$book_quantity', '$book_image')") or die('query failed');
        $message[] = 'Книга добавлена в корзину!';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Детали книги</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="title">
        <h3>Детали книги</h3>
    </div>

    <?php
    if (isset($_GET['book_id'])) {
        $bid = $_GET['book_id'];
        $select_books = mysqli_query($con, "SELECT * FROM books WHERE book_id = '$bid'") or die('query failed');
        if (mysqli_num_rows($select_books) > 0) {
            while ($fetch_books = mysqli_fetch_assoc($select_books)) {
    ?>

    <section class="quick-view">
        <div class="box-container">
            <form action="" method="POST" class="box">
                <img src="uploaded_img/<?php echo $fetch_books['book_image']; ?>" alt="" class="image">
                <div class="name">Название: <?php echo $fetch_books['book_name']; ?></div>
                <?php
                    $final_price = $fetch_books['book_price'];
                    if($fetch_books['discount'] > 0) {
                        $final_price = $fetch_books['book_price'] - ($fetch_books['book_price'] * ($fetch_books['discount'] / 100));
                ?>
                    <div class="price">Цена: <span class="original-price"><?php echo number_format($fetch_books['book_price'], 0); ?> ₽</span> <?php echo number_format($final_price, 0); ?> ₽</div>
                <?php } else { ?>
                    <div class="price">Цена: <?php echo number_format($final_price, 0); ?> ₽</div>
                <?php } ?>
                <div class="type">Тип: <?php echo $fetch_books['book_category']; ?></div>
                <div class="author">Автор: <?php echo $fetch_books['book_author']; ?></div>
                <div class="info">Описание: <br><?php echo $fetch_books['book_info']; ?></div>
                <input type="number" name="book_quantity" value="1" min="0" class="qty">
                <input type="hidden" name="book_id" value="<?php echo $fetch_books['book_id']; ?>">
                <input type="hidden" name="book_name" value="<?php echo $fetch_books['book_name']; ?>">
                <input type="hidden" name="book_price" value="<?php echo $final_price; ?>">
                <input type="hidden" name="book_image" value="<?php echo $fetch_books['book_image']; ?>">
                <input type="submit" value="Добавить в корзину" name="add_to_cart" class="btn">
            </form>
        </div>
    </section>

    <?php
            }
        } else {
            echo '<p class="empty">Нет доступных деталей для этого товара!</p>';
        }
    }
    ?>

    <div class="cart-total">
        <div class="flex">
            <a href="home.php" class="btn">Перейти на главную страницу</a>
            <a href="shop.php" class="btn">Перейти в магазин</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- custom js file link -->
    <script src="js/script.js"></script>
</body>
</html>
