<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">    
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <title>Добавление событий</title>
</head>
<body>
<header>
    <img src="img/logo.svg" alt="">
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

<div class="content_new_news">   
        <button class="href_admin_toolbar" onclick="document.location = 'view_oferta.php'">Просмотр заполненных оферт</button>    
    <h1>Добавление события</h1>
    <form class="new_news-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="title">Заголовок новости:</label>
        <input class="input_info" type="text" id="title" name="title">
        <label for="date">Дата:</label>
        <input class="input_info" type="date" id="date" name="date">
        <label for="description">Описание:</label>
        <textarea id="description" name="description"></textarea>
        <label for="media">Выберите изображение:</label>
        <input type="file" id="media" name="media">
        <input class="new_news-btn" type="submit" value="Добавить новость">
    </form>

    <?php
    // Проверка, была ли отправлена форма
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Проверка наличия заголовка и описания новости
        if (!empty($_POST["title"]) && !empty($_POST["description"])) {
            // Проверка наличия файла
            if(isset($_FILES["media"]) && $_FILES["media"]["error"] !== UPLOAD_ERR_NO_FILE) {
                $uploadOk = 1;
                // Проверка, является ли файл изображением
                $check = getimagesize($_FILES["media"]["tmp_name"]);
                if($check == false) {
                    echo "<script>alert('Файл не является изображением.');</script>";
                    $uploadOk = 0;
                }

                // Проверка размера файла (не более 5MB)
                if ($_FILES["media"]["size"] > 5000000) {
                    echo "<script>alert('Извините, ваш файл слишком большой.');</script>";
                    $uploadOk = 0;
                }

                // Разрешить только определенные форматы файлов
                $imageFileType = strtolower(pathinfo($_FILES["media"]["name"],PATHINFO_EXTENSION));
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "<script>alert('Извините, только JPG, JPEG, PNG и GIF файлы разрешены.');</script>";
                    $uploadOk = 0;
                }

                // Если все в порядке, попробуйте загрузить файл
                if ($uploadOk == 1) {
                    $target_dir = "img/events/";
                    $target_file = $target_dir . basename($_FILES["media"]["name"]);
                    if (move_uploaded_file($_FILES["media"]["tmp_name"], $target_file)) {
                       
                        include 'config.php';

                        // Получение данных из формы
                        $title = $_POST['title'];
                        $date = $_POST['date'];
                        $description = $_POST['description'];
                        $media_url = $target_file;

                        // Подготовка и выполнение SQL-запроса для вставки новой записи
                        $sql = "INSERT INTO Events (event_title, event_date, event_description, event_media_url) VALUES ('$title', '$date', '$description', '$media_url')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<script>alert('Новость успешно добавлена');</script>";
                        } else {
                            echo "<script>alert('Ошибка: " . $sql . "\\n" . $conn->error . "');</script>";
                        }

                        // Закрытие подключения
                        $conn->close();
                    } else {
                        echo "<script>alert('Извините, произошла ошибка при загрузке вашего файла.');</script>";
                    }
                }
            } else {
                // Если файл изображения не выбран, вставляем запись без ссылки на изображение
                // Подключение к базе данных (замените данными вашего сервера)
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "oferta";

                // Создание подключения
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Проверка подключения
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Получение данных из формы
                $title = $_POST['title'];
                $date = $_POST['date'];
                $description = $_POST['description'];

                // Подготовка и выполнение SQL-запроса для вставки новой записи
                $sql = "INSERT INTO Events (event_title, event_date, event_description) VALUES ('$title', '$date', '$description')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Новость успешно добавлена');</script>";
                } else {
                    echo "<script>alert('Ошибка: " . $sql . "\\n" . $conn->error . "');</script>";
                }

                // Закрытие подключения
                $conn->close();
            }
        } else {
            echo "<script>alert('Заголовок и описание новости обязательны для заполнения');</script>";
        }
    }
    ?>
</div>
</body>
</html>
