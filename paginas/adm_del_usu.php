<?php 
    include "../include/MySql.php";
    include "../include/functions.php";
    if (isset($_GET['id_usu'])){
        $id_usu = $_GET['id_usu'];
        $sql = $pdo->prepare("DELETE FROM usuario WHERE id_usu=?");
        if ($sql->execute(array($id_usu))){
            header('location:adm_lista_usu.php');
        } else{
            echo "Erro: dados não foram excluídos <br>";
            echo "comando: $sql. <br>";
        }
    }
?>