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
   user_password_hash VARCHAR(255),
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

CREATE TABLE emails(
   Id_emails INT AUTO_INCREMENT,
   email VARCHAR(50) NOT NULL,
   email_date DATETIME,
   browser VARCHAR(50),
   mobile_browser VARCHAR(50),
   operating_system VARCHAR(50),
   server_adress VARCHAR(50),
   server_name VARCHAR(50),
   remote_adress VARCHAR(50),
   remote_host VARCHAR(50),
   remote_port VARCHAR(50),
   remote_user VARCHAR(50),
   PRIMARY KEY(Id_emails),
   UNIQUE(email)
);

CREATE TABLE configuration(
   Id_configuration INT AUTO_INCREMENT,
   browser VARCHAR(50),
   operating_system VARCHAR(50),
   server_adress VARCHAR(50),
   server_name VARCHAR(128),
   remote_adress VARCHAR(50),
   remote_port VARCHAR(50),
   PRIMARY KEY(Id_configuration)
);

CREATE TABLE state(
   id_state INT AUTO_INCREMENT,
   copie_state_rank VARCHAR(10) NOT NULL,
   copie_state_name VARCHAR(50) NOT NULL,
   copie_state_description VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_state)
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
   game_cover VARCHAR(100),
   id_dates INT NOT NULL,
   id_editor INT NOT NULL,
   PRIMARY KEY(id_game),
   FOREIGN KEY(id_dates) REFERENCES dates(id_dates),
   FOREIGN KEY(id_editor) REFERENCES editors(id_editor)
);

