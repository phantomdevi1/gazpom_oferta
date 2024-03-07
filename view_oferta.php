<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">    
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <title>Заполненные оферты</title>
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

<div class="content_view_oferta">   
        <button class="href_admin_toolbar" onclick="document.location = 'new_news.php'">Добавление событий</button>    
    <h1>Заполненные оферты</h1>
    <?php
// Establish a connection to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oferta";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the tables
$sql = "SELECT * FROM Gas_Equipment 
        INNER JOIN Ownership_Documents ON Gas_Equipment.owner_id = Ownership_Documents.owner_id
        INNER JOIN Passports ON Gas_Equipment.owner_id = Passports.passport_id";
$result = $conn->query($sql);

// Display data in an HTML table
echo "<table>";
echo "<tr><th colspan='4' style='border-bottom: 3px solid white; font-size: 30px;'>Оборудование</th>
<th colspan='3' style='border-bottom: 3px solid white; font-size: 30px;'>Документы</th>
<th colspan='6' style='border-bottom: 3px solid white; font-size: 30px;'>Паспорт</th></tr>";

echo "<tr>
<th class='table_title' >Тип оборудования</th>
<th class='table_title' ;>Дата установки</th>
<th class='table_title' >Дата последнего обслуживания</th>
<th class='table_title' >Статус</th>
<th class='table_title' >Тип документа</th>
<th class='table_title' >Номер документа</th>
<th class='table_title' >Дата выдачи</th>
<th class='table_title' >Кем выдан</th>
<th class='table_title' >ФИО</th>
<th class='table_title' >Дата рождения</th>
<th class='table_title' >Номер паспорта</th>
<th class='table_title' >Адрес</th>
<th class='table_title' >Орган выдачи</th></tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='table_content-view_oferta'>" . $row['equipment_type'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['installation_date'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['last_maintenance_date'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['status'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['document_type'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['document_number'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['date_of_issue'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['issued_by'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['full_name'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['date_of_birth'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['passport_number'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['address'] . "</td>";
        echo "<td class='table_content-view_oferta'>" . $row['issuing_authority'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}
echo "</table>";

// Close connection
$conn->close();
?>

</div>
</body>
</html>
