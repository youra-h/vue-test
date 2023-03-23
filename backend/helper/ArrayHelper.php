<?

namespace helper;

class ArrayHelper {
    /**
     * Вернуть значение массива
     */
    public static function getValue(array $arr, string $key, $defaultValue = null)
    {
        return array_key_exists($key, $arr) ? $arr[$key] : $defaultValue;
    }
}