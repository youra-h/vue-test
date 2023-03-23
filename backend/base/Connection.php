<?

namespace base;

use PDO;
use Exception;
use PDOException;

class Connection {
    /**
     * @var array Параметры подключения
     */
    private array $config = [];
    /**
     * @var PDO Линк подключения
     */
    private PDO $handler;

    public function __construct(array $config)
    {
        $this->config = $config;

        $this->connect();
    }

    /**
     * Выполнить соединение с БД
     * @return bool
     */
    public function connect(): bool
    {
        try {

            $this->handler = new PDO($this->config['dsn'], $this->config['username'], $this->config['password']);

        } catch (PDOException $e) {
            throw new Exception("Error!: " . $e->getMessage());
        }

        return true;
    }

    /**
     * @return PDO
     */
    public function getHandler(): PDO
    {
        return $this->handler;
    }

    /**
     * Выполнить запрос
     * @param string $sql запрос
     * @return PDOStatement
     */
    public function query(string $sql)
    {
        return $this->handler->query($sql);
    }
}