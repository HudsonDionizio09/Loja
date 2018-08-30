<?php require_once(__DIR__ . "/../classes/modelo/Marca.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/MarcaDAO.class.php"); ?>
<?php 
$dao = new MarcaDAO();
$marca = new Marca();
if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $marca->setNome($_POST['marca']);
    if ($_POST['id'] != '') {
        $marca->setId($_POST['id']);
    }
    $dao->save($marca);
    header('location: index.php');
}
if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $marca = $dao->findById($_POST['id']);
}
if (isset($_POST['remover']) && $_POST['remover'] == 'remover') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}
$marcas = $dao->findAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="icon" href="../assets/img/marcas.png">
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
            <div class="col-6"><!-- form -->
                <fieldset>
                    <legend>Dados da Marca</legend>
                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value="<?=$marca->getId();?>">
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" name="marca" id="marca" maxlength="12" required value="<?=$marca->getNome();?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </fieldset>
            </div>
            <div class="col-6"><!-- table -->
                <fieldset>
                    <legend>Lista de Marcas</legend>
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Marcas</th>
                                <th colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($marcas as $marca): ?>
                                <tr>
                                    <td><?=$marca->getId();?></td>
                                    <td><?=$marca->getNome();?></td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$marca->getId();?>">
                                            <button type="submit" class="btn  btn-sm btn-info" name="editar" value="editar"><i class="fas fa-marker"></i></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$marca->getId();?>">
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
</body>
</html>