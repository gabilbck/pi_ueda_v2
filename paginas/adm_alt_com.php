<?php
session_start();
include_once "../include/MySql.php";
include_once "../include/functions.php";

    if(!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
        header("location:n_adm_msg.php");
        die;
    } else{
        if($_SESSION['adm'] != 1){
            header("location:n_adm_msg.php");
            die;
        } else{
            require("../template/header_s_php.php");
        }
    }
?>
<head>
    <title>Alterar Comentário (de uma publicação do fórum</title>
</head>
    <main>
        <div class="margem-lados">
        <center>
                <br><br>
                <h1>ALTERAR COMENTÁRIO</h1>
                <br>
                <h2>Implementação futura...</h2>
                <br><br>
            </center>
    </main>
<?php require("../template/footer.php");?>