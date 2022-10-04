<?php
    session_start();
    /* Essa página de "listagem" do fórum só pode ser utilizada se o
    usuário for cadastrado */
    include "../include/MySql.php";
    include "../include/functions.php";
?>
<head>
    <title>Fórum | UEDA</title>
</head>
<?php require("../template/header.php");?>
    <main>
        <br><br>
        <center>
            <h1>FÓRUM</h1>
        </center>
        <div class="margem-lados">
        </div>
        <br><br>
    </main>
<?php require("../template/footer.php");?>