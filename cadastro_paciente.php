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
    <title>Document</title>
</head>
<body>
    
        <div class="container-1">
            <form method="POST">
                <label>
                    Nome
                </label>
                <input name="nome" type="text" placeholder="Digite seu nome aqui" required >
                <label>
                    Email
                </label>
                <input name="email" type="email" placeholder="Digite seu email aqui!" required >
                <label>
                    Senha
                </label>
                <input name="senha" type="password"  placeholder="Digite sua senha aqui" required>
                <label>
                    Confirmar Senha
                </label>
                <input name="confirmar_senha" type="password" placeholder="Confirme sua senha" required >
                <label>
                    CPF
                </label>
                <input name="cpf" type="text"   pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
                maxlength="14"  placeholder="Digite seu cpf aqui" required>
                <label>
                    Telefone
                </label>
                <input name="telefone"  type="tel" placeholder="Adicione seu telefone aqui" required>
                 <label>
                    Gênero
                </label>
                <select name="genero" required>
                    <option value="">Selecione seu gênero</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                </select>

                <button class="btn" type="submit">Cadastrar</button>
            </form>
        </div>
</body>
</html>


