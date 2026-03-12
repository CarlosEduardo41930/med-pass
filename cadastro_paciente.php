<?php

session_start();
require "conexao.php";

if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'paciente') {
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
    $telefone = trim($_POST['telefone']);
    $genero = trim($_POST['genero']);


   if (!empty($email)) {

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {

        header("Location: index.php");
        exit();

    } else {

        if ( empty($nome) || empty($email) || empty($senha) || empty($cpf) || empty($telefone) || empty($genero) || $confirmar_senha !== $senha ) {

            echo "Campo vazio ou senha incoerente";

        } else {

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nome, genero, email, cpf, senha, nivel, telefone) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $nome,
                $genero,
                $email,
                $cpf,
                $senhaHash,
                $nivel,
                $telefone,
                
            ]);

            header('Location: index.php');
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
    <title>MedPass- Cadastro paciente</title>
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
                    <label for="bDate">Data de nascimento</label> <!-- Adicionar nascimento pq ta no figma -->
                    <input type="date" name="bDate" required>

                    <label for="cpf">CPF</label>
                    <input name="cpf" type="number" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" maxlength="14" placeholder="Digite seu CPF aqui" required>
    
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" required placeholder="Digite seu telefone">
    
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


