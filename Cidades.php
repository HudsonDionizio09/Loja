<?php
require_once(__DIR__ . "/./classes/modelo/UnidadeFederativa.class.php");
require_once(__DIR__ . "/./classes/modelo/Cidade.class.php");
require_once(__DIR__ . "/./classes/dao/CidadeDAO.class.php");
$uf_id = $_GET['uf'];
$uf = new UnidadeFederativa();
$uf->setId($uf_id);
$dao = new CidadeDAO();
$cidades = $dao->findByUnidadeFederativa($uf);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cidades</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
    <label for="cidade">Cidade</label>
    <select class="form-control" name="cidade" id="cidade">
        <option value="0" selected disabled>--SELECIONE--</option>
        <?php foreach($cidades as $cidade): ?>
            <option value="<?=$cidade->getId();?>">
                <?=$cidade->getNome();?>
            </option>
        <?php endforeach; ?>
    </select>
</body>
</html>