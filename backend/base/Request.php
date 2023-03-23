<?

namespace base;

class Request
{
    private array $values = [];

    public function __construct()
    {
        $this->load($_POST);
        $this->load($this->getRawData());
    }

    /**
     * @return array
     */
    private function getRawData(): array
    {
        $request = file_get_contents('php://input');

        return $request ? json_decode($request, true) : [];
    }

    /**
     * Загрузить данные из POST     
     */
    private function load(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->values[$key] = $this->validate($value);
        }
    }

    /**
     * Проверить значение перед добавлением в массив
     * @param mixed $value
     * @return mixed
     */
    private function validate(mixed $value)
    {
        return $value;
    }

    /**
     * Вернуть значение из массива POST
     * @param string $key
     * @return $mixed
     */
    public function getValue(string $key): mixed
    {
        return array_key_exists($key, $this->values) ? $this->values[$key] : null;
    }
}
