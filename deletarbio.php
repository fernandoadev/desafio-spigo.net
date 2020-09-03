<?php
session_start();


$id = $_GET['id'];

if (isset($id)){

       //INSTANCIANDO CLASSE DE DELETE
       include_once('delete.php');
       $Deletbio = new Delete();
       $Deletbio->exeDelete("usuario", "WHERE id =:id", "id=" . $id);
       $ResultadoDeletbio = $Deletbio->getResultado();

       if($ResultadoDeletbio){

        $_SESSION['msg'] = "<div class='alert alert-success'>Biografia Deletada com sucesso !</div>";
        header('location: index.php');

       }else {

        $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi possivel deletar a biografia !</div>";
        header('location: index.php');

       }

}else {
    header('location: index.php');
}