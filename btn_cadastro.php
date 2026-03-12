
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container-1">
        <h1>Fazer cadastro como:</h1>
        <form method="POST">
            <button class="btn" type="submit" name="nivel" value="paciente">Paciente</button>
            <button class="btn" type="submit" name="nivel" value="medico">Médico</button>
        </form>   
    </div>
</body>
</html>


