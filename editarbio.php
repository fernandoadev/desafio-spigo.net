<?php
session_start();
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($dados)){

    //INSTANCIANDO A CLASSE DE UPDATE
    include_once('update.php');
    $AttBio = new Update();
    $AttBio->exeUpdate("usuario", $dados, "WHERE id =:id", "id=" . $dados['id']);
    $reAttBio = $AttBio->getResultado();

    if($reAttBio){

        $_SESSION['msg'] = "<div class='alert alert-success'>Biografia Editada com sucesso !</div>";
        header('location: index.php');

       }else {

        $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi possivel Editar a biografia !</div>";
        header('location: index.php');

       }



}else {
    header('location: index.php');
}