<!-- Arquivo de seleção do tipo de cadastro: Paciente ou -->

<?php
session_start();

if (isset($_POST['nivel']) && $_POST['nivel'] == 'medico') {

    $_SESSION['nivel'] = $_POST['nivel'];

    header("Location: cadastro_medico.php");
    exit();

} elseif(isset($_POST['nivel']) && $_POST['nivel'] == 'paciente') {

    $_SESSION['nivel'] = $_POST['nivel'];

    header("Location: cadastro_paciente.php");
    exit();
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
            <a href="index.php" class="botaoVoltar">&larr; Voltar</a> <!-- Voltar pra tela de login -->

            <img src="https://i.postimg.cc/VSSzvwD8/Med-Pass-Logo-(resolucao-maior).png" alt="Logo MedPass">
            <h1>Olá! Escolha seu tipo de cadastro</h1>
            <form action="POST">
                <button class="btn" type="submit" name="nivel" value="paciente">Cadastro de paciente</button>
                <button class="btn" type="submit" name="nivel" value="medico">Cadastro de médico</button>
            </form>
        </div>
    </main>
</body>
</html>


