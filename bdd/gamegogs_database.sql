DROP DATABASE IF EXISTS gamegogs_database;

CREATE DATABASE IF NOT EXISTS gamegogs_database;

USE gamegogs_database;



CREATE TABLE countries(
   id_country INT AUTO_INCREMENT,
   country_name VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_country)
);

CREATE TABLE users(
   id_user INT AUTO_INCREMENT,
   user_nikename VARCHAR(50) NOT NULL,
   user_birthdate DATE,
   user_email VARCHAR(50) NOT NULL,
   user_signin_date DATETIME NOT NULL,
   user_password VARCHAR(255),
   PRIMARY KEY(id_user),
   UNIQUE(user_nikename),
   UNIQUE(user_email)
);


CREATE TABLE categories(
   id_categorie INT AUTO_INCREMENT,
   category_name VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_categorie)
);

CREATE TABLE manufacturers(
   id_manufacturer INT AUTO_INCREMENT,
   manufacturer_name VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_manufacturer)
);

CREATE TABLE dates(
   id_dates INT AUTO_INCREMENT,
   date_year SMALLINT NOT NULL,
   PRIMARY KEY(id_dates)
);

CREATE TABLE medias(
   id_medias INT AUTO_INCREMENT,
   media_storage_unit VARCHAR(10) NOT NULL,
   media_type VARCHAR(50) NOT NULL,
   media_storage_capacity DECIMAL(4,1) NOT NULL,
   PRIMARY KEY(id_medias)
);

CREATE TABLE editors(
   id_editor INT AUTO_INCREMENT,
   editor_name VARCHAR(50) NOT NULL,
   id_country INT NOT NULL,
   PRIMARY KEY(id_editor),
   FOREIGN KEY(id_country) REFERENCES countries(id_country)
);

CREATE TABLE machines(
   id_machine INT AUTO_INCREMENT,
   machine_name VARCHAR(50) NOT NULL,
   machine_releasedate VARCHAR(7) NOT NULL,
   machine_model VARCHAR(50) NOT NULL,
   machine_type VARCHAR(50),
   gamepad_connexion_type VARCHAR(50),
   cpu_type VARCHAR(50),
   machine_label_picture VARCHAR(100),
   id_manufacturer INT NOT NULL,
   PRIMARY KEY(id_machine),
   FOREIGN KEY(id_manufacturer) REFERENCES manufacturers(id_manufacturer)
);

CREATE TABLE games(
   id_game INT AUTO_INCREMENT,
   game_title VARCHAR(50) NOT NULL,
   game_subtitle VARCHAR(50),
   game_reference VARCHAR(50) NOT NULL,
   game_price DECIMAL(19,4),
   game_cover VARCHAR(100),
   id_dates INT NOT NULL,
   id_editor INT NOT NULL,
   PRIMARY KEY(id_game),
   FOREIGN KEY(id_dates) REFERENCES dates(id_dates),
   FOREIGN KEY(id_editor) REFERENCES editors(id_editor)
);

CREATE TABLE copie(
   id_copie INT AUTO_INCREMENT,
   copie_state_description VARCHAR(50) NOT NULL,
   copie_state_name VARCHAR(50) NOT NULL,
   copie_addition_date DATETIME NOT NULL,
   copie_state_rank TINYINT NOT NULL,
   id_machine INT NOT NULL,
   id_medias INT NOT NULL,
   id_game INT NOT NULL,
   PRIMARY KEY(id_copie),
   FOREIGN KEY(id_machine) REFERENCES machines(id_machine),
   FOREIGN KEY(id_medias) REFERENCES medias(id_medias),
   FOREIGN KEY(id_game) REFERENCES games(id_game)
);

CREATE TABLE to_possess(
   id_user INT,
   id_copie INT,
   PRIMARY KEY(id_user, id_copie),
   FOREIGN KEY(id_user) REFERENCES users(id_user),
   FOREIGN KEY(id_copie) REFERENCES copie(id_copie)
);

CREATE TABLE to_have(
   id_game INT,
   id_machine INT,
   id_categorie INT,
   PRIMARY KEY(id_game, id_machine, id_categorie),
   FOREIGN KEY(id_game) REFERENCES games(id_game),
   FOREIGN KEY(id_machine) REFERENCES machines(id_machine),
   FOREIGN KEY(id_categorie) REFERENCES categories(id_categorie)
);


