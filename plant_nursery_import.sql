
-- Create database
CREATE DATABASE plant_nursery;
USE plant_nursery;

-- Drop tables if they exist
DROP TABLE IF EXISTS plant;
DROP TABLE IF EXISTS category;

-- Create category table
CREATE TABLE category (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);

-- Create plant table
CREATE TABLE plant (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    category_id INT(11) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES category(id)
);

-- Insert data into category
INSERT INTO category (id, name, description) VALUES
(1, 'Vetplanten', 'Planten die water opslaan in hun bladeren'),
(2, 'Kruiden', 'Kleine eetbare of medicinale planten'),
(3, 'Bloeiende', 'Planten die bekend staan om hun bloemen'),
(4, 'Kamerplanten', 'Planten die binnenshuis gehouden worden'),
(5, 'Bomen', 'Grote, houtachtige planten');

-- Insert data into plant
INSERT INTO plant (id, name, image, price, category_id) VALUES
(1, 'Aloe Vera', 'aloe_vera.jpg', 4.95, 1),
(2, 'Cactus Mix', 'cactus_mix.jpg', 7.50, 1),
(3, 'Basilicum', 'basilicum.jpg', 2.25, 2),
(4, 'Munt', 'munt.jpg', 2.50, 2),
(5, 'Zonnebloem', 'zonnebloem.jpg', 3.00, 3),
(6, 'Orchidee', 'orchidee.jpg', 6.75, 3),
(7, 'Monstera', 'monstera.jpg', 9.95, 4),
(8, 'Sansevieria', 'sansevieria.jpg', 8.00, 4),
(9, 'Esdoorn', 'esdoorn.jpg', 15.00, 5),
(10, 'Olijfboom', 'olijfboom.jpg', 18.50, 5);
