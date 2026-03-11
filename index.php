<?php

session_start();
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cpf = trim($_POST['cpf']);
    $senha = trim($_POST['senha']);

    $sql = "SELECT senha, nivel FROM usuarios WHERE cpf = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cpf]);

   $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
    
        $_SESSION['nivel'] = $usuario['nivel'];
    
        if ($usuario['nivel'] == 'medico') {
    
            header("Location: pgMedico.php");
            exit();
    
        } elseif ($usuario['nivel'] == 'paciente') {
    
            header("Location: pgPaciente.php");
            exit();
    
        }
    
    } else {
    
        echo 'Usuário ou senha incorretos!';
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
                    CPF
                </label>
                <input name="cpf" type="text" required placeholder="Digite seu cpf aqui!">
                
                <label>
                    Senha
                </label>
                <input name="senha" type="password" required placeholder="Digite sua senha aqui">
                <a href="btn_cadastro.php">Não possui cadastro? Fazer Cadastro!</a>
                <button class="btn" type="submit">Entrar</button>
            </form>
        </div>
</body>
</html>



