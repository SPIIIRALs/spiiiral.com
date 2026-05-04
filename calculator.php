<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Калькулятор</h2>
        <form method="post">
            <label>Число 1:</label>
            <input type="number" step="any" name="num1" required value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : ''; ?>">

            <label>Число 2:</label>
            <input type="number" step="any" name="num2" required value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : ''; ?>">

            <div style="display: flex; gap: 10px; margin: 15px 0;">
                <button type="submit" name="operation" value="add">+</button>
                <button type="submit" name="operation" value="sub">-</button>
                <button type="submit" name="operation" value="mul">*</button>
                <button type="submit" name="operation" value="div">/</button>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation'])) {
            $num1 = (float)$_POST['num1'];
            $num2 = (float)$_POST['num2'];
            $op = $_POST['operation'];
            $result = null;
            $error = null;

            switch ($op) {
                case 'add':
                    $result = $num1 + $num2;
                    break;
                case 'sub':
                    $result = $num1 - $num2;
                    break;
                case 'mul':
                    $result = $num1 * $num2;
                    break;
                case 'div':
                    if ($num2 == 0) {
                        $error = "Ошибка: деление на ноль!";
                    } else {
                        $result = $num1 / $num2;
                    }
                    break;
                default:
                    $error = "Неизвестная операция";
            }

            if ($error) {
                echo "<p style='color: red;'>$error</p>";
            } else {
                echo "<p style='color: green;'>Результат: $result</p>";
            }
        }
        ?>
        <p><a href="index.php">Вернуться к регистрации</a></p>
    </div>
</body>
</html>