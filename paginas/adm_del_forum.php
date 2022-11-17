<?php 
    include "../include/MySql.php";
    include "../include/functions.php";
    if (isset($_GET['id_publi'])){
        $id_publi = $_GET['id_publi'];
        $sql = $pdo->prepare("DELETE FROM publica_forum WHERE id_publi=?");
        if ($sql->execute(array($id_publi))){
            header('location:adm_lista_forum.php');
        } else{
            echo "Erro: dados não foram excluídos.<br>";
            echo "comando: $sql. <br>";
        }
    }
?>