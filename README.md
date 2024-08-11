# REST API для управления пользователями

Это простой REST API, созданный на PHP для управления пользователями. API позволяет выполнять базовые CRUD-операции.

## Содержание

- [Начало работы](#начало-работы)
- [API-эндпоинты](#api-эндпоинты)
  - [Получение всех пользователей](#получение-всех-пользователей)
  - [Получение пользователя по ID](#получение-пользователя-по-id)
  - [Создание пользователя](#создание-пользователя)
  - [Обновление пользователя](#обновление-пользователя)
  - [Удаление пользователя](#удаление-пользователя)
  - [Аутентификация пользователя](#аутентификация-пользователя)
- [Структура базы данных](#структура-базы-данных)
- [Лицензия](#лицензия)

## Начало работы

Для начала работы с этим API вам потребуется иметь на сервере установленный PHP и MySQL. Проект имеет следующую структуру:

/rest_api_project
├── /api
│ ├── /v1
│ │ └── users.php
├── /config
│ └── database.php
├── /models
│ └── User.php
├── .htaccess
└── index.php


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

### Вставка тестовых данных

Выполните следующий SQL-запрос для добавления тестовых пользователей в таблицу users:

INSERT INTO users (name, email, password, created_at) VALUES
('John Doe', 'john.doe@example.com', '$2y$10$examplepasswordhash1', NOW()),
('Jane Smith', 'jane.smith@example.com', '$2y$10$examplepasswordhash2', NOW()),
('Alice Johnson', 'alice.johnson@example.com', '$2y$10$examplepasswordhash3', NOW()),
('Bob Brown', 'bob.brown@example.com', '$2y$10$examplepasswordhash4', NOW()),
('Charlie White', 'charlie.white@example.com', '$2y$10$examplepasswordhash5', NOW());

### API-эндпоинты

## Получение всех пользователей

Эндпоинт: /api/v1/users.php
Метод: GET
Описание: Возвращает список всех пользователей.
```json
[
    {
        "id": 1,
        "name": "John Doe",
        "email": "john.doe@example.com",
        "created_at": "2024-08-11 12:34:56"
    },
    ...
];```

## Получение пользователя по ID
Эндпоинт: /api/v1/users.php?id={id}
Метод: GET
Описание: Возвращает информацию о пользователе по его ID.



