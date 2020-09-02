<?php


include_once('config.php');
include_once('conexao.php');


class Update extends conexao
{
    private $tabela;
    private $dados;
    private $query;
    private $conn;
    private $resultado;
    private $termos;
    private $values;

    function getResultado()
    {
        return $this->resultado;
    }

    public function exeUpdate($tabela, array $dados, $termos = null, $parseString = null)
    {

        $this->tabela = (string) $tabela;
        $this->dados = $dados;
        $this->termos = (string) $termos;

        parse_str($parseString, $this->values);
        $this->getInstrucao();
        $this->executarInstrucao();
    }

    private function getInstrucao()
    {
        foreach ($this->dados as $key => $value) {
            $values[] = $key . '= :' . $key;
        }
        $values = implode(', ', $values);
        $this->query = "UPDATE {$this->tabela} SET {$values} {$this->termos}";
    }

    private function executarInstrucao()
    {
        $this->conexao();
        try {
            $this->query->execute(array_merge($this->dados, $this->values));
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
