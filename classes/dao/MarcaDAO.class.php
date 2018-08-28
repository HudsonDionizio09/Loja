<?php
require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Marca.class.php");


class MarcaDAO {
    public function findAll() {
        $sql = "SELECT * FROM tb_marcas";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $sexos = array();
        foreach ($result as $row) {
            $marca = new Marca();
            $marca->setId($row['mar_id']);
            $marca->setNome($row['mar_nome']);
            $marca->setSigla($row['sex_sigla']);
            array_push($marcas, $marca);
        }
        return $sexos;
    }
    public function findById($id) {
        $sql = "SELECT * FROM tb_sexos WHERE sex_id = $id";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $row = $statement->fetch();
        $marca = new Marca();
        $marca->setId($row['sex_id']);
        $marca->setNome($row['sex_nome']);
        $marca->setSigla($row['sex_sigla']);
        return $marca;
    }
    public function save(Marca $marca) {
        if ($marca->getId() == null) {
            $this->insert($marca);
        } else {
            $this->update($marca);
        }
    }
    
    private function insert(Marca $marca) {
        $sql = "INSERT INTO tb_marca 
            (mar_id, mar_nome) 
            VALUES 
            ('{$marca->getNome()}', '{$marca->getSigla()}')";
        try {
            Conexao::get()->exec($sql);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
        
    private function update(Marca $marca) {
        $sql = "UPDATE tb_sexos SET 
            mar_id='{$marca->getNome()}', 
            sex_nome='{$marca->getSigla()}' 
            WHERE sex_id={$marca->getId()}";
        try {
            Conexao::get()->exec($sql);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function remove($id) {
        $sql = "DELETE FROM tb_marcas WHERE mar_id=$id";
        try {
            Conexao::get()->exec($sql);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}