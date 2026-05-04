<?php
/**
 * Лабораторная работа №15
 * Абстрактные классы, наследование, интерфейсы
 */

// ----------------------------------------------------------------------
// 1. Абстрактный класс Figure
// ----------------------------------------------------------------------
abstract class Figure {
    // Свойства: площадь, цвет, количество сторон
    protected float $area;
    protected string $color;
    protected int $sidesCount;

    // 2. Абстрактный метод infoAbout()
    abstract public function infoAbout(): string;

    // Геттер для площади (может пригодиться)
    public function getArea(): float {
        return $this->area;
    }
}

// ----------------------------------------------------------------------
// 3. Интерфейс с методом getArea
// ----------------------------------------------------------------------
interface AreaCalculable {
    public function getArea(): float;
}

// ----------------------------------------------------------------------
// 4. Класс Rectangle (прямоугольник)
// ----------------------------------------------------------------------
class Rectangle extends Figure implements AreaCalculable {
    private float $a;  // длина
    private float $b;  // ширина

    // 7. Количество сторон
    private const SIDES_COUNT = 4;

    // 8. Конструктор
    public function __construct(float $a, float $b, string $color = 'не задан') {
        $this->a = $a;
        $this->b = $b;
        $this->color = $color;
        $this->sidesCount = self::SIDES_COUNT;
        $this->area = $this->getArea(); // сразу считаем площадь
    }

    // 9. Реализация getArea()
    public function getArea(): float {
        return $this->a * $this->b;
    }

    // 10. Реализация infoAbout()
    public function infoAbout(): string {
        return "Это класс прямоугольника. У него {$this->sidesCount} стороны.";
    }
}

// ----------------------------------------------------------------------
// 5. Класс Square (квадрат)
// ----------------------------------------------------------------------
class Square extends Figure implements AreaCalculable {
    private float $a;  // сторона

    private const SIDES_COUNT = 4;

    public function __construct(float $a, string $color = 'не задан') {
        $this->a = $a;
        $this->color = $color;
        $this->sidesCount = self::SIDES_COUNT;
        $this->area = $this->getArea();
    }

    public function getArea(): float {
        return $this->a * $this->a;
    }

    public function infoAbout(): string {
        return "Это класс квадрата. У него {$this->sidesCount} стороны.";
    }
}

// ----------------------------------------------------------------------
// 6. Класс Triangle (треугольник) – используем формулу Герона
// ----------------------------------------------------------------------
class Triangle extends Figure implements AreaCalculable {
    private float $a, $b, $c; // стороны

    private const SIDES_COUNT = 3;

    public function __construct(float $a, float $b, float $c, string $color = 'не задан') {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->color = $color;
        $this->sidesCount = self::SIDES_COUNT;
        $this->area = $this->getArea();
    }

    // 9. Площадь по формуле Герона
    public function getArea(): float {
        $p = ($this->a + $this->b + $this->c) / 2; // полупериметр
        return sqrt($p * ($p - $this->a) * ($p - $this->b) * ($p - $this->c));
    }

    public function infoAbout(): string {
        return "Это класс треугольника. У него {$this->sidesCount} стороны.";
    }
}

// ----------------------------------------------------------------------
// 11. Создаём по 2 объекта каждого класса
// ----------------------------------------------------------------------
$rect1 = new Rectangle(5, 10, 'красный');
$rect2 = new Rectangle(3, 4, 'синий');

$square1 = new Square(4, 'зелёный');
$square2 = new Square(7, 'жёлтый');

$tri1 = new Triangle(3, 4, 5, 'оранжевый');  // прямоугольный 3-4-5
$tri2 = new Triangle(5, 5, 6, 'фиолетовый'); // равнобедренный

// ----------------------------------------------------------------------
// 12. Вызываем getArea() и выводим результаты с информацией о фигуре
// ----------------------------------------------------------------------
echo "<h1>Лабораторная работа №15</h1>";

function displayFigureInfo(Figure $figure, string $name): void {
    echo "<div style='border:1px solid #ccc; margin:10px; padding:10px; border-radius:5px;'>";
    echo "<strong>$name</strong><br>";
    echo $figure->infoAbout() . "<br>";
    echo "Площадь: " . number_format($figure->getArea(), 2) . "<br>";
    echo "</div>";
}

echo "<h2>Прямоугольники</h2>";
displayFigureInfo($rect1, "Прямоугольник 1 (5x10)");
displayFigureInfo($rect2, "Прямоугольник 2 (3x4)");

echo "<h2>Квадраты</h2>";
displayFigureInfo($square1, "Квадрат 1 (сторона 4)");
displayFigureInfo($square2, "Квадрат 2 (сторона 7)");

echo "<h2>Треугольники</h2>";
displayFigureInfo($tri1, "Треугольник 1 (стороны 3,4,5)");
displayFigureInfo($tri2, "Треугольник 2 (стороны 5,5,6)");

?>
