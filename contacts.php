<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <title>Контакты</title>
</head>
<body>
<header>
    <img src="img/logo.svg" alt="" id="logo">
    <div class="toolbar">
        <a href="index.php">Главная</a>
        <a href="">Клиентам</a>
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
<?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "oferta";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {           

            // Создание подключения
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Проверка подключения
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

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

<div class="contacts_content">
    <h1>Контакты</h1>
    <div class="info_contact">
      <div class="info_contact-title">
        <p>Полное наименование</p>
        <p>Почтовый адрес</p>
        <p>Единый центр предоставления услуг</p>
        <p>Телефон горячей линии</p>
      </div>
      <div class="info_contact-content">
        <p>Акционерное общество "Газпром газораспределение Тверь"</p>
        <p>170005, Российская Федерация, г. Тверь, ул. Фурманова, д. 12/4</p>
        <p><a href="tel:84822520323">+7 4822 52-03-23</a>	</p>
        <p><a href="tel:88001000154">8-800-100-01-54</a>	</p>
      </div>
      
    </div>
    <div class="text" style="width: 100%">
<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ae70b9fb527979d1d5389203e34dd0aab29422090cefa208b17ef60587a4576f0&amp;source=constructor" width="100%" height="280" frameborder="0"></iframe>
</div>
<div class="bank_info">
  <h2>Банковские реквизиты</h2>
  <p>ИНН/КПП 6900000364/695201001</p>
  <p>р/с 40702810406180000059</p>
  <p>Тульский филиал АБ "РОССИЯ"</p>
  <p>БИК 047003764</p>
  <p>К/с № 30101810600000000764</p>
</div>
</div>
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
