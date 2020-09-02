<?php
session_start();


$id = $_GET['id'];

if (isset($id)){

      //INSTANCIO A CLASSE DE UPDATE
      include_once('update.php');



}else {
    header('location: index.php');
}