CREATE TABLE copie(
   id_copie INT AUTO_INCREMENT,
   copie_price DECIMAL(19,4),
   copie_addition_date DATETIME NOT NULL,
   id_machine INT NOT NULL,
   id_user INT NOT NULL,
   id_state INT NOT NULL,
   id_medias INT NOT NULL,
   id_game INT NOT NULL,
   PRIMARY KEY(id_copie),
   FOREIGN KEY(id_machine) REFERENCES machines(id_machine),
   FOREIGN KEY(id_user) REFERENCES users(id_user),
   FOREIGN KEY(id_state) REFERENCES state(id_state),
   FOREIGN KEY(id_medias) REFERENCES medias(id_medias),
   FOREIGN KEY(id_game) REFERENCES games(id_game)
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

CREATE TABLE to_connect(
   id_user INT,
   Id_configuration INT,
   PRIMARY KEY(id_user, Id_configuration),
   FOREIGN KEY(id_user) REFERENCES users(id_user),
   FOREIGN KEY(Id_configuration) REFERENCES configuration(Id_configuration)
);


-- Countries
INSERT INTO countries (country_name) VALUES
('Allemagne'),
('France'),
('Angleterre'),
('USA'),
('Japon');
-- Users
-- mot de pass : passPASS14-

INSERT INTO users (user_nikename, user_birthdate, user_email, user_signin_date, user_password_hash) VALUES
('Zisquier', '1977-06-28', 'tbressel.dev@gmail.com', '2023-11-01 11:11:11','$2y$10$uyWDTkO8Yoyhc5XVWVEDke3yfUyY07SvF0LVhN3lKAnbH9zzVN76C'),
('Amstariga', '1987-04-18', 'amsta@email.com', '2023-11-02 12:12:12','$2y$10$uyWDTkO8Yoyhc5XVWVEDke3yfUyY07SvF0LVhN3lKAnbH9zzVN76C'),
('Tbressel', '1999-11-02', 'tbressel@email.com', '2023-11-03 13:13:13','$2y$10$uyWDTkO8Yoyhc5XVWVEDke3yfUyY07SvF0LVhN3lKAnbH9zzVN76C'),
('Wisauier', '1996-07-15', 'wisauier@email.com', '2023-11-04 14:14:14','$2y$10$uyWDTkO8Yoyhc5XVWVEDke3yfUyY07SvF0LVhN3lKAnbH9zzVN76C');
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
INSERT INTO games (game_title, game_subtitle, game_reference, game_cover, id_dates, id_editor) VALUES
('Barbarian', '', 'FPS789', 'img/covers/cpc-barbarian-cover.jpg', 10, 6),
('Double Dragon', '', 'FPS789', 'img/covers/cpc-doubledragon-cover.jpg', 19, 7),
('Prehistorik 2', '', 'FPS789', 'img/covers/cpc-prehistorik2-cover.jpg', 16, 2),
('Rick Dangerous', '', 'FPS789', 'img/covers/cpc-rickdangerous-cover.jpg', 11, 8),
('Goat Simulator', '', 'WOM456', 'img/covers/pc-goatsimulator-cover.jpg', 37, 5),
('Grand Theft Auto 5', '', 'FD789', 'img/covers/ps4-grandtheftauto5-cover.jpg', 36, 9),
('Mortal Kombat 2', '', 'RPG456', 'img/covers/sms-mortalkombat2-cover.jpg', 13, 10),
('Earth Worm Jim 2', '', 'SCB123','img/covers/snes-earthwormjim2-cover.jpg', 15, 4),
('Energy Breaker', '', 'MJ789', 'img/covers/snes-energybreaker-cover.jpg', 15, 4),
('Mario Kart Delux 8', '', 'MJ789',  'img/covers/switch-mariokartdeluxe8-cover.png', 43, 4),
('Splatton 2', '', 'MJ789',  'img/covers/switch-splatoon2-cover.png', 35, 4),
('The Legend Of Zelda', 'Breath Of The Wild', 'MJ789', 'img/covers/switch-thelegendofzelda-breathofthewild-cover.png', 42, 4);
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

INSERT INTO state (copie_state_rank, copie_state_name, copie_state_description) VALUES
('1 / 10' , 'Méconnaissable !', 'red-color'),
('2 / 10' , 'Très mauvais état et très sale !', 'red-color'),
('3 / 10' , 'Très mauvais état', 'red-color'),
('4 / 10' , 'Mauvais état - il a prit cher !', 'red-color'),
('4,5 / 10' , 'Mauvais état - pas catastrophique', 'orange-color'),
('5 / 10', 'Etat moyen - marqué par le temps', 'orange-color'),
('6 / 10' , 'Etat correct - il a pas mal servit', 'orange-color'),
('7 / 10' , 'Assez bon état - ila son age', 'orange-color'),
('8 / 10' , 'Très bon état', 'green-color'),
('9 / 10' , 'Très bon état - comme neuf', 'green-color'),
('9,5 / 10' , 'Neuf sous blister - presque mint', 'green-color'),
('10 / 10' , 'Neuf sous blister - mint', 'green-color');

-- Copie
INSERT INTO copie (copie_price, copie_addition_date, id_user, id_machine, id_medias, id_game, id_state)
VALUES 
( 12.99,  '2023-02-15 20:45:05', 4, 2, 3, 4, 1),
( 36.00,  '2023-03-12 12:30:15', 1, 1, 5, 7, 2),
( 40.50,  '2022-03-25 18:45:30', 1, 1, 4, 2, 2),
( 2.00, '2020-03-02 08:15:00', 2, 1, 2, 6, 3),
( 4.99, '2023-04-17 22:30:45', 4, 2, 2, 5, 4),
( 8.00, '2022-12-05 10:00:20', 3, 3, 5, 7, 3),
( 50.50,  '2022-09-22 15:20:10', 1, 4, 4, 3, 3),
( 120.00, '2023-02-15 23:55:30', 1, 4, 3, 4, 6),
( 12.00,  '2023-03-20 05:40:10', 1, 4, 2, 6, 7),
( 100.99, '2021-06-26 18:10:55', 4, 4, 5, 7, 8),
( 24.50,  '2021-04-28 14:05:40', 4, 4, 5, 7, 9),
( 26.99,  '2001-04-28 14:05:40', 4, 1, 2, 6, 10),
( 32.00,  '2024-04-28 14:05:40', 4, 1, 2, 5, 0),
( 9.50, '2024-06-28 14:05:40', 4, 1, 3, 4, 5);


-- création d'une vue pour générer des statistiques
CREATE VIEW game_statistics AS
SELECT
    id_game,
    game_title,
    AVG(copie_price) AS game_avg_price,
    MIN(copie_price) AS game_min_price,
    MAX(copie_price) AS game_max_price,
    COUNT(id_copie) AS total_copies
FROM
    copie
JOIN
    games USING (id_game)
GROUP BY
    id_game, game_title;


-- consulter la vue
-- SELECT
--     gs.id_game,
--     gs.game_title,
--     gs.game_avg_price,
--     gs.game_min_price,
--     gs.game_max_price,
--     gs.total_copies
-- FROM
--     game_statistics gs
-- JOIN
--     copie c ON gs.id_game = c.id_game
-- WHERE
--     id_user = 1;



SELECT
    c.category_name AS filter_name,
    COUNT(DISTINCT g.id_game) AS total_games,
    COUNT(DISTINCT CASE WHEN co.id_user = 1 THEN g.id_game END) AS games_owned_user
FROM
    categories c
LEFT JOIN
    to_have t USING (id_categorie)
LEFT JOIN
    copie co USING (id_game)
LEFT JOIN
    games g USING (id_game)
GROUP BY
    c.id_categorie, c.category_name;




SELECT
    m.media_type AS filter_name,
    COUNT(DISTINCT g.id_game) AS total_games,
    COUNT(DISTINCT CASE WHEN co.id_user = 1 THEN g.id_game END) AS games_owned_user
FROM
    medias m
LEFT JOIN
    copie co USING (id_medias)
LEFT JOIN
    games g USING (id_game)
GROUP BY
    m.media_type;


-- CREATE VIEW manufacturer_game_statistics AS
-- SELECT
--     m.manufacturer_name,
--     COUNT(DISTINCT th.id_game) AS total_games,
--     COUNT(DISTINCT CASE WHEN c.id_user = 1 THEN th.id_game END) AS games_owned_by_user_1
-- FROM
--     manufacturers m
-- LEFT JOIN
--     machines ma ON m.id_manufacturer = ma.id_manufacturer
-- LEFT JOIN
--     to_have th ON ma.id_machine = th.id_machine
-- LEFT JOIN
--     copie c ON th.id_game = c.id_game AND c.id_user = 1
-- GROUP BY
--     m.manufacturer_name
-- ORDER BY
--     m.manufacturer_name;




SELECT
    m.machine_name AS filter_name,
    COUNT(DISTINCT g.id_game) AS total_games,
    COUNT(DISTINCT CASE WHEN co.id_user = 1 THEN g.id_game END) AS games_owned_user
FROM
    machines m
LEFT JOIN
    to_have t USING (id_machine)
LEFT JOIN
    games g USING (id_game)
LEFT JOIN
    copie co ON g.id_game = co.id_game AND co.id_user = 1
GROUP BY
    m.machine_name;






