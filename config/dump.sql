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

CREATE TABLE turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_turma VARCHAR(100) NOT NULL,
    data_inicio DATE NOT NULL,
    codigo_turma VARCHAR(20) NOT NULL UNIQUE,
    curso VARCHAR(100) NOT NULL,
    turno ENUM('manhã', 'tarde', 'noite') NOT NULL
);

CREATE TABLE IF NOT EXISTS matriculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    turma_id INT NOT NULL,
    data_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('ativa', 'cancelada') DEFAULT 'ativa',
    FOREIGN KEY (aluno_id) REFERENCES alunos(id),
    FOREIGN KEY (turma_id) REFERENCES turmas(id),
    UNIQUE (aluno_id, turma_id)  
);

INSERT INTO usuarios (usuario, senha, email) VALUES
('admin', '$2y$10$jcKgOPufI3fyrOzlJnhmnugg08yauNfutBwNillioN2Byg3/tgO7.', 'admin@fiap.com');
