<?php

require_once  __DIR__ . "/classes/modelo/Sexo.class.php";
require_once __DIR__ . "/classes/dao/SexoDAO.class.php";

$dao = new SexoDAO();

$sexo = new Sexo();
$sexo->setNome('MASCULINO');

$dao->update($sexo);
