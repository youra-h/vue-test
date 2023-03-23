<?

namespace base;

use Exception;

class UrlManager {
    const SERVER_KEY = 'REDIRECT_URL';

    public string $pathController = 'controller';
    /**
     * @var string Наименование контроллера
     */
    private string $controller;
    /**
     * @var string Наименование действия
     */
    private string $action;

    public function __construct()
    {
        $this->parse();
    }

    /**
     * Разобрать путь url
     */
    private function parse(): void
    {
        $url = $this->getUrl();
        // отделить query часть
        $parts = explode('?', $url);
        
        $url = $parts[0];
        // разбить на части запрос url
        $parts = explode('/', $url);

        if (empty($parts[0])) {
            array_splice($parts, 0, 1);
        }

        if (count($parts) < 2) {
            throw new Exception("Некорректный Url");            
        }

        $this->controller = $parts[0];
        $this->action = $parts[1];
    }

    /**
     * Вернуть текущий url
     * @return string
     */
    public function getUrl(): string
    {
        return $_SERVER[self::SERVER_KEY];
    }

    /**
     * Вернуть класс контроллера
     * @return string
     */
    private function getClassController(): string
    {
        $class = "$this->pathController\\" . ucfirst($this->controller) . "Controller";

        if (!class_exists($class)) {
            throw new Exception("Ненайден контроллер: $class");            
        }

        return $class;
    }

    /**
     * Вернуть метод исполнения
     * @return string
     */
    private function getAction(): string
    {
        $classController = $this->getClassController();

        $method = "action" . ucfirst($this->action);

        if (!method_exists($classController, $method)) {
            throw new Exception("Метод в контроллере ненайден: $method");            
        }

        return $method;
    }

    /**
     * Получить ответ от контроллера
     * @return mixed
     */
    public function response(): mixed
    {
        $classController = $this->getClassController();
        $method = $this->getAction();

        $controller = new $classController();

        $result = $controller->$method();

        return Response::send($result);
    }
}