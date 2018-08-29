<?php
require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Marca.class.php");
class MarcaDAO {
    private $conexao;
    function __construct() {
        $this->conexao = Conexao::get();
    }
    private function insert(Marca $marca) {
        $sql = "INSERT INTO tb_marcas (mar_nome) VALUES (:nome)";
        try {
            $statement = $this->conexao->prepare($sql);
            $nome = $marca->getNome();
            $statement->bindParam(':nome', $nome);
            $statement->execute();
            return $this->findById($this->conexao->lastInsertId());
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    private function update(Marca $marca) {
        $sql = "UPDATE tb_marcas SET mar_nome=:nome WHERE mar_id=:id";
        try {
            $statement = $this->conexao->prepare($sql);
            $nome = $marca->getNome();
            $id = $marca->getId();
            $statement->bindParam(':nome', $nome);
            $statement->bindParam(':id', $id);
            $statement->execute();
            return $this->findById($id);
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    
    public function save(Marca $marca) {
        if (is_null($marca->getId())) {
            return $this->insert($marca);
        } else {
            return $this->update($marca);
        }
    }
    public function remove($id) {
        $sql = "DELETE FROM tb_marcas WHERE mar_id=:id";
        try {
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function findAll() {
        $sql = "SELECT * FROM tb_marcas";
        $statement = $this->conexao->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $marcas = array();
        foreach ($rows as $row) {
            $marca = new Marca();
            $marca->setId($row['mar_id']);
            $marca->setNome($row['mar_nome']);
            array_push($marcas, $marca);
        }
        return $marcas;
    }
    public function findById($id) {
        $sql = "SELECT * FROM tb_marcas WHERE mar_id=:id";
        $statement = $this->conexao->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $row = $statement->fetch();
        $marca = new Marca();
        $marca->setId($row['mar_id']);
        $marca->setNome($row['mar_nome']);
        return $marca;
    }
}