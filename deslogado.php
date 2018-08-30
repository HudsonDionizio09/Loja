<?php

session_start();
$homeProduto = "/loja/produto/";
if (isset($_SESSION['isLogado']) && $_SESSION['isLogado']) {
    header("location: $homeProduto");
}