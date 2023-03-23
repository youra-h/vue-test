<?

namespace models;

use Exception;
use base\Query;

abstract class Model {

    protected ?int $id = null;

    abstract public static function tableName(): string;

    /**
     * Загрузить данные в объект из БД
     * @return static|bool
     */
    public static function load(array $search): static | bool
    {                
        $f = array_map(fn($value) => "$value=:$value", array_keys($search));
        $f = implode(' and ', $f);

        $sql = "select * from " . static::tableName() . " where $f";

        $data = (new Query())
            ->query($sql)
            ->bind($search)
            ->one();

        if (!$data) {
            return false;
        }

        $instance = new static();

        foreach ($data as $key => $value) {
            if (!is_int($key) && !is_null($value)) {
                $instance->$key = $value;
            }
        }

        return $instance;
    }


    /**
     * Вернуть запрос для добавления пользователя
     * @return string
     */
    protected function insert(array $fields): string
    {
        $f = implode(',', $fields);
        $v = array_map(fn ($value) => ":$value", $fields);

        $v = implode(',', $v);

        return "insert into " . static::tableName() . "($f) values($v)";
    }

    /**
     * Вернуть запрос для обновления данных пользователя
     * @param array $fields
     * @return string
     */
    protected function update(array $fields): string
    {
        $f = array_map(fn ($value) => "$value=:$value", $fields);
        $f = implode(',', $f);        

        return "UPDATE " . static::tableName() . " SET $f WHERE id=$this->id";
    }

    /**
     * Проверка на корректность добавляемых данных
     * @return bool
     */
    public function validate(): bool
    {
        return true;
    }

    /**
     * Подготовить данные
     */
    protected function prepareValues(array $fields): array
    {
        return $fields;
    }

    /**
     * Обновить данные пользователя
     * @return bool
     */
    public function save(array $fields = []): bool
    {
        if (!$this->validate()) {
            throw new Exception("Данные некорректны");            
        }

        $fields = $this->prepareValues($fields);

        if (isset($this->id)) {
            $sql = $this->update($fields);
        } else {
            $sql = $this->insert($fields);
        }

        $params = [];        

        foreach ($fields as $value) {
            $params[$value] = $this->$value;
        }

        $result = (new Query())
            ->query($sql)
            ->bind($params)
            ->execute();

        if (!$result) {
            throw new Exception("Невышло обновить запись в БД");
        }

        return true;
    }
}