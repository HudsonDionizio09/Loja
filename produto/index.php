<?php
require_once(__DIR__ . "/../classes/modelo/Marca.class.php");
require_once(__DIR__ . "/../classes/dao/MarcaDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Produto.class.php");
require_once(__DIR__ . "/../classes/dao/ProdutoDAO.class.php");

include(__DIR__ . "/../logado.php");

$home = "/loja/produto/";
$produto = new Produto();
$marcaDao = new MarcaDAO();
$produtoDao = new ProdutoDAO();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $produto->setNome($_POST['produto']);
    $produto->setPreco($_POST['preco']);
    $produto->getMarca()->setId($_POST['marca']);
    if ($produto->getMarca()->getId() == 0) {
        $produto->getMarca()->setId(null);
    }
    if ($_POST['id'] != '') {
        $produto->setId($_POST['id']);
    }
    $produtoDao->save($produto);
    header('location: index.php');
}
if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $produto = $produtoDao->findById($_POST['id']);
}
if (isset($_POST['remover']) && $_POST['remover'] == 'remover') {
    $produtoDao->remove($_POST['id']);
    header('location: index.php');
}
$marcas = $marcaDao->findAll();
$produtos = $produtoDao->findAll();
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="icon" href="../assets/img/carrinho-de-compra.png">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"><!-- Barra de navegação-->
  <a class="navbar-brand" href="http://localhost:8080/loja/produto">Produtos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-brand active">
        <a class="nav-link" href="http://localhost:8080/loja/marca">Marca<span class="sr-only"></span></a>
      </li>
      <li class="nav-brand active">
        <a class="nav-link" href="http://localhost:8080/loja/sexo">Sexo</a>
      </li>
    </ul>
    <form class="form-inline">
    <a class="btn btn-warning my-2 my-sm-0" type="submit" href="http://localhost:8080/loja/logout.php"><i class="fas fa-sign-out-alt"></i>  Sair </a>
    </form>
  </div>
</nav>
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-6"><!-- Formulario -->
                <fieldset>
                    <legend>Dados do Produto</legend>
                    <form method="post">
                        <input type="hidden" name="id" value="<?=$produto->getId();?>">
                        <div class="form-group"><!-- input produto -->
                            <label for="produto">Produto</label>
                            <input type="text" class="form-control" name="produto" id="produto" value="<?=$produto->getNome();?>">
                        </div>
                        <div class="form-group"><!-- select marca -->
                            <label for="marca">Marca</label>
                            <select class="form-control" name="marca" id="marca">
                                <option value="0" disabled selected> Selecione </option>
                                <?php foreach($marcas as $marca): ?>
                                    <?php
                                        $selected = "";
                                        if ($marca->getId() == $produto->getMarca()->getId()) {
                                            $selected = "selected";
                                        }
                                    ?>
                                    <option value="<?=$marca->getId();?>" <?=$selected;?>>
                                        <?=$marca->getNome();?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group"><!-- input preco -->
                            <label for="preco">Preço</label>
                            <input type="text" class="form-control" name="preco" id="preco" value="<?=$produto->getPreco();?>">
                        </div>
                        <div class="form-group"><!-- button salvar -->
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </fieldset>
            </div>
            <div class="col-6"><!-- Tabela -->
                <fieldset>
                    <legend>Lista de Produtos</legend>
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Produtos</th>
                                <th>Marcas</th>
                                <th>Preços</th>
                                <th>Ações</th>                        
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($produtos as $produto): ?>
                                <tr>
                                    <td><?=$produto->getId();?></td>
                                    <td><?=$produto->getNome();?></td>
                                    <td><?=$produto->getMarca()->getNome();?></td>
                                    <td><?=$produto->getPreco();?></td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?=$produto->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?=$produto->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="remover" value="remover"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
    <script src="../assets/js/produto.js"></script> 
</body>
</html>