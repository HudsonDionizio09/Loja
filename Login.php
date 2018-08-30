<?php

require_once(__DIR__ . "/./classes/modelo/User.class.php");

session_start();

$user = new User("hudsondionizio@hotmail.com", "hudson4321");
$login = $_POST['login'];
$senha = $_POST['senha'];
if ($user->logar($login, $senha)) {
    $_SESSION['isLogado'] = true;
    header('location: /loja/produto/');
} else {
    $_SESSION['isLogado'] = false;
    $_SESSION['mensagem'] = "Login ou Senha inválidos!!!";
    header('location: /loja/');
}
