<?php
/**
 * Лабораторная работа №13
 * Объекты (классы, свойства, методы, конструктор, инкапсуляция)
 */

echo "<h1>Результаты лабораторной работы №13</h1>";

// ----------------------------------------------------------------------
// 1. Создайте класс Employee (работник) со свойствами name, age, salary.
//    Создайте 2 объекта, установите свойства своими значениями.
// ----------------------------------------------------------------------
class Employee {
    // Свойства (по заданию 7 age сделаем скрытым, пока public, позже изменим)
    public $name;
    public $age;      // станет private после задания 7
    public $salary;

    // Конструктор для удобства (необязательно, но полезно)
    public function __construct($name, $age, $salary) {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
    }

    // 3. Метод getName, возвращающий имя
    public function getName() {
        return $this->name;
    }

    // 4. Метод getAge, возвращающий возраст
    public function getAge() {
        return $this->age;
    }

    // 5. Метод getSalary, возвращающий зарплату
    public function getSalary() {
        return $this->salary;
    }

    // 6. (Модификация) Статический метод для суммы зарплат массива работников
    public static function getTotalSalary($employees) {
        $total = 0;
        foreach ($employees as $emp) {
            $total += $emp->getSalary();
        }
        return $total;
    }

    // 7. Метод setAge (приватное свойство age пока не сделали, но по заданию нужно сделать age скрытым)
    //    Сначала изменим свойство age на private (в классе выше поменяем).
    //    Для совместимости с уже созданными объектами перепишем класс:
    //    я переопределю класс ниже с учетом инкапсуляции.
}

// Поскольку в задании 7 требуется сделать age скрытым, пересоздадим класс с private $age
class EmployeeFinal {
    private $name;
    private $age;
    private $salary;

    public function __construct($name, $age, $salary) {
        $this->name = $name;
        $this->setAge($age);   // используем setter для валидации
        $this->salary = $salary;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getSalary() {
        return $this->salary;
    }

    // 7. Метод setAge (принимает новый возраст)
    // 8. Проверка, что возраст >= 18
    public function setAge($newAge) {
        if ($newAge >= 18) {
            $this->age = $newAge;
            return true;
        } else {
            echo "Вам работать в нашей компании еще рано.<br>";
            return false;
        }
    }

    // 9. Метод checkAge (проверяет, что работнику больше 18 лет)
    public function checkAge() {
        return $this->age >= 18;
    }

    // 10. Приватный метод checkAgePrivate и публичный setAgeWithCheck
    private function checkAgePrivate($age) {
        return $age >= 18;
    }

    public function setAgeWithCheck($newAge) {
        if ($this->checkAgePrivate($newAge)) {
            $this->age = $newAge;
            echo "Возраст успешно изменён на $newAge.<br>";
        } else {
            echo "Вам работать в нашей компании еще рано.<br>";
        }
    }
}

// ----------------------------------------------------------------------
// Демонстрация заданий 1-2 (создание объектов, сумма зарплат и возрастов)
// ----------------------------------------------------------------------
echo "<h2>Задания 1-2: создание двух работников, сумма зарплат и возрастов</h2>";

// Используем первый класс Employee (со public свойствами) для первых двух заданий,
// чтобы не усложнять. Но для последующих заданий будем использовать EmployeeFinal.
$emp1 = new Employee("Иван Петров", 25, 50000);
$emp2 = new Employee("Мария Сидорова", 30, 60000);

echo "Работник 1: {$emp1->getName()}, возраст {$emp1->getAge()}, зарплата {$emp1->getSalary()}<br>";
echo "Работник 2: {$emp2->getName()}, возраст {$emp2->getAge()}, зарплата {$emp2->getSalary()}<br>";

$totalSalary = $emp1->getSalary() + $emp2->getSalary();
$totalAge = $emp1->getAge() + $emp2->getAge();
echo "Сумма зарплат: $totalSalary<br>";
echo "Сумма возрастов: $totalAge<br><br>";

// ----------------------------------------------------------------------
// Задание 3: метод getName
// ----------------------------------------------------------------------
echo "<h2>Задание 3: getName</h2>";
echo "Имя первого работника: " . $emp1->getName() . "<br><br>";

// ----------------------------------------------------------------------
// Задание 4: метод getAge
// ----------------------------------------------------------------------
echo "<h2>Задание 4: getAge</h2>";
echo "Возраст второго работника: " . $emp2->getAge() . "<br><br>";

// ----------------------------------------------------------------------
// Задание 5: метод getSalary
// ----------------------------------------------------------------------
echo "<h2>Задание 5: getSalary</h2>";
echo "Зарплата первого работника: " . $emp1->getSalary() . "<br><br>";

// ----------------------------------------------------------------------
// Задание 6: изменить getSalary, чтобы находить сумму зарплат (сделали статический метод)
// ----------------------------------------------------------------------
echo "<h2>Задание 6: сумма зарплат через метод</h2>";
$employeesArray = [$emp1, $emp2];
$totalSalaryViaMethod = Employee::getTotalSalary($employeesArray);
echo "Сумма зарплат (через статический метод): $totalSalaryViaMethod<br><br>";

// ----------------------------------------------------------------------
// Задания 7-8: переходим на EmployeeFinal с private age и setAge с проверкой
// ----------------------------------------------------------------------
echo "<h2>Задания 7-8: установка возраста через setAge с проверкой >=18</h2>";
$emp3 = new EmployeeFinal("Алексей Дмитриев", 20, 70000);
echo "Исходный возраст: " . $emp3->getAge() . "<br>";
$emp3->setAge(17); // должно выдать сообщение "Вам работать рано"
echo "После попытки установить 17: возраст остался " . $emp3->getAge() . "<br>";
$emp3->setAge(25);
echo "После установки 25: возраст " . $emp3->getAge() . "<br><br>";

// ----------------------------------------------------------------------
// Задание 9: метод checkAge
// ----------------------------------------------------------------------
echo "<h2>Задание 9: checkAge</h2>";
$emp4 = new EmployeeFinal("Ольга Смирнова", 22, 45000);
echo "Работнику {$emp4->getName()} больше 18? " . ($emp4->checkAge() ? "Да" : "Нет") . "<br>";
$emp5 = new EmployeeFinal("Николай Малолетний", 16, 10000);
echo "Работнику {$emp5->getName()} больше 18? " . ($emp5->checkAge() ? "Да" : "Нет") . "<br><br>";

// ----------------------------------------------------------------------
// Задание 10: приватный checkAgePrivate и публичный setAgeWithCheck
// ----------------------------------------------------------------------
echo "<h2>Задание 10: приватная проверка возраста и публичный setter</h2>";
$emp6 = new EmployeeFinal("Екатерина Зайцева", 19, 55000);
echo "Текущий возраст: " . $emp6->getAge() . "<br>";
$emp6->setAgeWithCheck(15);  // должно отказать
$emp6->setAgeWithCheck(30);  // должно принять
echo "После вызова setAgeWithCheck: возраст " . $emp6->getAge() . "<br>";

?>
