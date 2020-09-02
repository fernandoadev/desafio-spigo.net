<?php


include_once('config.php');
include_once('conexao.php');

class Delete extends conexao
{
    private $tabela;
    private $termos;
    private $values;
    private $resultado;
    private $query;
    private $conn;

    function getResultado(){
        return $this->resultado;
    }

    public function exeDelete($tabela, $termos, $parseString)
    {

        $this->tabela = (string) $tabela;
        $this->termos = (string) $termos;
        parse_str($parseString, $this->values);

        $this->executarInstrucao();
    }

    private function executarInstrucao()
    {
        $this->query = "DELETE FROM {$this->tabela} {$this->termos}";
        $this->conexao();
        try {

            $this->query->execute($this->values);
            $this->resultado = true;

        } catch (Exception $ex) {
            $this->resultado = false;
        }
    }

    private function conexao()
    {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }
}