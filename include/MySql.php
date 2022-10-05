<?php
    try{
        //Conexão
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=banco_ueda', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e){
        echo 'Erro: '.$e;
    }
?>