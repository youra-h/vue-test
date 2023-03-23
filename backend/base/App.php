<?php

namespace base;

use helper\ArrayHelper;

final class App {

    /**
     * @var App экземпляр объекта
     */
    private static $instance;
    /**
     * @var array Конфиг приложения
     */
    private array $config = [];
    /**
     * @var Request Объект содержит query параметры
     */
    public Request $request;
    /**
     * @var UrlManager
     */
    public UrlManager $urlManager;
    /**
     * @var Connection $db Подключение к бд
     */
    public Connection $db;
    /**
     * @var Mailer
     */
    public Mailer $mailer;

    private function __construct(array $config = [])
    {        
        $this->config = $config;

        $this->request = new Request();
        $this->urlManager = new UrlManager();

        $dbc = ArrayHelper::getValue($config, 'db', []);

        $this->db = new Connection($dbc);

        $mailc = ArrayHelper::getValue($config, 'mailer', []);

        $this->mailer = new Mailer($mailc);
    }

    /**
     * Запустить приложение
     */
    public function run(): void
    {
        echo $this->urlManager->response();
    }

    /**
     * Вернуть экземпляр
     * @return App
     */
    public static function id(): App
    {
        return self::$instance;
    }

    /**
     * Создать экземпляр
     * @param array $config
     * @return App
     */
    public static function create(array $config = []): App
    {
        if (!self::$instance) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }
}