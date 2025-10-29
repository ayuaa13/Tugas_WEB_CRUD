CREATE DATABASE db_kalori;
USE db_kalori;


CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama_lengkap VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

desc users;
INSERT INTO users (username, password, nama_lengkap)
VALUES
('admin', MD5('123'), 'Admin'),
('ayu', MD5('022'), 'Ayu Azzahra');

CREATE TABLE kalkulator (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  gender ENUM('Pria', 'Wanita') NOT NULL,
  age INT NOT NULL,
  height FLOAT NOT NULL,
  weight FLOAT NOT NULL,
  activity VARCHAR(50) NOT NULL,
  bmr FLOAT NOT NULL,
  daily_calories FLOAT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE activity_levels (
  id INT AUTO_INCREMENT PRIMARY KEY,
  level_name VARCHAR(50) NOT NULL,
  factor FLOAT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO activity_levels (level_name, factor) VALUES
('Sedentary', 1.2),
('Lightly Active', 1.375),
('Moderately Active', 1.55),
('Very Active', 1.725),
('Extra Active', 1.9);
