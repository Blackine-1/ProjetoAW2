CREATE DATABASE IF NOT EXISTS hexdracon
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE hexdracon;

CREATE TABLE IF NOT EXISTS ranking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tempo_conclusao TIME NOT NULL,
    dano INT NOT NULL
);