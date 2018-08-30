<?php
session_start();
$mensagem = "";
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/all.css">
    <link rel="icon" href="./assets/img/corredor.png">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <img src="./assets/img/corredor.png" width="30" height="30" class="d-inline-block align-top" alt="icone-da-página">
   Sports Senac
  </a>
</nav>
    <div class="container">
    <div class="row" style="margin-top: 50px;">
    <?=$mensagem;?>
    </div>
        <div class="row">
            <div class="col-12">
                <fieldset>
                    <legend>Login na Loja</legend>
                        <form action="Login.php" method="post">
                            <div class=class="form-group">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" name="login" id="login">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha">
                            </div>
                            <div class="form-group">
                                 <button type="submit" class="btn btn-primary" name="entrar" value="entrar"><i class="fas fa-sign-in-alt"></i> Logar</button>
                            </div>
                        </form>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>