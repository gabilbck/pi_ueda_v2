<?php
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";
?>
<head>
    <title>Cadastre Forum| UEDA</title>
</head>
<?php require("../template/header2.php");?>
    <main>
        <br><br>
        <center>
            <h1>PÁGINA DE ADMNISTRAÇÃO</h1>
        </center>
        <div class="margem-lados">
            <h2>Cadastros</h2>
            <button><a class="link-branco" href="listas/lista_bug.php">Reporte de Bugs</a></button>
            <button><a class="link-branco" href="listas/lista_usu.php">sdsdsd</a></button>
            <button><a class="link-branco" href="listas/">dsdsd</a></button>
            <button><a class="link-branco" href="listas/">sdds</a></button>
            <br><br><hr><br>
            <h2>Listagens</h2>
            <button><a class="link-branco" href="">Bug</a></button>
            <button><a class="link-branco" href=""></a></button>
            <button><a class="link-branco" href=""></a></button>
            <button><a class="link-branco" href=""></a></button>
            <br><br><hr><br>
        </div> 
    </main>
<?php require("../template/footer2.php");?>