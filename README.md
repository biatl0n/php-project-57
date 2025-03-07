# Проект "Менеджер задач"

### Hexlet tests and linter status:
[![Actions Status](https://github.com/biatl0n/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/biatl0n/php-project-57/actions)
[![Maintainability](https://api.codeclimate.com/v1/badges/ec88aa96cbe704708b0d/maintainability)](https://codeclimate.com/github/biatl0n/php-project-57/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/ec88aa96cbe704708b0d/test_coverage)](https://codeclimate.com/github/biatl0n/php-project-57/test_coverage)

Демонстрация доступа на Render.com: https://php-project-57-ielt.onrender.com/

## О проекте

Позволяет вам создавать задачи, назначать исполнителей и изменять статусы.
Для работы с системой требуются регистрация и аутентификация.

## Установка с помощью Docker

### Системные требования

- Docker latest version

### Установка

- Склонируйте репозиторий: ```git clone https://github.com/biatl0n/php-project-57.git```
- Перейдите в каталог репозитория: ```cd php-project-57```
- Запустите сборку контейнера: ```docker build -t task-manager .```
- Запустите контейнер: ```docker run -d -p 80:8000 task-manager```
  - ```-d``` - запуск в режиме демона
  - ```-p 80:8000``` - перенаправление порта контейнера 8000 на локальный порт 80. Если У вас занят 80-й порт - можно выбрать другой.

## Чисткая установка

### Системные требования

- Composer latest version
- php 8.2
- node 20.18
- npm 10.8.2
- make 4.3

### Установка

- Склонируйте репозиторий: ```git clone https://github.com/biatl0n/php-project-57.git```
- Перейдите в каталог репозитория: ```cd php-project-57```
- Запустите команду для установки зависимостей: ```make setup```
- Если необходимо наполнить тестовыми данными: ```make migrate-fresh-seed```
- Для запуска: ```make start```
  - сервер запустится на 8000 порту localhost