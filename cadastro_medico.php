<?php

session_start();
require "conexao.php";

if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'medico') {
    echo 'Acesso negado!';
    header("Location: btn_cadastro.php");
    exit();
}

$nivel = $_SESSION['nivel'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirmar_senha = trim($_POST['confirmar_senha']);
    $cpf = trim($_POST['cpf']);
    $crm = trim($_POST['crm']);
    $especialidade = trim($_POST['especialidade']);
    $genero = trim($_POST['genero']);
    $telefone = trim($_POST['telefone']);




    if (!empty($email)) {

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {

            header("Location: index.php");
            exit();

    } else {

        if (Empty($nome) || empty($genero) || empty($email) || empty($cpf) || empty($senha) || empty($telefone) || $confirmar_senha !== $senha || empty($crm) || empty($especialidade) ) {
    
            echo "Campo vazio ou senha incoerente";
            exit();
        }
    
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    
        try {
    
    
            $sql = "INSERT INTO usuarios 
            (nome, genero, email, cpf, senha, nivel, telefone) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
            $stmt = $pdo->prepare($sql);
    
            $stmt->execute([
                $nome,
                $genero,
                $email,
                $cpf,
                $senhaHash,
                $nivel,
                $telefone
            ]);
    
        
            $id_usuario = $pdo->lastInsertId();
    
    
          
            $sql2 = "INSERT INTO medico 
            (fk_usuario_id, crm, especialidade) 
            VALUES (?, ?, ?)";
    
            $stmt2 = $pdo->prepare($sql2);
    
            $stmt2->execute([
                $id_usuario,
                $crm,
                $especialidade
            ]);
    
            header('Location: index.php');
    
        } catch (PDOException $e) {
    
            echo "Erro: " . $e->getMessage();
    
        }
}   
    }
}










    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
    <title>MedPass- Cadastro</title>
</head>
<body>
    <main>
        <div class="container-1">
            <!-- Botão para voltar pra página anterior :) -->
            <a href="btn_cadastro.php" class="botaoVoltar">&larr; Voltar</a>
    
            <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass"></img>
            <h1>Cadastro de Médico</h1>
            <form method="post" class="form-grid">
                <!-- Divisão em colunas pra conseguir fazer igual no protótipo -->
                <div class="coluna">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" placeholder="Digite seu nome aqui" required>
    
                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="Digite seu e-mail aqui" required>
    
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Digite sua senha" required>
    
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <input type="password" name="confirmar_senha" placeholder="Confirmar sua senha" required>
                    <p>Já possui uma conta? <strong><a href="#" class="ajuda">Faça login aqui</a></strong></p>
                    <p>Precisa de ajuda? <strong><a href="#" class="ajuda">Clique aqui!</a></strong></p>
                </div>

                <div class="coluna">
                    <label for="cpf">CPF</label>
                    <input type="number" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" maxlength="14" placeholder="Digite seu CPF aqui" required>
    
                    <label for="crm">CRM</label>
                    <input name="crm"  maxlength="12" type="number" placeholder="Digite seu telefone aqui" required>
    
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" required placeholder="Digite seu telefone">
    
                    <label for="especialidade">Especialidade</label>
                    <select name="esopecialidade" required>
                        <option value="">Selecione sua especialidade</option>
                        <option value="cardiologista">Cardiologista</option>
                        <option value="ortopedista">Ortopedista</option>
                    </select>
    
                    <label for="genero">Gênero</label>
                    <select name="genero" required>
                        <option value="">Selecione seu gênero</option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                    </select>
    
                    <button class="btn" type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>


