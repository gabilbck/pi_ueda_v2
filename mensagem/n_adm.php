<?php
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";
?>
<head>
    <title>VOCÊ NÃO POSSUI ACESSO À PÁGINA! | UEDA</title>
</head>
<?php require("../template/header2.php");?>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>VOCÊ NÃO POSSUI ACESSO À PÁGINA!</h1>
                <br>
                <h2>Volte à página principal ou inicie uma nova sessão:</h2>
                <br>
                <a href="../index.php"><button>PÁGINA PRINCIPAL</button></a>
                <a href="../login/login.php"><button>LOGIN</button></a>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer2.php");?>