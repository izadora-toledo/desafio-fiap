CREATE DATABASE IF NOT EXISTS fiap;

USE fiap;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (usuario, senha, email) VALUES
('admin', '5ef12d0ce2d007163ba03f6bfe350431', 'admin@fiap.com');
