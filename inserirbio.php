<?php
session_start();
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($dados)) {

        $dados['created'] = date("Y-m-d H:i:s");

      //Instanciando classe de INSERT / CREATE
      include_once('create.php');
      $InserirBio = new Create();
      $InserirBio->exeCreate("usuario", $dados);
      $resultadoInserirBio = $InserirBio->GetResultado();

      
      if ($resultadoInserirBio) {

        $_SESSION['msg'] = "<div class='alert alert-success'>Biografia cadastrada com sucesso !</div>";
        header('location: index.php');

      }else {

        $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi possivel cadastrar a biografia no momento, tente namente mais tarde</div>";
        header('location: index.php');

      }



}else {
    header('location: index.php');
}

