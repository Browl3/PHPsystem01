<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"]);
    $senha   = $_POST["senha"];

    if (file_exists("usuario.json")){
        $usuarios = json_decode(file_get_contents("usuarios.json"), true);
    }else{
        $usuarios = [];
    }
    if ($usuario == ""){
        $mensagem = "Digite um nome de usuario";
    } elseif (strlen($senha)<4){
        $mensagem = "Senha precisa ter no minimo 4 caracteres";
    } elseif (isset($usuarios[$usuario])) {
        $mensagem = "Esse usuario ja existe";
    }else {
        $usuarios[$usuario] = password_hash($senha, PASSWORD_DEFAULT);
        file_put_contents("usuarios.json", json_encode($usuarios));
        $mensagem = "conta criada com sucesso!";
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Criar conta</h1>
    <form method="post" >
        <p><input type="text" name="usuario" placeholder="Escolha um usuario" ></p>
        <p><input type="password" name="senha" placeholder="Escolha um usuario" ></p>
        <button>Cadastrar</button>
    </form>
    <p> <a href="login.php">Ja tenho conta</a> </p>
</body>
</html>