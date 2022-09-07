<?php 
    /* Deve ser feito o php da página, para que mostre esses artigos
    registrados ao usuário, tendo a mesma função que as listagens,
    no entanto, NÃO POSSUEM funções como exclusão o alteração dos artigos */

    // include "include/MySql.php";
    // include "include/functions.php";
?>
<head>
    <title>Artigos | UEDA</title>
</head>
<?php require("template/header1.php");?>
    <main>
        <div class="margem-lados">
            <br><Br>
            <center>
                <h1>ARTIGOS</h1>
            </center>
            <div class="margem-titulo"></div>
            <div class="artigo">
                <a href="#"><h2>Título do Artigo</h2></a>
                <div class="margem-art"></div>
                <a class="et-artc" href="#">Art. Científico</a>
                <div class="margem-art"></div>
                <p>Breve descrição do artigo</p>
                <div class="margem-art"></div>
                <a href="#">Ver Agora</a>
                <hr>
            </div>
            <br>
            <div class="artigo">
                <a href="#"><h2>Título do Artigo</h2></a>
                <div class="margem-art"></div>
                <a class="et-not" href="#">Notícia</a>
                <div class="margem-art"></div>
                <p>Breve descrição do artigo</p>
                <div class="margem-art"></div>
                <a href="#">Ver Agora</a>
                <hr>
            </div>
            <br>
            <div class="artigo">
                <a href="#"><h2>Título do Artigo</h2></a>
                <div class="margem-art"></div>
                <a class="et-site" href="#">Art. de Site</a>
                <div class="margem-art"></div>
                <p>Breve descrição do artigo</p>
                <div class="margem-art"></div>
                <a href="#">Ver Agora</a>
                <hr>
            </div>
            <br>
        </div>
        <br>
    </main>
<?php require("template/footer1.php");?>