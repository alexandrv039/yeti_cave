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
  user_password CHAR(255),
  contacts TEXT
  );

CREATE TABLE categories
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  character_code CHAR(128),
  name_category VARCHAR(128)
);

INSERT INTO categories (name_category, character_code)
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
  category_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (winner_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE bets
(
  date_bet TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  price NUMERIC,
  user_id INT,
  lot_id INT,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (lot_id) REFERENCES lots(id)
);

INSERT INTO users (date_registration, email, user_name, contacts) VALUES
      ('2022-09-01 15:12:11', 'Test123@mail.ru', 'Тестерович', '+79125432553'),
      ('2022-08-01 15:12:11', 'Test456@mail.ru', 'Петрович', 'г. Пермь'),
      ('2022-09-02 15:12:11', 'Test789@mail.ru', 'Иванович', 'г. Москва');

INSERT INTO lots (date_create, title, img, start_price, step, user_id, date_finish, category_id)
VALUES ('2022-09-08', '2014 Rossignol District Snowboard', 'uploads/lot-1.jpg', 10999, 100, 1, '2022-09-13', 1),
       ('2022-09-08', 'DC Ply Mens 2016/2017 Snowboard', 'uploads/lot-2.jpg', 159999, 100, 2, '2022-09-13', 1),
       ('2022-09-08', 'Крепления Union Contact Pro 2015 года размер L/XL', 'uploads/lot-3.jpg', 8000, 100, 3, '2022-09-12', 2),
       ('2022-09-08', 'Ботинки для сноуборда DC Mutiny Charocal', 'uploads/lot-4.jpg', 10999, 100, 1, '2022-09-11', 3),
       ('2022-09-08', 'Куртка для сноуборда DC Mutiny Charocal', 'uploads/lot-5.jpg', 7500, 120, 2, '2022-09-12', 4),
       ('2022-09-08', 'Маска Oakley Canopy', 'uploads/lot-6.jpg', 5400, 100, 3, '2022-09-13', 6);

INSERT INTO bets (date_bet, price, user_id, lot_id)
VALUES ('2022-09-09 12:11:12', 11199, 2, 1),
       ('2022-09-09 12:12:12', 11299, 3, 1),
       ('2022-09-09 12:13:12', 11399, 2, 1);

CREATE FULLTEXT INDEX lots_search ON lots(title, lot_description);






