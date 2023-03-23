<?

namespace controller;

use base\App;
use base\Response;
use models\User;

class UserController
{

    /**
     * Проверка входа
     */
    public function actionLogin()
    {
        $username = (string) App::id()->request->getValue('username');
        $password = (string) App::id()->request->getValue('password');

        $user = User::login($username, $password);

        if (!$user) {
            return Response::error('Пользователь не найден');
        }

        if (!$user->isActive()) {
            return Response::error('Пользователь не подтвердил свой email');
        }

        $user->generateAuthKey();

        return Response::success('Успешный вход', ['auth_key' => $user->getAuthKey()]);
    }

    /**
     * Регистрация пользователя
     */
    public function actionSignup()
    {
        $username = (string) App::id()->request->getValue('username');
        $password = (string) App::id()->request->getValue('password');
        $repeat_password = (string) App::id()->request->getValue('repeat_password');

        if ($password !== $repeat_password) {
            return Response::error('Пароли не совпадают');
        }

        // Проверка наличия пользователя
        $user = User::findByUser($username);

        if ($user) {
            return Response::error('Пользователь уже зарегистрирован');
        }

        // Регистрация
        $user = User::signup($username, $password);

        if (!$user) {
            return Response::error('Не вышло зарегистрировать пользователя');
        }

        $message = App::id()->getAppRoot() . '/verify-email?token=' . $user->getVerificationToken();

        $user->sendEmail('Подтверждение регистрация пользователя', $message);

        return Response::success('Пользователь зарегистрирован. На почту отправлено сообщение о подтверждении регистрации', [
            'url' => $message
        ]);
    }

    /**
     * Верифмкация email
     */
    public function actionVerifyemail()
    {
        $token = (string) App::id()->request->getValue('token');

        $user = User::load(['verification_token' => $token]);

        if (!$user) {
            return Response::error('Пользователь не найден');
        }

        // Изменить статус пользователя
        $user->verificationPassed();

        if (!$user->save(['status'])) {
            return Response::error('Ошибка: не удалось сохранить данные');
        }

        return Response::success('Пользователь успешно зарегистрировался');
    }

    /**
     * Запрос на изменения пароля
     */
    public function actionResetpasswordrequest()
    {
        $username = (string) App::id()->request->getValue('username');

        // Проверка наличия пользователя
        $user = User::findByUser($username);

        if (!$user) {
            return Response::error('Пользователь не найден');
        }

        $user->generatePasswordResetToken();

        if (!$user->save(['password_reset_token'])) {
            return Response::error('Ошибка: не удалось сохранить данные');
        }

        $message = App::id()->getAppRoot() . '/reset-password?token=' . $user->getPasswrodResetToken();

        $user->sendEmail('Изменить пароль', $message);

        return Response::success('На почту отправлено сообщение для изменения пароля', [
            'url' => $message
        ]);
    }

    /**
     * Изменение пароля
     */
    public function actionResetpassword()
    {
        $password = (string) App::id()->request->getValue('password');
        $repeat_password = (string) App::id()->request->getValue('repeat_password');

        if ($password !== $repeat_password) {
            return Response::error('Пароли не совпадают');
        }

        $token = (string) App::id()->request->getValue('token');

        $user = User::load(['password_reset_token' => $token]);

        if (!$user) {
            return Response::error('Пользователь не найден');
        }

        $user->setPassword($password);
        // удалить старый токен
        $user->removePasswordResetToken();

        if (!$user->save(['password_hash', 'password_reset_token'])) {
            return Response::error('Ошибка: не удалось сохранить данные');
        }

        return Response::success('Пароль успешно изменен');
    }
}
