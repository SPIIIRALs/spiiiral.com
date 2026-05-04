<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Форма регистрации</h2>
        <form action="action.php" method="post">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" placeholder="Введите имя" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="example@mail.com" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" placeholder="Минимум 6 символов" required>

            <label for="gender">Пол:</label>
            <select id="gender" name="gender">
                <option value="male">Мужской</option>
                <option value="female">Женский</option>
                <option value="other">Другой</option>
            </select>

            <label>
                <input type="checkbox" name="agree" required> Я согласен с условиями
            </label>

            <input type="submit" value="Зарегистрироваться">
        </form>
    </div>
</body>
</html>
