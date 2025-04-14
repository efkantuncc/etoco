CREATE DATABASE IF NOT EXISTS zenthor;
USE zenthor;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password) VALUES ('ekoadmin', SHA2('ekoekoeko33', 256));

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    image_url TEXT,
    description TEXT,
    price DECIMAL(10,2),
    purchase_link TEXT
);

CREATE TABLE announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT,
    is_discount BOOLEAN DEFAULT 0
);

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    site_title VARCHAR(255),
    maintenance_mode BOOLEAN DEFAULT 0
);

INSERT INTO settings (site_title, maintenance_mode) VALUES ('Zenthor', 0);
