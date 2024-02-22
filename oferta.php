
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <title>Оферта</title>
</head>
<body>
<header>
    <img src="img/logo.svg" alt="" id="logo">
    <div class="toolbar">
        <a href="index.php">Главная</a>
        <a href="">Клиентам</a>
        <a href="">Новости</a>
        <a href="">Оферта</a>
        <a href="">Контакты</a>
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

<div class="oferta_content">
    <h2>Добавление данных в таблицы</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Форма для ввода данных паспорта -->
        <h3>Паспорт</h3>
        <label for="full_name">ФИО:</label><br>
        <input type="text" id="full_name" name="full_name"><br>
        <label for="date_of_birth">Дата рождения:</label><br>
        <input type="date" id="date_of_birth" name="date_of_birth"><br>
        <label for="passport_number">Номер паспорта:</label><br>
        <input type="text" id="passport_number" name="passport_number"><br>
        <label for="address">Адрес:</label><br>
        <input type="text" id="address" name="address"><br>
        <label for="issuing_authority">Орган выдачи:</label><br>
        <input type="text" id="issuing_authority" name="issuing_authority"><br>
        <label for="date_of_issue">Дата выдачи:</label><br>
        <input type="date" id="date_of_issue" name="date_of_issue"><br><br>

        <!-- Форма для ввода данных о газовом оборудовании -->
        <h3>Газовое оборудование</h3>
        <label for="equipment_type">Тип оборудования:</label><br>
        <input type="text" id="equipment_type" name="equipment_type"><br>
        <label for="installation_date">Дата установки:</label><br>
        <input type="date" id="installation_date" name="installation_date"><br>
        <label for="last_maintenance_date">Дата последнего обслуживания:</label><br>
        <input type="date" id="last_maintenance_date" name="last_maintenance_date"><br>
        <label for="status">Статус:</label><br>
        <input type="text" id="status" name="status"><br><br>

        <!-- Форма для ввода данных о документе владения -->
        <h3>Документ владения</h3>
        <label for="document_type">Тип документа:</label><br>
        <input type="text" id="document_type" name="document_type"><br>
        <label for="document_number">Номер документа:</label><br>
        <input type="text" id="document_number" name="document_number"><br>
        <label for="document_date_of_issue">Дата выдачи:</label><br>
        <input type="date" id="document_date_of_issue" name="document_date_of_issue"><br>
        <label for="issued_by">Выдан:</label><br>
        <input type="text" id="issued_by" name="issued_by"><br><br>

        <input type="submit" value="Добавить данные">
    </form>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "oferta";

    // Создание подключения к базе данных
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Обработка формы после отправки
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Защита от SQL-инъекций
    

        // Получение и очистка данных из формы, только если они отправлены
        if(isset($_POST["full_name"])) {
       

            // SQL-запрос для добавления данных в таблицу паспортов
            $sql_passport = "INSERT INTO Passports (full_name, date_of_birth, passport_number, address, issuing_authority, date_of_issue)
                             VALUES ('$full_name', '$date_of_birth', '$passport_number', '$address', '$issuing_authority', '$date_of_issue')";

            // Выполнение запроса
            if ($conn->query($sql_passport) === TRUE) {
                echo "Данные паспорта успешно добавлены!";
            } else {
                echo "Ошибка при добавлении данных паспорта: " . $conn->error;
            }
        }

        // Добавление данных в таблицу газового оборудования
        if(isset($_POST["equipment_type"])) {
            

            $sql_equipment = "INSERT INTO Gas_equipment (equipment_type, installation_date, last_maintenance_date, status)
                              VALUES ('$equipment_type', '$installation_date', '$last_maintenance_date', '$status')";

            if ($conn->query($sql_equipment) === TRUE) {
                echo "Данные газового оборудования успешно добавлены!";
            } else {
                echo "Ошибка при добавлении данных газового оборудования: " . $conn->error;
            }
        }

        // Добавление данных в таблицу документов владения
        if(isset($_POST["document_type"])) {
          

            $sql_document = "INSERT INTO Ownership_documents (document_type, document_number, document_date_of_issue, issued_by)
                             VALUES ('$document_type', '$document_number', '$document_date_of_issue', '$issued_by')";

            if ($conn->query($sql_document) === TRUE) {
                echo "Данные документа владения успешно добавлены!";
            } else {
                echo "Ошибка при добавлении данных документа владения: " . $conn->error;
            }
        }
    }

    // Закрытие подключения
    $conn->close();
?>


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
