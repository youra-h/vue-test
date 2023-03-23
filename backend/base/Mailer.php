<?

namespace base;

use helper\ArrayHelper;

class Mailer {
    private string $_from = 'test@test.com';
    private string $_to;
    private string $_subject;
    private string $_message;

    public function __construct(array $config = [])
    {        
        ini_set("sendmail_path", false);

        $host = ArrayHelper::getValue($config, 'smtp', 'localhost');
        ini_set("SMTP", $host);

        $port = ArrayHelper::getValue($config, 'port', 25);
        ini_set("smtp_port", $port);
    }

    /**
     * Добавить отправителя     
     */
    public function from(string $value): Mailer
    {
        $this->_from = $value;
        return $this;
    }

    /**
     * Добавить получателя
     */
    public function to(string $value): Mailer
    {
        $this->_to = $value;
        return $this;
    }

    /**
     * Добавить тему сообщения
     */
    public function subject(string $value): Mailer
    {
        $this->_subject = $value;
        return $this;
    }

    /**
     * Добавить тело сообщения
     */
    public function message(string $value): Mailer
    {
        $this->_message = $value;
        return $this;
    }

    /**
     * Вернуть заголовки сообщения
     */
    private function getHeaders(): array
    {
        return [
            'From' => $this->_from,
            'Reply-To' => $this->_from,
            'X-Mailer' => 'PHP/' . phpversion()
        ];
    }

    /**
     * Отправить сообщение
     * @return bool
     */
    public function send(): bool
    {
        return mail($this->_to, $this->_subject, $this->_message, $this->getHeaders());        
    }
}