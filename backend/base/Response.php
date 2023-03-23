<?

namespace base;

class Response {

    /**
     * Сформировать массив сообщений
     * @param string $type
     * @param string $text 
     * @param array $data
     * @return array
     */
    private static function getMessage(string $type, string $text, array $data = []): array
    {
        $result = [
            'type' => $type,
            'message' => $text,
        ];

        if (count($data) > 0) {
            $result['data'] = $data;
        }

        return $result;
    }

    /**
     * Корректные данные
     * @param string $text 
     * @param array $data
     * @return array
     */
    public static function success(string $text, array $data = []): array    
    {
        return self::getMessage('success', $text, $data);
    }

    /**
     * Ошибка
     * @param string $text 
     * @param array $data
     * @return array
     */
    public static function error(string $text, array $data = []): array
    {
        return self::getMessage('error', $text, $data);
    }

    /**
     * Сформировать json
     * @param array $message
     * @return string
     */
    public static function send(array $message): string
    {
        return json_encode($message);
    }
}