<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">    
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <title>Клиентам</title>
</head>
<body>
<header>
    <img src="img/logo.svg" alt="" id="logo">
    <div class="toolbar">
        <a href="index.php">Главная</a>
        <a href="for_client.php">Клиентам</a>
        <a href="news.php">Новости</a>
        <a href="oferta.php">Оферта</a>
        <a href="contacts.php">Контакты</a>
    </div>
    <div class="admin_input" id="admin_input">
    <h2>Авторизация <span class="close-icon" onclick="closeLoginForm()">✖</span></h2>
    <form class="admin_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="username" placeholder="Логин"><br>
        <input type="password" name="password" placeholder="Пароль"><br>
        <input class="admin_input-btn" type="submit" value="Войти">
    </form>
</div>
    <div class="gaz_num">
        <p>Газовая служба</p>
        <span>104</span>
    </div>
</header>
<div class="contacts_content">
    <h2 class="consumer_safety_title">Безопасность потребителя</h2>
    <p class="consumer_safety_content">При обнаружении запаха газа круглосуточно ЗВОНИТЕ вне загазованных помещений <span>104</span></p>
    <h2 class="consumer_safety_title">Файл для заполненния оферты</h2>
    <iframe class="iframe_video" src="https://www.tver-gaz.ru/clients/documents/Заявка%20на%20присоединение.pdf"></iframe>
    <h2 class="consumer_safety_title">Полезные памятки и видеоролики</h2>
    <img src="img/img_for_client1.jpg" alt="">
    <img src="img/img_for_client2.jpg" alt="">
    <div class="video_player">
        <iframe class="iframe_video" src="https://www.youtube.com/embed/l-MNvkLrdtM" title="Газпром Учебный фильм. Техника безопасности" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        <iframe class="iframe_video" src="https://www.youtube.com/embed/6ohjjxha5YM" title="Если вы почувствовали запах газа" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        <iframe class="iframe_video" src="https://www.youtube.com/embed/HiAtnWhOm84" title="Правила безопасного использования газа в быту" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        
</div>
<footer>
    <img src="img/footer_logo.png" alt="">
    <div class="adress_footer">
        <p>170005, Тверь, ул. Фурманова, 12/4</p>
        <p>© 2023 АО «Газпром газораспределение Тверь»</p>
        <p>Режим работы</p>
        <p>Пн-Пт: 8:30-17:30, перерыв 12:30-13:30</p>
        <p>Сб-Вс - Выходной</p>
    </div>
    <div class="number_footer">
        <p>Тел.: +74822522758</p>
        <p>8-800-100-01-54</p>
        <p>info@tver-gaz.ru</p>
    </div>
    <div class="web_footer">
        <p>Социальные сети</p>
        <p>ООО "Газпром межрегионгаз"</p>
        <div class="web_img-footer">
            <a href="https://t.me/news_mrg"><img src="img/telegram_1.png" alt=""></a>
            <a href="https://vk.com/gazprom_mrg"><img src="img/vk_1.png" alt=""></a>
        </div>
    </div>
</footer>
<script>
    document.getElementById('logo').addEventListener('click', function() {
        document.getElementById('admin_input').style.display = 'flex';
    });

    function closeLoginForm() {
        document.getElementById('admin_input').style.display = 'none';
    }
    <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {       
                
        include 'config.php';

            // Получение введенного логина и пароля
            $entered_username = $_POST['username'];
            $entered_password = $_POST['password'];

            // SQL-запрос для проверки совпадения логина и пароля
            $sql = "SELECT * FROM admins WHERE login='$entered_username' AND password='$entered_password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Пользователь авторизован, перенаправляем на страницу new_news.php
                header("Location: new_news.php");
                exit();
            } else {
                // Неверные логин или пароль, выводим сообщение об ошибке
                echo "<script>alert('Неверный логин или пароль');</script>";
            }

            $conn->close();
        }
        ?>
</script>
</body>
</html>