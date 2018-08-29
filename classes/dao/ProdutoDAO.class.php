<?php
require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Produto.class.php");
require_once(__DIR__ . "/../modelo/Marca.class.php");
class ProdutoDAO {
    private $conexao;
    function __construct() {
        $this->conexao = Conexao::get();
    }
    private function insert(Produto $produto) {
        $sql = "INSERT INTO tb_produtos (pro_nome, pro_preco, pro_mar_id) VALUES (:nome, :preco, :marca)";
        try {
            $statement = $this->conexao->prepare($sql);
            $nome = $produto->getNome();
            $preco = $produto->getPreco();
            $marca = $produto->getMarca()->getId();
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':nome', $nome);
            $statement->bindParam(':preco', $preco);
            $statement->bindParam(':marca', $marca);
            $statement->execute();
            return $this->findById($this->conexao->lastInsertId());
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    private function update(Produto $produto) {
        $sql = "UPDATE tb_produtos SET pro_nome=:nome, pro_preco=:preco, pro_mar_id=:marca WHERE pro_id=:id";
        try {
            $conexao = Conexao::get();
            $statement = Conexao::get()->prepare($sql);
            $statement->bindParam(':nome', $produto->getNome());
            $statement->bindParam(':preco', $produto->getPreco());
            $statement->bindParam(':marca', $produto->getMarca()->getId());
            $statement->bindParam(':id', $produto->getId());
            $statement->execute();
            return $this->findById($produto->getId());
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    
    public function save(Produto $produto) {
        if (is_null($produto->getId())) {
            return $this->insert($produto);
        } else {
            return $this->update($produto);
        }
    }
    public function remove($id) {
        $sql = "DELETE FROM tb_produtos WHERE pro_id=:id";
        try {
            $statement = Conexao::get()->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function findAll() {
        $sql = "SELECT * FROM tb_produtos LEFT JOIN tb_marcas ON mar_id=pro_mar_id";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();
        $produtos = array();
        foreach ($rows as $row) {
            $marca = new Marca();
            $marca->setId($row['mar_id']);
            $marca->setNome($row['mar_nome']);
            $produto = new Produto();
            $produto->setId($row['pro_id']);
            $produto->setNome($row['pro_nome']);
            $produto->setPreco($row['pro_preco']);
            $produto->setMarca($marca);
            array_push($produtos, $produto);
        }
        return $produtos;
    }
    public function findById(int $id) {
        $sql = "SELECT * FROM tb_produtos LEFT JOIN tb_marcas ON mar_id=pro_mar_id WHERE pro_id=:id";
        $statement = Conexao::get()->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $row = $statement->fetch();
        $marca = new Marca();
        $marca->setId($row['mar_id']);
        $marca->setNome($row['mar_nome']);
        $produto = new Produto();
        $produto->setId($row['pro_id']);
        $produto->setNome($row['pro_nome']);
        $produto->setPreco($row['pro_preco']);
        $produto->setMarca($marca);
        return $produto;
    }
}