<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <title>Новости</title>
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
    <div class="gaz_num">
        <p>Газовая служба</p>
        <span>104</span>
    </div>
</header>
<div class="admin_input" id="admin_input">
    <h2>Авторизация <span class="close-icon" onclick="closeLoginForm()">✖</span></h2>
    <form class="admin_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="username" placeholder="Логин"><br>
        <input type="password" name="password" placeholder="Пароль"><br>
        <input class="admin_input-btn" type="submit" value="Войти">
    </form>
</div>


    <div class="events">
      <h2>События</h2>
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

        <?php
        // Создание подключения
        include 'config.php';

        // Запрос для извлечения событий
        $sql = "SELECT * FROM Events ORDER BY event_date DESC";
        $result_news = $conn->query($sql);

        // Проверка наличия результатов
        if ($result_news->num_rows > 0) {
            while($row = $result_news->fetch_assoc()) {
              echo "<hr>";
                echo "<div class='event'>";
                if (!empty($row["event_media_url"])) {
                    echo "<div class='event-media'><img src='" . $row["event_media_url"] . "' ></div>";
                }
                echo "<div class='event-details'>";
                echo "<p class='event-date'>" . 'дата события: ' . $row["event_date"] . "</p>";
                echo "<p class='event-title'>" . $row["event_title"] . "</p>";
                echo "<p class='event-description'>" . $row["event_description"] . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "0 результатов";
        }

        $conn->close();
        ?>
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
</script>

</body>
</html>
