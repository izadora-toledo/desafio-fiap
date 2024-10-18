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
    status ENUM('ativa', 'inativo') DEFAULT 'ativa',
    FOREIGN KEY (aluno_id) REFERENCES alunos(id),
    FOREIGN KEY (turma_id) REFERENCES turmas(id),
    UNIQUE (aluno_id, turma_id)  
);

INSERT INTO usuarios (usuario, senha, email) VALUES
('admin', '$2y$10$jcKgOPufI3fyrOzlJnhmnugg08yauNfutBwNillioN2Byg3/tgO7.', 'admin@fiap.com');

INSERT INTO alunos (nome, data_nascimento, usuario_cpf, email, telefone) VALUES
('José Silva', '1995-04-12', '123.456.789-01', 'jose.silva@email.com', '11987654321'),
('Maria Oliveira', '1998-09-30', '987.654.321-09', 'maria.oliveira@email.com', '21987654322'),
('Pedro Souza', '1997-11-05', '111.222.333-44', 'pedro.souza@email.com', '31987654323'),
('Ana Pereira', '1996-03-18', '555.666.777-88', 'ana.pereira@email.com', '41987654324'),
('Luiz Melo', '1994-07-25', '999.888.777-66', 'luiz.melo@email.com', '51987654325'),
('Carla Santos', '1999-12-15', '222.333.444-55', 'carla.santos@email.com', '61987654326');

INSERT INTO turmas (nome_turma, data_inicio, codigo_turma, curso, turno) VALUES
('Turma A', '2024-01-10', 'TURMA001', 'Desenvolvimento Web', 'manhã'),
('Turma B', '2024-02-15', 'TURMA002', 'Análise de Dados', 'tarde'),
('Turma C', '2024-03-01', 'TURMA003', 'Marketing Digital', 'noite'),
('Turma D', '2024-01-20', 'TURMA004', 'Engenharia de Software', 'manhã'),
('Turma E', '2024-04-05', 'TURMA005', 'Gestão de Projetos', 'tarde'),
('Turma F', '2024-02-28', 'TURMA006', 'Inteligência Artificial', 'noite');

INSERT INTO matriculas (aluno_id, turma_id, data_matricula, status) VALUES
(1, 1, '2024-01-15 10:30:00', 'ativa'),
(2, 2, '2024-02-20 11:00:00', 'ativa'),
(3, 3, '2024-03-05 14:00:00', 'ativa'),
(4, 4, '2024-01-25 09:00:00', 'ativa'),
(5, 5, '2024-04-10 16:30:00', 'ativa'),
(6, 6, '2024-03-01 15:45:00', 'ativa');


