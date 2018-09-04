<?php

require_once(__DIR__ . "/./cidade.class.php");

class Bairro {

    private $id;
    private $nome;
    private $uf;
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }
    
    public function getUnidadeFederativa() {
        return $this->uf;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = strtoupper($nome);
    }
    
    public function setUnidadeFederativa(UnidadeFederativa $uf) {
        $this->uf = $uf;
    }
}