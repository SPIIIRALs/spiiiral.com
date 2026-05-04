<?php
/**
 * Лабораторная работа №14
 * GET-параметры, классы, наследование, модификаторы доступа, типы данных
 */

// ----------------------------------------------------------------------
// 1. Класс Page с приватными свойствами name и template
// ----------------------------------------------------------------------
class Page {
    private string $name;
    private string $template;

    // Конструктор задаёт значения по умолчанию (п.1)
    public function __construct(string $name = 'page', string $template = '<div><p>It is a default page</p></div>') {
        $this->name = $name;
        $this->template = $template;
    }

    // 2. Метод render выводит содержимое template
    public function render(): void {
        echo $this->template;
    }

    // Геттер для name (может пригодиться)
    public function getName(): string {
        return $this->name;
    }
}

// ----------------------------------------------------------------------
// 3. Класс BlogPage наследует Page, переопределяет name и template
//    (используются заглушки вместо реальных изображений)
// ----------------------------------------------------------------------
class BlogPage extends Page {
    public function __construct() {
        // Шаблон с тремя карточками, каждая содержит блок "Image N"
        $cards = '
        <style>
            .blog-container {
                display: flex;
                gap: 20px;
                flex-wrap: wrap;
                justify-content: center;
                margin-top: 20px;
            }
            .card {
                border: 1px solid #ccc;
                border-radius: 8px;
                padding: 15px;
                width: 250px;
                text-align: center;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .card-image {
                width: 100%;
                height: 150px;
                background: #e0e0e0;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 8px;
                font-size: 18px;
                color: #555;
            }
            .card h3 {
                margin: 10px 0;
            }
            .card p {
                color: #666;
            }
        </style>
        <div class="blog-container">
            <div class="card">
                <div class="card-image">Image 1</div>
                <h3>Заголовок карточки 1</h3>
                <p>Какой-то текст описания первой карточки.</p>
            </div>
            <div class="card">
                <div class="card-image">Image 2</div>
                <h3>Заголовок карточки 2</h3>
                <p>Какой-то текст описания второй карточки.</p>
            </div>
            <div class="card">
                <div class="card-image">Image 3</div>
                <h3>Заголовок карточки 3</h3>
                <p>Какой-то текст описания третьей карточки.</p>
            </div>
        </div>
        ';
        parent::__construct('blog', $cards);
    }
}

// ----------------------------------------------------------------------
// 4. Две ссылки вне классов (главная страница)
// ----------------------------------------------------------------------
echo '<h1>Лабораторная работа №14</h1>';
echo '<div style="margin-bottom: 20px;">';
echo '<a href="?page=page" style="margin-right: 15px;">📄 Страница по умолчанию</a>';
echo '<a href="?page=blog">📰 Блог (карточки)</a>';
echo '</div>';

// ----------------------------------------------------------------------
// 5. Проверка GET-параметра и отображение нужной страницы
// ----------------------------------------------------------------------
if (isset($_GET['page']) && $_GET['page'] === 'blog') {
    $page = new BlogPage();
} else {
    $page = new Page();   // страница по умолчанию
}

// Вызываем метод render для вывода содержимого
$page->render();

// ----------------------------------------------------------------------
// 6. Типы данных и модификаторы доступа уже учтены:
//    - свойства private, typed (string)
//    - методы public с указанием возвращаемого типа (:void, :string)
//    - конструктор с типами аргументов
// ----------------------------------------------------------------------
?>
