<?php require_once __DIR__ . "/../classes/modelo/Sexo.class.php";?>
<?php require_once __DIR__ . "/../classes/dao/SexoDAO.class.php";?>
<?php
$dao = new SexoDAO();
$sexo = new Sexo();
if(isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $sexo->setNome($_POST['sexo']);
    $sexo->setSigla($_POST['sigla']);
    $dao->save($sexo);
    header('location: index.php');
}
if(isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $sexo = $dao->findbyId($_POST['id']);
}

if(isset($_POST['remover']) && $_POST['remover'] == 'remover') {
    $dao->remove($_POST['id']);
    header('location: index.php');
}

$sexos = $dao->findAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sexos</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="icon" href="../assets/img/usuario.png">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"><!-- Barra de navegação-->
  <a class="navbar-brand" href="http://localhost:8080/loja/produto">Produtos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost:8080/loja/marca">Marca<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost:8080/loja/sexo">Sexo</a>
      </li>
    <form class="form-inline my-2 my-lg-0">
        <a class="btn btn-warning my-2 my-sm-0" type="submit" href="http://localhost:8080/loja/logout.php"><i class="fas fa-sign-out-alt"></i>  Sair </a>
    </form>
    </ul>
  </div>
</nav>
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-6"><!--form-->
                <fieldset>
                    <legend>Dados do Sexo</legend>
                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value"<?=$sexo->getId();?>">
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <input type="text"  class="form-control" name="sexo" id="sexo" maxlength="12" required value="<?=$sexo->getNome();?>">
                        </div>
                        <div class="form-group">
                            <label for="sigla">Sigla</label>
                            <input type="text"  class="form-control" name="sigla" id="sigla" maxlength="1" required value="<?=$sexo->getNome();?>">
                        </div>
                        <div class="form-group">
                                 <button type="submit" class="btn btn-primary" name="salvar" value="salvar"><i class="fas fa-save"></i> Salvar </button>
                        </div>
                    </form>
                </fieldset>
            </div>
            <div class="col-6"><!--table -->
                <fieldset>
                    <legend>Lista de Sexo</legend>
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sexo</th>
                                <th>Sigla</th>
                                <th colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach($sexos as $sexo):  ?>
                                <tr>
                                    <td><?=$sexo->getId();?></td>
                                    <td><?=$sexo->getNome();?></td>
                                    <td><?=$sexo->getSigla();?></td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$sexo->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-primary" name="editar" value="editar"><i class="fas fa-user-edit"></i></button>
                                        </form>   
                                    </td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$sexo->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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