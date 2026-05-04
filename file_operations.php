<?php
/**
 * Лабораторная работа №11
 * Работа с файлами и папками в PHP
 */

echo "<h1>Результаты лабораторной работы №11</h1>";

// Чтобы видеть все ошибки и предупреждения
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ----------------------------------------------------------------------
// Часть 1: работа с файлами
// ----------------------------------------------------------------------
echo "<h2>Часть 1: Файлы</h2>";

// 1. Создайте файл 'test.txt' и запишите в него фразу 'Привет, мир!'.
$fileName = 'test.txt';
$content = 'Привет, мир!';
file_put_contents($fileName, $content);
echo "1. Файл '$fileName' создан и записана фраза: '$content'<br>";

// 2. Считайте данные из файла 'test.txt' и выведите их на экран.
$readContent = file_get_contents($fileName);
echo "2. Содержимое файла '$fileName': $readContent<br>";

// 3. Переименуйте файл 'test.txt' в 'mir.txt'.
$newFileName = 'mir.txt';
if (rename($fileName, $newFileName)) {
    echo "3. Файл '$fileName' переименован в '$newFileName'<br>";
} else {
    echo "3. Ошибка переименования файла<br>";
}

// 4. Создайте папку 'folder' и переместите файл 'mir.txt' в эту папку.
$folderName = 'folder';
if (!is_dir($folderName)) {
    mkdir($folderName);
    echo "4. Папка '$folderName' создана<br>";
}
$oldPath = $newFileName;
$newPath = $folderName . DIRECTORY_SEPARATOR . $newFileName;
if (rename($oldPath, $newPath)) {
    echo "4. Файл '$oldPath' перемещён в '$newPath'<br>";
} else {
    echo "4. Ошибка перемещения файла<br>";
}

// 5. Создайте копию файла 'mir.txt' и назовите ее 'world.txt'.
$copyName = 'world.txt';
$copyPath = $folderName . DIRECTORY_SEPARATOR . $copyName;
if (copy($newPath, $copyPath)) {
    echo "5. Создана копия файла '$newPath' -> '$copyPath'<br>";
} else {
    echo "5. Ошибка копирования файла<br>";
}

// 6. Определите размер файла 'world.txt'. Выведите в байтах, МБ, ГБ.
if (file_exists($copyPath)) {
    $sizeBytes = filesize($copyPath);
    $sizeMB = round($sizeBytes / (1024 * 1024), 4);
    $sizeGB = round($sizeBytes / (1024 * 1024 * 1024), 8);
    echo "6. Размер файла '$copyPath':<br>";
    echo "   - $sizeBytes байт<br>";
    echo "   - $sizeMB МБ<br>";
    echo "   - $sizeGB ГБ<br>";
} else {
    echo "6. Файл '$copyPath' не найден<br>";
}

// 7. Удалите файл 'world.txt'.
if (unlink($copyPath)) {
    echo "7. Файл '$copyPath' удалён<br>";
} else {
    echo "7. Ошибка удаления файла '$copyPath'<br>";
}

// 8. Проверьте существование файлов 'world.txt' и 'mir.txt'.
$checkFile1 = $copyPath;
$checkFile2 = $newPath; // mir.txt в папке folder
echo "8. Проверка существования файлов:<br>";
echo "   - '$checkFile1': " . (file_exists($checkFile1) ? "существует" : "НЕ существует") . "<br>";
echo "   - '$checkFile2': " . (file_exists($checkFile2) ? "существует" : "НЕ существует") . "<br>";

// ----------------------------------------------------------------------
// Часть 2: работа с папками и поиск файлов
// ----------------------------------------------------------------------
echo "<h2>Часть 2: Папки и поиск</h2>";

// 1. Создайте папку 'test'.
$testFolder = 'test';
if (!is_dir($testFolder)) {
    mkdir($testFolder);
    echo "1. Папка '$testFolder' создана<br>";
} else {
    echo "1. Папка '$testFolder' уже существует<br>";
}

// 2. Переименуйте папку 'test' на 'www'.
$wwwFolder = 'www';
if (rename($testFolder, $wwwFolder)) {
    echo "2. Папка '$testFolder' переименована в '$wwwFolder'<br>";
} else {
    echo "2. Ошибка переименования папки<br>";
}

// 3. Удалите папку 'www' (она должна быть пустой).
if (is_dir($wwwFolder)) {
    // Проверим, пуста ли папка
    $files = array_diff(scandir($wwwFolder), array('.', '..'));
    if (empty($files)) {
        if (rmdir($wwwFolder)) {
            echo "3. Папка '$wwwFolder' удалена<br>";
        } else {
            echo "3. Не удалось удалить папку '$wwwFolder'<br>";
        }
    } else {
        echo "3. Папка '$wwwFolder' не пуста, удаление отменено. Содержимое: " . implode(', ', $files) . "<br>";
    }
} else {
    echo "3. Папка '$wwwFolder' не существует, удаление не требуется<br>";
}

// 4. Дан массив со строками. Создайте в папке 'test' папки с названиями из массива.
$folderArray = ['folder1', 'folder2', 'subfolder_A', 'data'];
$baseFolder = 'test';
if (!is_dir($baseFolder)) {
    mkdir($baseFolder);
    echo "4. Создана базовая папка '$baseFolder'<br>";
}
foreach ($folderArray as $subFolder) {
    $path = $baseFolder . DIRECTORY_SEPARATOR . $subFolder;
    if (!is_dir($path)) {
        mkdir($path);
        echo "   - создана папка '$path'<br>";
    } else {
        echo "   - папка '$path' уже существует<br>";
    }
}
echo "4. Все папки из массива созданы в '$baseFolder'<br>";

// 5. Выведите все файлы с расширением jpg из текущей папки.
//    (Для демонстрации создадим несколько .jpg файлов, если их нет)
$currentDir = __DIR__; // текущая директория скрипта
// Создадим тестовые jpg-файлы (пустые), если их нет
$testJpg = ['test1.jpg', 'photo.jpg', 'image.jpg'];
foreach ($testJpg as $jpg) {
    $jpgPath = $currentDir . DIRECTORY_SEPARATOR . $jpg;
    if (!file_exists($jpgPath)) {
        file_put_contents($jpgPath, ''); // создаём пустой файл
    }
}
echo "5. Файлы с расширением .jpg в текущей папке:<br>";
$jpgFiles = glob($currentDir . DIRECTORY_SEPARATOR . '*.jpg');
if (!empty($jpgFiles)) {
    foreach ($jpgFiles as $file) {
        echo "   - " . basename($file) . " (размер: " . filesize($file) . " байт)<br>";
    }
} else {
    echo "   - Файлы .jpg не найдены<br>";
}

// Дополнительно: уберём созданные тестовые jpg, чтобы не засорять (по желанию)
// foreach ($testJpg as $jpg) { @unlink($currentDir . DIRECTORY_SEPARATOR . $jpg); }

echo "<hr>";
echo "<p>Выполнение заданий завершено. Не забудьте проверить созданные папки и файлы в директории сайта.</p>";
?>
