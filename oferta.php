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

<div class="oferta_content">
    
    <form class="oferta_form" action="" method="post" onsubmit="return validateForm()">
    <h2>Переоформление договора</h2>
        <!-- Форма для ввода данных паспорта -->
        <h3>Паспорт</h3>
        <label for="full_name">ФИО:</label>
        <input type="text" id="full_name" name="full_name">
        <label for="date_of_birth">Дата рождения:</label>
        <input type="date" id="date_of_birth" name="date_of_birth">
        <label for="passport_number">Номер паспорта:</label>
        <input type="text" id="passport_number" name="passport_number" maxlength="10">
        <label for="address">Адрес:</label>
        <input type="text" id="address" name="address">
        <label for="issuing_authority">Орган выдачи:</label>
        <input type="text" id="issuing_authority" name="issuing_authority">
        <label for="date_of_issue">Дата выдачи:</label>
        <input type="date" id="date_of_issue" name="date_of_issue">
        <hr>

        <!-- Форма для ввода данных о газовом оборудовании -->
        <h3>Газовое оборудование</h3>
        <label for="equipment_type">Тип оборудования:</label>
        <input type="text" id="equipment_type" name="equipment_type">
        <label for="installation_date">Дата установки:</label>
        <input type="date" id="installation_date" name="installation_date">
        <label for="last_maintenance_date">Дата последнего обслуживания:</label>
        <input type="date" id="last_maintenance_date" name="last_maintenance_date">
        <label for="status">Статус:</label>
        <input type="text" id="status" name="status">
        <hr>

        <!-- Форма для ввода данных о документе владения -->
        <h3>Документ владения</h3>
        <label for="document_type">Тип документа:</label>
        <input type="text" id="document_type" name="document_type">
        <label for="document_number">Номер документа:</label>
        <input type="text" id="document_number" name="document_number">
        <label for="document_date_of_issue">Дата выдачи:</label>
        <input type="date" id="document_date_of_issue" name="document_date_of_issue">
        <label for="issued_by">Выдан:</label>
        <input type="text" id="issued_by" name="issued_by">

        <hr>
        
        <input class="submit_oferta-btn" type="submit" name="submit" value="Переоформить">

        <?php
        if(isset($_POST['submit'])) {
            include 'config.php';

            // Получение данных из формы и обработка безопасности
            $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
            $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
            $passport_number = mysqli_real_escape_string($conn, $_POST['passport_number']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $issuing_authority = mysqli_real_escape_string($conn, $_POST['issuing_authority']);
            $date_of_issue = mysqli_real_escape_string($conn, $_POST['date_of_issue']);
            $equipment_type = mysqli_real_escape_string($conn, $_POST['equipment_type']);
            $installation_date = mysqli_real_escape_string($conn, $_POST['installation_date']);
            $last_maintenance_date = mysqli_real_escape_string($conn, $_POST['last_maintenance_date']);
            $status = mysqli_real_escape_string($conn, $_POST['status']);
            $document_type = mysqli_real_escape_string($conn, $_POST['document_type']);
            $document_number = mysqli_real_escape_string($conn, $_POST['document_number']);
            $document_date_of_issue = mysqli_real_escape_string($conn, $_POST['document_date_of_issue']);
            $issued_by = mysqli_real_escape_string($conn, $_POST['issued_by']);

            // Проверка на пустые поля
            if(empty($full_name) || empty($date_of_birth) || empty($passport_number) || empty($address) || empty($issuing_authority) || empty($date_of_issue) || empty($equipment_type) || empty($installation_date) || empty($last_maintenance_date) || empty($status) || empty($document_type) || empty($document_number) || empty($document_date_of_issue) || empty($issued_by)) {
                echo "<script>alert('Пожалуйста, заполните все поля.');</script>";
            } else {
                // SQL-запрос для вставки данных в таблицу Passports
                $sql_passport = "INSERT INTO Passports (full_name, date_of_birth, passport_number, address, issuing_authority, date_of_issue) VALUES ('$full_name', '$date_of_birth', '$passport_number', '$address', '$issuing_authority', '$date_of_issue')";

                if ($conn->query($sql_passport) === TRUE) {
                    // Получение ID только что вставленной записи паспорта
                    $passport_id = $conn->insert_id;

                    // SQL-запрос для вставки данных в таблицу Gas_Equipment
                    $sql_equipment = "INSERT INTO Gas_Equipment (owner_id, equipment_type, installation_date, last_maintenance_date, status) VALUES ('$passport_id', '$equipment_type', '$installation_date', '$last_maintenance_date', '$status')";
                    $conn->query($sql_equipment);

                    // SQL-запрос для вставки данных в таблицу Ownership_Documents
                    $sql_documents = "INSERT INTO Ownership_Documents (owner_id, document_type, document_number, date_of_issue, issued_by) VALUES ('$passport_id', '$document_type', '$document_number', '$document_date_of_issue', '$issued_by')";
                    $conn->query($sql_documents);

                    echo '<script>alert("Данные успешно добавленны!");</script>';
                } else {
                    echo "Ошибка: " . $sql_passport . "" . $conn->error;
                }
            }

            // Закрытие соединения с базой данных
            $conn->close();
        }
        ?>
           
    </form>
</div>
<script>
    function validateForm() {
        var inputs = document.getElementsByClassName('oferta_form')[0].getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value.trim() === "") {
                alert("Пожалуйста, заполните все поля.");
                return false;
            }
        }
        return true;
    }

    document.getElementById('logo').addEventListener('click', function() {
        document.getElementById('admin_input').style.display = 'flex';
    });

    function closeLoginForm() {
        document.getElementById('admin_input').style.display = 'none';
    }
</script>


</body>
</html>
