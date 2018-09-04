<?php

require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Bairro.class.php");
require_once(__DIR__ . "/../modelo/UnidadeFederativa.class.php");

class BairroDAO {

    private $conexao;
    function __construct() {
        $this->conexao = Conexao::get();
    }

    public function findAll() {
        $sql = "SELECT * FROM tb_cidades LEFT JOIN tb_ufs ON uf_id=cid_uf_id";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $cidades = array();
        foreach ($rows as $row) {
            $uf = new UnidadeFederativa();
            $uf->setId($row['uf_id']);
            $uf->setNome($row['uf_nome']);
            $uf->setSigla($row['uf_sigla']);
            $cidade = new Cidade();
            $cidade->setId($row['cid_id']);
            $cidade->setNome($row['cid_nome']);
            $cidade->setUnidadeFederativa($uf);
            array_push($cidades, $cidade);
        }
        return $cidades;
    }

    public function findById($id) {
        $sql = "SELECT * FROM tb_ufs WHERE uf_id=:id";
        $statement = $this->conexao->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $row = $statement->fetch();
        $uf = new UnidadeFederativa();
        $uf->setId($row['uf_id']);
        $uf->setNome($row['uf_nome']);
        $uf->setSigla($row['uf_sigla']);
        return $uf;
    }
    
    public function findByUnidadeFederativa(UnidadeFederativa $uf) {
        $sql = "SELECT * FROM tb_cidades LEFT JOIN tb_ufs ON uf_id=cid_uf_id WHERE uf_id=:uf_id";
        $statement = $this->conexao->prepare($sql);
        $uf_id = $uf->getId();
        $statement->bindParam(':uf_id', $uf_id);
        $statement->execute();
        $rows = $statement->fetchAll();
        $cidades = array();
        foreach ($rows as $row) {
            $uf = new UnidadeFederativa();
            $uf->setId($row['uf_id']);
            $uf->setNome($row['uf_nome']);
            $uf->setSigla($row['uf_sigla']);
            $cidade = new Cidade();
            $cidade->setId($row['cid_id']);
            $cidade->setNome($row['cid_nome']);
            $cidade->setUnidadeFederativa($uf);
            array_push($cidades, $cidade);
        }
        return $cidades;
    }
}