-- Countries
INSERT INTO countries (country_name) VALUES
('Allemagne'),
('France'),
('Angleterre'),
('USA'),
('Japon');
-- Users
INSERT INTO users (user_nikename, user_birthdate, user_email, user_signin_date, user_password) VALUES
('Zisquier', '1993-09-25', 'zisquier@email.com', '2023-11-01 11:11:11','e6c3da5b206634d7f3f3586d747ffdb36b5c675757b380c6a5fe5c570c714349'),
('Amstariga', '1987-04-18', 'amsta@email.com', '2023-11-02 12:12:12','1ba3d16e9881959f8c9a9762854f72c6e6321cdd44358a10a4e939033117eab9'),
('Tbressel', '1999-11-02', 'tbressel@email.com', '2023-11-03 13:13:13','3acb59306ef6e660cf832d1d34c4fba3d88d616f0bb5c2a9e0f82d18ef6fc167'),
('Wisauier', '1996-07-15', 'wisauier@email.com', '2023-11-04 14:14:14','a417b5dc3d06d15d91c6687e27fc1705ebc56b3b2d813abe03066e5643fe4e74');
-- Manufacturers
INSERT INTO manufacturers (manufacturer_name) VALUES
('Amstrad'),
('Atari'),
('Sony'),
('Ninteno'),
('Sega'),
('Microsoft');
-- Machines
INSERT INTO machines (machine_name, machine_releasedate, machine_model, machine_label_picture, id_manufacturer) VALUES
('CPC', '2024-01', '6128', 'img/plateforms/webp/amstrad-cpc.webp', 1),
('STe', '2024-04', '1040', 'img/plateforms/webp/atari-st.webp', 2),
('Playstation', '2024-07', '4', 'img/plateforms/webp/sony-playstation4.webp', 3),
('Switch', '1987-07', '(classic)', 'img/plateforms/webp/nintendo-switch.webp', 4),
('Super Nintendo', '1992-07', '(EU)', 'img/plateforms/webp/nintendo-supernintendo.webp', 4),
('Master System', '1992-07', '(EU)', 'img/plateforms/webp/sega-megadrive.webp', 5),
('PC', '2012-07', 'Windows', 'img/plateforms/webp/microsoft-windows.webp', 6);
-- Dates
INSERT INTO dates (date_year) VALUES
-- 1 à 3
(1977), (1978), (1979),
-- 4 à 12
(1980), (1981), (1982), (1983), (1984), (1985), (1986),
(1987), (1988), (1989),
-- 13 à 22
 (1990), (1991), (1992), (1993), (1994), (1995), (1996),
(1997), (1998), (1999),
-- 23 à 32
 (2000), (2001), (2002), (2003), (2004), (2005), (2006),
(2007), (2008), (2009),
-- 33 à 42
 (2010), (2011), (2012), (2013), (2014), (2015), (2016),
(2017), (2018), (2019),
-- 43 à 46
 (2020), (2021), (2022), (2023);
-- Editors
INSERT INTO editors (editor_name, id_country) VALUES
('ERE', 3),
('Titus Software', 3),
('UbiSoft', 2),
('Nintendo', 5),
('Konami', 5),
('ERBE Software', 4),
('Virgin Melbourne House', 4),
('Firebirds', 4),
('Rockstar Games', 4),
('Taito', 4);
-- Games
INSERT INTO games (game_title, game_subtitle, game_reference, game_price, game_cover, id_dates, id_editor) VALUES
('Barbarian', '', 'FPS789', 59.99, 'img/covers/cpc-barbarian-cover.jpg', 10, 6),
('Double Dragon', '', 'FPS789', 59.99, 'img/covers/cpc-doubledragon-cover.jpg', 19, 7),
('Prehistorik 2', '', 'FPS789', 59.99, 'img/covers/cpc-prehistorik2-cover.jpg', 16, 2),
('Rick Dangerous', '', 'FPS789', 59.99, 'img/covers/cpc-rickdangerous-cover.jpg', 11, 8),
('Goat Simulator', '', 'WOM456', 49.99, 'img/covers/pc-goatsimulator-cover.jpg', 37, 5),
('Grand Theft Auto 5', '', 'FD789', 29.99, 'img/covers/ps4-grandtheftauto5-cover.jpg', 36, 9),
('Mortal Kombat 2', '', 'RPG456', 44.99, 'img/covers/sms-mortalkombat2-cover.jpg', 13, 10),
('Earth Worm Jim 2', '', 'SCB123', 54.99, 'img/covers/snes-earthwormjim2-cover.jpg', 15, 4),
('Energy Breaker', '', 'MJ789', 39.99, 'img/covers/snes-energybreaker-cover.jpg', 15, 4),
('Mario Kart Delux 8', '', 'MJ789', 39.99, 'img/covers/switch-mariokartdeluxe8-cover.png', 43, 4),
('Splatton 2', '', 'MJ789', 39.99, 'img/covers/switch-splatoon2-cover.png', 35, 4),
('The Legend Of Zelda', 'Breath Of The Wild', 'MJ789', 39.99, 'img/covers/switch-thelegendofzelda-breathofthewild-cover.png', 42, 4);
-- Categories
INSERT INTO categories (category_name) VALUES
('Combat'),
('Beat em up'),
('Course'),
('Action'),
('Stratégie'),
('RPG'),
('FPS'),
('Simulation'),
('Plateforme');
-- Assossiation catégories / jeux
INSERT INTO to_have (id_game, id_machine, id_categorie) VALUES
(1,  1, 1),
(2,  1, 2),
(3,  1, 9),
(4,  1, 9),
(5,  7, 8),
(5,  7, 4),
(6,  3, 2),
(6,  3, 3),
(6,  3, 4),
(6,  3, 7),
(7,  6, 9),
(8,  5, 9),
(9,  5, 1),
(10, 4, 3),
(11, 4, 4),
(12, 4, 6);



