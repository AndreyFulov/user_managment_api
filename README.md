# REST API для управления пользователями

Это простой REST API, созданный на PHP для управления пользователями. API позволяет выполнять базовые CRUD-операции.

## Содержание

- [API-эндпоинты](#api-эндпоинты)
  - [Получение всех пользователей](#получение-всех-пользователей)
  - [Получение пользователя по ID](#получение-пользователя-по-id)
  - [Создание пользователя](#создание-пользователя)
  - [Обновление пользователя](#обновление-пользователя)
  - [Удаление пользователя](#удаление-пользователя)
  - [Аутентификация пользователя](#аутентификация-пользователя)
- [Структура базы данных](#структура-базы-данных)

____

### Настройка базы данных

Выполните следующие SQL-запросы для создания необходимой базы данных и таблицы:

```sql
CREATE DATABASE rest_api_db;

USE rest_api_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Вставка тестовых данных

Выполните следующий SQL-запрос для добавления тестовых пользователей в таблицу users:
```sql
INSERT INTO users (name, email, password, created_at) VALUES
('John Doe', 'john.doe@example.com', '$2y$10$examplepasswordhash1', NOW()),
('Jane Smith', 'jane.smith@example.com', '$2y$10$examplepasswordhash2', NOW()),
('Alice Johnson', 'alice.johnson@example.com', '$2y$10$examplepasswordhash3', NOW()),
('Bob Brown', 'bob.brown@example.com', '$2y$10$examplepasswordhash4', NOW()),
('Charlie White', 'charlie.white@example.com', '$2y$10$examplepasswordhash5', NOW());
```

____

### API-эндпоинты <a name="api-эндпоинты"></a>

## Получение всех пользователей

* Эндпоинт: /api/v1/users.php
* Метод: GET
* Описание: Возвращает список всех пользователей.
```json
[
    {
        "id": 1,
        "name": "John Doe",
        "email": "john.doe@example.com",
        "created_at": "2024-08-11 12:34:56"
    },
    ...
];
```

## Получение пользователя по ID <a name="получение-пользователя-по-id"></a>
* Эндпоинт: /api/v1/users.php?id={id}
* Метод: GET
* Описание: Возвращает информацию о пользователе по его ID.

Пример ответа:
```json

{
    "id": 1,
    "name": "John Doe",
    "email": "john.doe@example.com",
    "created_at": "2024-08-11 12:34:56"
}
```

## Создание пользователя <a name="создание-пользователя"></a>

* Эндпоинт: /api/v1/users.php
* Метод: POST
* Описание: Создает нового пользователя.

Тело запроса:
```json
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "yourpassword"
}
```

Пример ответа:

```json
{
    "message": "User was created."
}

```

## Обновление пользователя <a name="обновление-пользователя"></a>

* Эндпоинт: /api/v1/users.php
* Метод: PUT
* Описание: Обновляет существующего пользователя.

Тело запроса:

```json
{
    "id": 1,
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "newpassword"
}

```
Пример ответа:
```json
{
    "message": "User was updated."
}

```

## Удаление пользователя <a name="удаление-пользователя"></a>

* Эндпоинт: /api/v1/users.php
* Метод: DELETE
* Описание: Удаляет пользователя по его ID.

Тело запроса:
```json
{
    "id": 1
}

```

Пример ответа:
```json
{
    "message": "User was deleted."
}

```

## Аутентификация пользователя <a name="аутентификация-пользователя"></a>

* Эндпоинт: /api/v1/users.php
* Метод: POST
* Описание: Аутентифицирует пользователя.

Тело запроса:
```json
{
    "email": "john.doe@example.com",
    "password": "yourpassword"
}

```

Пример ответа:
```json
{
    "message": "User authenticated.",
    "user_id": 1
}

```

Если данные введены неверно:
```json
{
    "message": "Invalid credentials."
}

```

____

## Структура базы данных <a name="структура-базы-данных"></a>

* Таблица Users
  * id: INT, Primary Key, Auto Increment
  * name: VARCHAR(255), Not Null
  * email: VARCHAR(255), Not Null, Unique
  * password: VARCHAR(255), Not Null
  * created_at: TIMESTAMP, Default CURRENT_TIMESTAMP


