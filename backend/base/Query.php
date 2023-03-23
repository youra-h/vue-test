<?

namespace base;

use PDOStatement;

class Query {

    private PDOStatement $_query;
    /**
     * Парамтеры SQL запроса
     */
    private array $_params = [];

    /**
     * @return PDO
     */
    private function pdo()
    {
        return App::id()->db->getHandler();
    }

    /**
     * Добавить запрос
     * @param string $sql
     * @return self
     */
    public function query(string $sql): Query
    {
        $this->_query = $this->pdo()->prepare($sql);

        return $this;
    }

    /**
     * Связать параметры запроса
     * @param array $params
     * @return self
     */
    public function bind(array $params): Query
    {
        $this->_params = $params;        

        return $this;
    }

    /**
     * Выполнить запрос
     * @return bool
     */
    public function execute(): bool
    {
        foreach ($this->_params as $key => $value) {
            $key = ":$key";            
            $this->_query->bindValue($key, $value);
        }

        // dump($this->_query->queryString);
        // exit;

        return $this->_query->execute();
    }

    /**
     * Вернуть массив с данными
     * @return array|false
     */
    public function one(): array | false
    {
        return $this->execute() ? $this->_query->fetch() : false;
    }

    /**
     * Вернуть несколько записей в виде массива
     * @return array|false
     */
    public function all(): array | false
    {
        return $this->execute() ? $this->_query->fetchAll() : false;
    }
}