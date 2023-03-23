# Тестовый проект Vue 2 + php

**Основные действия**
```
- Регистрация пользователя
- Авторизация пользователя
- Подтверждение email
- Сброс пароля
- Подтверждение сброса пароля с помощью email
```

***
## ❗ Отправка сообщений на email может быть только при поднятом SMTP сервере
**url** для потверждения почты или изменения пароля так же отправляются в **devtools console**
***

## Запуск с помощью Docker

```
docker-compose up
```

## Запуск сервисов по отдельности

Используемый стек
```
- Vue 2
- php 8.1
- mysql 8
```

**App**

Для запуска frontend приложения, необходимо:

1. В файле **webpack.config.js**  раскоментировать строки
```JavaScript
// Запуск отдельным сервисом
host: 'localhost',
// Запуск в Docker контейнере
//host: '0.0.0.0',
```
2. В файле **.env** указать адрес backend сервера
```JavaScript
API_ROOT=http://localhost:80
```
3. Выполнить команду 
```
npm install
```

**API**

Для запуска backend приложения, необходимо:

1. В файле **config/db.php** указать корректные настройки для доступа к mysql
```php
[
    'db' => [
        'dsn' => 'mysql:host=mysql:3306;dbname=vue-test',
        'username' => 'root',
        'password' => 'root'
    ]
]
```
2. В файле **config/main.php** указать адрес frontend приложения:
```php
[
    'main' => [
        'app_root' => 'http://localhost:3000'
    ]
]
```

**MYSQL**

Выполнить sql скрипт из файла **backend/dump/init.sql**






