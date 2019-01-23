# Демо - приложение "Задачи". Управление списком задач.

Установка
-
1) ```git clone https://github.com/penzin/tasks_demo.git```

2) В директории **tasks_demo** выполнить: ```composer install``` для установки необходимых пакетов

3) Выполнить скрипт, инициализирующий базу (файл db_init.sql) в тестовом окружении (сервер MySQL).
Будет создана база **tasks_db** и соответствующие таблицы.

4) В конфиге подключения к БД указать верные данные Вашего Mysql сервера:
файл **tasks_demo/.env** (либо создать **tasks_demo/.env.local**)
```
DATABASE_URL=mysql://username:password@127.0.0.1:3306/tasks_db
```

5) Настроить веб-сервер (apache/nginx/..) таким образом, чтобы корневая директория сайта была **tasks_demo/public/**
Если необходимо, отредактировать файл hosts.

Пример v-хоста для xampp:
```
#tasksdemo
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/tasks_demo/public"
    ServerName tasksdemo
</VirtualHost>
```

Строка в Hosts:
```
127.0.0.1 tasksdemo
```

После данных действий и перезагрузки web-сервера, решение будет доступно по адресу http://tasksdemo/
