<?php

$host = "localhost";
$user = "root";
$password = "";
$banco = "med_pass";

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

echo "Conectado ao MySQL <br>";

// Criar banco se não existir
$sql = "CREATE DATABASE IF NOT EXISTS $banco CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

if ($conn->query($sql) === TRUE) {
    echo "Banco verificado/criado <br>";
} else {
    die("Erro ao criar banco: " . $conn->error);
}

// selecionar banco
$conn->select_db($banco);

// =============================
// TABELA USUARIOS
// =============================

$sql = "CREATE TABLE IF NOT EXISTS usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    genero CHAR(1),
    email VARCHAR(50) NOT NULL,
    cpf VARCHAR(15) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nivel ENUM('paciente','medico') DEFAULT 'paciente',
    telefone numeric(11)
)";

$conn->query($sql);


// =============================
// TABELA PACIENTE
// =============================

$sql = "CREATE TABLE IF NOT EXISTS paciente(
    id INT AUTO_INCREMENT PRIMARY KEY,
    fk_usuario_id INT,
    data_nascimento DATE NOT NULL,
    rua VARCHAR(50),
    numero_casa VARCHAR(10),
    bairro VARCHAR(25),
    cidade VARCHAR(30),
    altura FLOAT,
    peso FLOAT,
    contato_emergencia numeric(11)
)";

$conn->query($sql);


// =============================
// TABELA MEDICO
// =============================

$sql = "CREATE TABLE IF NOT EXISTS medico(
    id INT AUTO_INCREMENT PRIMARY KEY,
    fk_usuario_id INT,
    crm VARCHAR(13) NOT NULL,
    especialidade VARCHAR(50) NOT NULL
)";

$conn->query($sql);


// =============================
// TABELA ARQUIVOS
// =============================

$sql = "CREATE TABLE IF NOT EXISTS arquivos(
    id_arquivos INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    caminho VARCHAR(255) NOT NULL,
    descricao TEXT,
    anexo BLOB,
    tipo VARCHAR(25),
    data_emissao DATE NOT NULL,
    data_validade DATE NOT NULL,
    status VARCHAR(50),
    fk_paciente_id INT,
    fk_medico_id INT
)";

$conn->query($sql);


// =============================
// TABELA MEDICAMENTOS
// =============================

$sql = "CREATE TABLE IF NOT EXISTS medicamento_em_uso(
    id_medicamento INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    dosagem FLOAT NOT NULL,
    frequencia INT NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE,
    observacao VARCHAR(50),
    fk_medico_id INT,
    fk_paciente_id INT
)";

$conn->query($sql);


// =============================
// FOREIGN KEYS
// =============================

$conn->query("
ALTER TABLE paciente
ADD CONSTRAINT fk_paciente_usuario
FOREIGN KEY (fk_usuario_id)
REFERENCES usuarios(id)
ON DELETE CASCADE
ON UPDATE CASCADE
");

$conn->query("
ALTER TABLE medico
ADD CONSTRAINT fk_medico_usuario
FOREIGN KEY (fk_usuario_id)
REFERENCES usuarios(id)
ON DELETE CASCADE
ON UPDATE CASCADE
");

$conn->query("
ALTER TABLE arquivos
ADD CONSTRAINT fk_arquivos_paciente
FOREIGN KEY (fk_paciente_id)
REFERENCES paciente(id)
ON DELETE CASCADE
ON UPDATE CASCADE
");

$conn->query("
ALTER TABLE arquivos
ADD CONSTRAINT fk_arquivos_medico
FOREIGN KEY (fk_medico_id)
REFERENCES medico(id)
ON DELETE CASCADE
ON UPDATE CASCADE
");

$conn->query("
ALTER TABLE medicamento_em_uso
ADD CONSTRAINT fk_medicamento_paciente
FOREIGN KEY (fk_paciente_id)
REFERENCES paciente(id)
ON DELETE CASCADE
ON UPDATE CASCADE
");

$conn->query("
ALTER TABLE medicamento_em_uso
ADD CONSTRAINT fk_medicamento_medico
FOREIGN KEY (fk_medico_id)
REFERENCES medico(id)
ON DELETE CASCADE
ON UPDATE CASCADE
");

echo "Tabelas criadas/verificadas com sucesso.";

$conn->close();

?>