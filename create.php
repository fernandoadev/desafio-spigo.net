<?php

include_once('config.php');

include_once('conexao.php');

class Create extends conexao
{

    private $tabela;
    private $dados;
    private $query;
    private $conn;
    private $resultado;

    function getResultado()
    {
        return $this->resultado;
    }
    public function exeCreate($tabela, array $dados)
    {
        $this->tabela = (string) $tabela;
        $this->dados = $dados;
        //var_dump($this->dados);

        $this->getInstrucao();
        $this->executarInstrucao();
    }

    private function getInstrucao()
    {
        $colunas = implode(', ', array_keys($this->dados));
        $valores = ':' . implode(', :', array_keys($this->dados));
        $this->query = "INSERT INTO {$this->tabela} ({$colunas}) VALUES ({$valores})";
        //echo "$this->query";
    }

    private function executarInstrucao()
    {
        $this->conexao();
        try {
            $this->query->execute($this->dados);
            $this->resultado = $this->conn->lastInsertId();
        } catch (Exception $ex) {
            $this->resultado = null;
        }
    }

    private function conexao()
    {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }
}


