<?php 
    include "../../include/MySql.php";
    include "../../include/functions.php";
    if (isset($_GET['id_art'])){
        $id_art = $_GET['id_art'];
        $sql = $pdo->prepare("DELETE FROM artigo WHERE id_art=?");
        if ($sql->execute(array($id_art))){
            echo "Artigo excluido com sucesso!";
            header('location:../listas/lista_art.php');
        } else{
            echo "Erro: dados não foram excluídos.<br>";
            echo "comando: $sql. <br>";
        }
    }
?>