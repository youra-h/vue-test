<?

namespace base;

class Security {

    /**
     * Вернуть hash текста
     * @param stirng $hash
     * @return string
     */
    public static function getHash(string $text): string
    {
        return md5($text);
    }

    /**
     * Проверка пароля на корректность
     * @param string $password
     * @return bool
     */
    public static function validatePassword(string $password)
    {
        return true;
    }

    /**
     * Генерировать случайную строку
     */
    public static function generateRandomString($length = 32, bool $mixin = false)
    {
        $bytes = random_bytes($length);

        $bytes = strtr(base64_encode($bytes), '+/', '-_');

        $result = substr($bytes, 0, $length);

        return $mixin ? $result . '_' . time() : $result;
    }
}