<?php
// Валидация формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email)) {
        $errors[] = "Поле Email обязательно для заполнения.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Введите корректный email адрес.";
    }

    if (empty($password)) {
        $errors[] = "Поле Пароль обязательно для заполнения.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Пароль должен содержать минимум 6 символов.";
    }

    if (empty($errors)) {
        // Успешная регистрация – здесь можно сохранить данные в БД
        $message = "Регистрация успешна! Добро пожаловать, " . htmlspecialchars($_POST['name'] ?? '');
    } else {
        $message = "Ошибки валидации:<br>" . implode('<br>', $errors);
    }
} else {
    $message = "Форма не отправлена.";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результат регистрации</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Результат</h2>
        <p><?php echo $message; ?></p>
        <a href="index.php">Вернуться к форме</a>
    </div>
</body>
</html>
