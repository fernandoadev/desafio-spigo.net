<?php

include_once('config.php');

include_once('conexao.php');


class Read extends conexao

{
    
    private $select;
    private $values;
    private $resultado;
    private $query;
    private $Conn;

    function getResultado()
    {
        return $this->resultado;
    }

    public function exeRead($tabela, $termos = null, $parseString = null)//BUSCANDO TODAS AS COLUNAS
    {

        if (!empty($parseString)) {

            parse_str($parseString, $this->values);
        }
        $this->select = "SELECT * FROM {$tabela} {$termos}";

        $this->exeInstrucao();
    }

    public function fullRead($query, $parseString = null){ //BUSCANDO COLUNAS PACIALMENTE
        $this->select = (string) $query;

        if (!empty($parseString)) {

            parse_str($parseString, $this->values);
        }

        $this->exeInstrucao();
    }

    private function exeInstrucao()
    {
        $this->conexao();
        try {
            $this->getInstrucao();
            $this->query->execute();
            $this->resultado = $this->query->fetchAll();

        } catch (Exception $ex) {
            $this->resultado = null;
        }
    }

    private function conexao()
    {

        $this->Conn = parent::getConn();
        $this->query = $this->Conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function getInstrucao()
    {

        if ($this->values) {
            foreach ($this->values as $link => $valor) {
                if ($link == 'limit' || $link == 'offset') {
                    $valor = (int) $valor;
                }
                $this->query->bindValue(":{$link}", $valor, (is_int($valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}

