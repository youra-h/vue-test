<?

namespace models;

use base\Mailer;
use base\Security;

class User extends Model
{
    const STATUS_DELETED = -1;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public string $username;
    public string $email;
    protected string $auth_key = '';
    protected string $password_hash;
    protected ?string $password_reset_token;
    protected string $status;
    protected int $created_at;
    protected int $updated_at;
    protected ?string $verification_token;

    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * Вернуть токен автовхода
     * @return string
     */
    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    /**
     * Вернуть токен верификации email
     * @return string
     */
    public function getVerificationToken(): string
    {
        return $this->verification_token;
    }

    /**
     * Вернуть токен для сброса пароля
     * @return string
     */
    public function getPasswrodResetToken(): string
    {
        return $this->password_reset_token;
    }

    /**
     * Пользователь прошел верификацию email
     */
    public function verificationPassed(): void
    {
        $this->status = self::STATUS_ACTIVE;
    }

    /**
     * Пользователь зареган
     * @return bool
     */
    public function isActive(): bool
    {
        return (int) $this->status === self::STATUS_ACTIVE;
    }

    /**
     * Проверка пароля на корректность
     * @param string $password
     * @return string
     */
    public function validatePassword(string $password): string
    {
        return Security::validatePassword($password);
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = Security::getHash($password);
    }

    /**
     * Используется для автовхода
     */
    public function generateAuthKey(): void
    {
        $this->auth_key = Security::generateRandomString();
    }

    /**
     * Сгенерировать новый токен для сброса пароля
     */
    public function generatePasswordResetToken(): void
    {
        $this->password_reset_token = Security::generateRandomString(mixin: true);
    }

    /**
     * Сгенерировать токен для проверки эдектронной почты
     */
    public function generateEmailVerificationToken(): void
    {
        $str = Security::generateRandomString(mixin: true);

        $this->verification_token = Security::getHash($this->email . $str);
    }

    /**
     * Сбросить токен 
     */
    public function removePasswordResetToken(): void
    {
        $this->password_reset_token = null;
    }

    protected function prepareValues(array $fields): array
    {
        if (isset($this->id)) {
            $this->updated_at = time();
        } else {
            $this->status = self::STATUS_INACTIVE;
            $this->created_at = time();
            $this->updated_at = time();

            $values = get_object_vars($this);

            $values = array_filter($values, fn ($value) => !is_null($value));

            $fields = array_keys($values);
        }

        return $fields;
    }

    /**
     * Найти пользователя по имени
     * @param string $username
     * @return User|false
     */
    public static function findByUser(string $username): self | false
    {
        $model = self::load(['username' => $username]);

        return $model ?? false;
    }

    /**
     * Проверить залогинился ли пользователь или нет
     * @param string $username
     * @param string $password
     * @return User|false
     */
    public static function login(string $username, string $password): User | false
    {
        $hash = Security::getHash($password);

        $model = self::load(['username' => $username, 'password_hash' => $hash]);

        return $model ?? false;
    }

    /**
     * Проверить залогинился ли пользователь или нет
     * @param string $username
     * @param string $password
     * @return User|false
     */
    public static function signup(string $username, string $password): User | false
    {
        $model = new self();
        $model->username = $username;
        $model->email = $username;
        $model->setPassword($password);
        $model->generateAuthKey();
        $model->generateEmailVerificationToken();        

        return $model->save() ? $model : false;
    }

    /**
     * Отправить email пользователю
     */
    public function sendEmail(string $subject, string $message)
    {
        return (new Mailer())
            ->to($this->email)
            ->subject($subject)
            ->message($message)
            ->send();
    }
}
