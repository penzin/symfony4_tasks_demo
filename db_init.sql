--
-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

DROP DATABASE IF EXISTS tasks_db;

CREATE DATABASE IF NOT EXISTS tasks_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

--
-- Установка базы данных по умолчанию
--
USE tasks_db;

--
-- Создать таблицу `tasks`
--
CREATE TABLE IF NOT EXISTS tasks (
  id binary(16) NOT NULL,
  name varchar(100) NOT NULL,
  priority int(1) NOT NULL,
  state tinyint(1) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_general_ci;

--
-- Создать таблицу `tags`
--
CREATE TABLE IF NOT EXISTS tags (
  id binary(16) NOT NULL,
  name varchar(50) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_general_ci;

--
-- Создать таблицу `tasks_tags`
--
CREATE TABLE IF NOT EXISTS tasks_tags (
  id_task binary(16) NOT NULL,
  id_tag binary(16) NOT NULL,
  PRIMARY KEY (id_task, id_tag)
)
ENGINE = INNODB,
CHARACTER SET utf8mb4,
COLLATE utf8mb4_general_ci;

--
-- Создать внешний ключ
--
ALTER TABLE tasks_tags
ADD CONSTRAINT FK_tasks_tags_tags_id FOREIGN KEY (id_tag)
REFERENCES tags (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE tasks_tags
ADD CONSTRAINT FK_tasks_tags_tasks_id FOREIGN KEY (id_task)
REFERENCES tasks (id) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;