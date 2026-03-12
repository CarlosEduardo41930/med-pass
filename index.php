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
    <link rel="icon" type="image/svg+xml" href="https://i.postimg.cc/xkk98Qgh/Med-Pass-Icon.png" alt="Med-Pass-Icon" />
    <title>Document</title>
</head>
<body>
    <main>
        <div class="container-1">
            <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass"></img>
            <h1>MedPass- Login</h1>
            <form method="post">
                <label for="cpf">CPF</label>
                <input type="number" placeholder="Digite seu CPF aqui" required> <!-- Troquei os campos cpf de todos os arquivos de text pra number pro cara nao conseguir colocar letra no campo (se precisar troca de volta pra text) -->

                <label for="senha">Senha</label>
                <input type="password" name="senha" placeholder="Digite aqui sua senha" required>

                <p>Não possui cadastro? <a href="btn_cadastro.php" class="ajuda"><strong>Fazer cadastro</strong></a></p>
                <p>Precisa de ajuda? <a href="#" class="ajuda"><strong>Clique aqui</strong></a></p>

                <button type="submit" class="btn">Entrar</button>
            </form>
        </div>
    </main>
</body>
</html>



