<?php 
    include "../include/MySql.php";
    include "../include/functions.php";
    if (isset($_GET['cod_jogo'])){
        $cod_jogo = $_GET['cod_jogo'];
        $sql = $pdo->prepare("DELETE FROM jogos WHERE cod_jogo=?");
        if ($sql->execute(array($cod_jogo))){
            echo "Jogo excluido com sucesso!";
            header('location:adm_lista_jogo.php');
        } else{
            echo "Erro: dados não foram excluídos <br>";
            echo "comando: $sql. <br>";
        }
    }
?>