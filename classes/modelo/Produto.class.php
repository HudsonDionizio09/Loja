<?php

require_once(__DIR__ . "/./Marca.class.php");


class Produto {
    private $id;
    private $nome;
    private $preco;
    private $marca;

    public function __construct() {
        $this->marca = new Marca();
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getPrecoFormatado() {
        return 'R$ ' . number_format($this->preco, 2, ',', '.');
    }

    public function getMarca() {
        return $this->marca;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = strtoupper($nome);
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function setMarca(Marca $marca) {
        $this->marca = $marca;
    }
    
}