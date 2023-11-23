<?php
// Проверка ключа в URL
if (!isset($_GET['admin_key']) || $_GET['admin_key'] !== '1234') {
    echo "Доступ запрещен!";
    exit();
}
// Подключение к БД
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// Код обработки отправленной формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Проверка пароля и его подтверждения
    if ($password != $confirm_password) {
        echo "Пароли не совпадают";
    } else {
        // Хеширование пароля
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Добавление пользователя в базу данных
        $sql = "INSERT INTO Users (login, password) VALUES ('$login', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Пользователь успешно добавлен";
        } else {
            echo "Ошибка при добавлении пользователя: " . $conn->error;
        }
    }
}
// Закрытие соединения с БД
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="CSS/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="content">
         <div class="text">
            Добавление нового пользователя
         </div>
         <form action="admin.php?admin_key=1234" method="post">
    <div class="field">
        <input type="text" name="login" required>
        <span class="fas fa-user"></span>
        <label>Логин</label>
    </div>
    <div class="field">
        <input type="password" name="password" required>
        <span class="fas fa-lock"></span>
        <label>Пароль</label>
    </div>
    <div class="field">
        <input type="password" name="confirm_password" required>
        <span class="fas fa-lock"></span>
        <label>Повторите пароль</label>
    </div>
    <button type="submit" class="enter">Добавить пользователя</button>
</form>
      </div>
   </body>
   <script src="JS/script.js"></script>
</html>
