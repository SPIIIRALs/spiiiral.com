<?php
/**
 * Лабораторная работа №12
 * Обработка исключений и работа с датами
 */

echo "<h1>Результаты лабораторной работы №12</h1>";

// ----------------------------------------------------------------------
// Часть 1: Обработка исключений
// ----------------------------------------------------------------------
echo "<h2>Часть 1: Исключения</h2>";

// 1. Обработчик ошибки открытия несуществующего файла (fopen)
echo "<h3>1. Открытие несуществующего файла</h3>";
try {
    $file = fopen("non_existent_file.txt", "r");
    if (!$file) {
        throw new Exception("Не удалось открыть файл 'non_existent_file.txt'");
    }
    fclose($file);
} catch (Exception $e) {
    echo "Исключение: " . $e->getMessage() . "<br>";
}

// 2. Обработчик деления на ноль + запись в log.txt
echo "<h3>2. Деление на ноль (с записью в log.txt)</h3>";
function divide($a, $b) {
    if ($b == 0) {
        throw new Exception("Ошибка: деление на ноль. Аргументы: a=$a, b=$b");
    }
    return $a / $b;
}

try {
    $result = divide(10, 0);
    echo "Результат деления: $result<br>";
} catch (Exception $e) {
    $errorMsg = date('Y-m-d H:i:s') . " - " . $e->getMessage() . PHP_EOL;
    file_put_contents('log.txt', $errorMsg, FILE_APPEND);
    echo "Исключение: " . $e->getMessage() . " (сообщение записано в log.txt)<br>";
}

// 3. Обработчик доступа к несуществующему элементу массива
echo "<h3>3. Доступ к несуществующему элементу массива</h3>";
$countries = ['Spain' => 'Madrid', 'Russia' => 'Moscow'];
$countryToFind = 'Germany';

try {
    if (!array_key_exists($countryToFind, $countries)) {
        throw new Exception("Страна '$countryToFind' отсутствует в массиве");
    }
    echo "Столица $countryToFind: " . $countries[$countryToFind] . "<br>";
} catch (Exception $e) {
    echo "Исключение: " . $e->getMessage() . "<br>";
}

// ----------------------------------------------------------------------
// Часть 2: Работа с датами
// ----------------------------------------------------------------------
echo "<h2>Часть 2: Даты</h2>";

// 1. Вывести 15 марта 2025 года, 10:25:00 в формате timestamp
echo "<h3>1. Timestamp для 15 марта 2025 10:25:00</h3>";
$timestamp1 = mktime(10, 25, 0, 3, 15, 2025);
echo $timestamp1 . " (проверка: " . date('Y-m-d H:i:s', $timestamp1) . ")<br>";

// 2. Разница между 2 октября 1990 08:05:59 и текущим моментом (секунды)
echo "<h3>2. Разница между 1990-10-02 08:05:59 и сейчас</h3>";
$datePast = mktime(8, 5, 59, 10, 2, 1990);
$now = time();
$diffSeconds = $now - $datePast;
echo "Разница в секундах: $diffSeconds<br>";

// 3. Текущая дата-время в формате 'Год.месяц.день Час:Минута:Секунда'
echo "<h3>3. Текущая дата в формате 'Год.месяц.день Час:Минута:Секунда'</h3>";
echo date('Y.m.d H:i:s') . "<br>";

// 4. 1-е сентября текущего года в формате 'Год.месяц.день'
echo "<h3>4. 1 сентября текущего года</h3>";
$sepFirst = mktime(0, 0, 0, 9, 1, date('Y'));
echo date('Y.m.d', $sepFirst) . "<br>";

// 5. День недели (словом) для 2 февраля 2000 года
echo "<h3>5. День недели 2 февраля 2000 года</h3>";
$date2000 = mktime(0, 0, 0, 2, 2, 2000);
$weekDays = ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'];
$dayOfWeek = date('w', $date2000); // 0 - вс, 1 - пн ...
echo "2 февраля 2000 года - " . $weekDays[$dayOfWeek] . "<br>";

// 6. Массив дней недели + текущий день + день рождения
echo "<h3>6. Названия дней недели</h3>";
$week = [
    0 => 'воскресенье',
    1 => 'понедельник',
    2 => 'вторник',
    3 => 'среда',
    4 => 'четверг',
    5 => 'пятница',
    6 => 'суббота'
];
$currentDayNum = date('w');
echo "Сегодня: " . $week[$currentDayNum] . "<br>";

// Предположим, день рождения 12.06.1998 (измените на свою дату)
$birthday = mktime(0, 0, 0, 6, 12, 1998);
$birthdayDayNum = date('w', $birthday);
echo "День рождения (12.06.1998) был: " . $week[$birthdayDayNum] . "<br>";

// 7. Форма для сравнения двух дат
echo "<h3>7. Сравнение двух дат</h3>";
?>
<form method="post">
    <label>Дата 1 (2025-12-31): <input type="date" name="date1" required></label><br>
    <label>Дата 2 (2025-12-31): <input type="date" name="date2" required></label><br>
    <input type="submit" value="Сравнить">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date1']) && isset($_POST['date2'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    $timestampDate1 = strtotime($date1);
    $timestampDate2 = strtotime($date2);
    if ($timestampDate1 === false || $timestampDate2 === false) {
        echo "Ошибка в формате даты.<br>";
    } else {
        if ($timestampDate1 > $timestampDate2) {
            echo "Первая дата ($date1) больше второй ($date2)<br>";
        } elseif ($timestampDate1 < $timestampDate2) {
            echo "Вторая дата ($date2) больше первой ($date1)<br>";
        } else {
            echo "Даты равны<br>";
        }
    }
}

// 8. Преобразование даты 'Год-месяц-день' в 'день-месяц-год' через strtotime и date
echo "<h3>8. Преобразование формата даты</h3>";
$inputDate = '2025-12-31';
$timestamp = strtotime($inputDate);
$outputDate = date('d-m-Y', $timestamp);
echo "Исходная: $inputDate → Преобразованная: $outputDate<br>";

// 9. Манипуляции с датой '2000.02.03'
echo "<h3>9. Прибавление/вычитание к дате 2000.02.03</h3>";
$dateObj = date_create('2000-02-03');
date_modify($dateObj, '+2 days');
date_modify($dateObj, '+1 month');
date_modify($dateObj, '+3 days');
date_modify($dateObj, '+1 year');
date_modify($dateObj, '-3 days');
echo "Результат: " . date_format($dateObj, 'd.m.Y') . "<br>";

// 10. Сколько дней осталось до Нового Года
echo "<h3>10. Дней до Нового Года</h3>";
$nowTime = time();
$nextYear = date('Y') + 1;
$newYear = mktime(0, 0, 0, 1, 1, $nextYear);
$diffDays = ceil(($newYear - $nowTime) / (60 * 60 * 24));
echo "До Нового года осталось $diffDays дней.<br>";
?>
