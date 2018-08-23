<?php
require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Sexo.class.php");
class SexoDAO {
    public function findAll() {
        $sql = "SELECT * FROM tb_sexos";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $sexos = array();
        foreach ($result as $row) {
            $sexo = new Sexo();
            $sexo->setId($row['sex_id']);
            $sexo->setNome($row['sex_nome']);
            $sexo->setSigla($row['sex_sigla']);
            array_push($sexos, $sexo);
        }
        return $sexos;
    }
    public function findById($id) {
        $sql = "SELECT * FROM tb_sexos WHERE sex_id = $id";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $row = $statement->fetch();
        $sexo = new Sexo();
        $sexo->setId($row['sex_id']);
        $sexo->setNome($row['sex_nome']);
        $sexo->setSigla($row['sex_sigla']);
        return $sexo;
    }
    public function save(Sexo $sexo) {
        if ($sexo->getId() == null) {
            $this->insert($sexo);
        } else {
            $this->update($sexo);
        }
    }
    
    private function insert(Sexo $sexo) {
        $sql = "INSERT INTO tb_sexos 
            (sex_nome, sex_sigla) 
            VALUES 
            ('{$sexo->getNome()}', '{$sexo->getSigla()}')";
        try {
            Conexao::get()->exec($sql);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
        
    private function update(Sexo $sexo) {
        $sql = "UPDATE tb_sexos SET 
            sex_nome='{$sexo->getNome()}', 
            sex_sigla='{$sexo->getSigla()}' 
            WHERE sex_id={$sexo->getId()}";
        try {
            Conexao::get()->exec($sql);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function remove($id) {
        $sql = "DELETE FROM tb_sexos WHERE sex_id=$id";
        try {
            Conexao::get()->exec($sql);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}