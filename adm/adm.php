<?php
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";
    // include "../include/adm_verifica.php";
?>
<head>
    <title>Cadastre Forum | UEDA</title>
</head>
<?php require("../template/header2.php");?>
    <main>
        <br><br>
        <center>
            <h1>PÁGINA DE ADMNISTRAÇÃO</h1>
        </center>
        <br>
        <div class="margem-lados">
            <h2>Cadastros</h2>
            <button><a class="link-branco" href="../login/cadastro.php">Usuários</a></button>
            <button><a class="link-branco" href="../artigos/cad_art.php">Artigos</a></button>
            <button><a class="link-branco" href="../etiquetas/cad_eti.php">Etiquetas</a></button>
            <button><a class="link-branco" href="../bug.php">Reporte de Bugs</a></button>
            <button><a class="link-branco" href="../forum/cad_for.php">Fórum</a></button>
            <button><a class="link-branco" href="../jogo/cad_jogo.php">Jogos</a></button>
            <br><br><hr><br>
            <h2>Listagens</h2>
            <button><a class="link-branco" href="listas/lista_usu.php">Usuários</a></button>
            <button><a class="link-branco" href="listas/lista_art.php">Artigos</a></button>
            <button><a class="link-branco" href="listas/lista_eti.php">Etiquetas</a></button>
            <button><a class="link-branco" href="listas/lista_bug.php">Reporte de Bugs</a></button>
            <button><a class="link-branco" href="listas/lista_forum.php">Fórum</a></button>
            <button><a class="link-branco" href="listas/lista_jogo.php">Jogos</a></button>
            <br><br><hr><br>
        </div> 
    </main>
<?php require("../template/footer2.php");?>