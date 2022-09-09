DROP DATABASE IF EXISTS yeti_cave;
CREATE DATABASE yeti_cave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeti_cave;

CREATE TABLE users
(
  id       INT AUTO_INCREMENT PRIMARY KEY,
  date_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  email    VARCHAR(128) NOT NULL UNIQUE,
  user_name     VARCHAR(128),
  user_password CHAR(256),
  contacts TEXT
  );

CREATE TABLE categories
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  character_code CHAR(128),
  name_category VARCHAR(128)
);

INSERT INTO categories (name, code)
VALUES ('Доски и лыжи', 'boards'),
       ('Крепления', 'attachment'),
       ('Ботинки', 'boots'),
       ('Одежда', 'clothing'),
       ('Инструменты', 'tools'),
       ('Разное', 'other');

CREATE TABLE lots
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  title VARCHAR(255),
  lot_description TEXT,
  img VARCHAR(255),
  start_price INT,
  date_finish DATE,
  step INT,
  user_id INT,
  winner_id INT,
  category_id CHAR(64),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (winner_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE bets
(
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  price NUMERIC,
  user_id INT,
  lot_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (lot_id) REFERENCES lots(id)
);



