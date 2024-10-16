CREATE DATABASE IF NOT EXISTS fiap;

USE fiap;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    usuario_cpf VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(100) NULL,
    telefone VARCHAR(15) NULL
);


INSERT INTO usuarios (usuario, senha, email) VALUES
('admin', '$2y$10$jcKgOPufI3fyrOzlJnhmnugg08yauNfutBwNillioN2Byg3/tgO7.', 'admin@fiap.com');