-- Medias
INSERT INTO medias (media_type,media_storage_capacity, media_storage_unit)
VALUES
( 'DVD', 4.7, 'Go'),
( 'Blu-ray', 25.0, 'Mo'),
( 'Cassette', 0.8, 'mn'),
( 'Disquette', 8.0, 'Ko'),
( 'Cartouche', 15.3, 'Mo');



-- Copie
INSERT INTO copie (copie_state_description, copie_state_name, copie_state_rank, copie_addition_date, id_machine, id_medias, id_game)
VALUES
('Comme neuf', 'Presque neuf', 1, '2023-02-15 20:45:05', 4, 3, 4),
('Endommagé', 'Besoin de réparation', 3, '2023-03-12 12:30:15', 1, 3, 1),
('Endommagé', 'Besoin de réparation', 3, '2022-03-25 18:45:30', 1, 4, 2),
('Endommagé', 'Besoin de réparation', 3, '2020-03-02 08:15:00', 2, 2, 6),
('Correct', 'État correct', 2, '2023-04-17 22:30:45', 4, 2, 5),
('Correct', 'État correct', 2, '2022-12-05 10:00:20', 3, 5, 7),
('Correct', 'État correct', 2, '2022-09-22 15:20:10', 1, 3, 1),
('Comme neuf', 'Presque neuf', 1, '2023-02-15 23:55:30', 1, 4, 2),
('Endommagé', 'Besoin de réparation', 3, '2023-03-20 05:40:10', 1, 4, 3),
('Correct', 'État correct', 2, '2021-06-26 18:10:55', 4, 5, 7),
('Correct', 'État correct', 2, '2021-04-28 14:05:40', 4, 5, 7),
('Correct', 'État correct', 2, '2001-04-28 14:05:40', 4, 4, 3),
('Correct', 'État correct', 2, '2024-04-28 14:05:40', 4, 3, 4),
('Comme neuf', 'Presque neuf', 1, '2024-06-28 14:05:40', 4, 3, 4);
-- Association User / Copie  (copie qui possède l'id_game de cette copie de cet user)
INSERT INTO to_possess (id_user, id_copie) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 12),
(2, 1),
(2, 5),
(3, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(1, 13),
(1, 14),
(4, 11);

SELECT
    id_game,
    id_copie,
    game_title,
    game_subtitle,
    GROUP_CONCAT(category_name) AS categories,
    date_year,
    editor_name,
    country_name,
    manufacturer_name,
    machine_name,
    machine_model,
    media_type,
    ROUND(game_price, 2) AS game_price,
    game_cover,
    machine_label_picture
FROM
    to_have
JOIN machines USING (id_machine)
JOIN categories USING (id_categorie)
JOIN games USING (id_game)
JOIN dates USING (id_dates)
JOIN editors USING (id_editor)
JOIN countries USING (id_country)
JOIN manufacturers USING (id_manufacturer)
JOIN copie USING (id_game)
JOIN medias USING (id_medias)
JOIN to_possess USING (id_copie)
JOIN users USING (id_user)
WHERE
    users.id_user = 1 AND to_possess.id_user
GROUP BY
    id_game, id_copie, game_title, game_subtitle, date_year, editor_name, country_name,
    manufacturer_name, machine_name, machine_model, media_type, game_cover, machine_label_picture
ORDER BY
    id_copie;
