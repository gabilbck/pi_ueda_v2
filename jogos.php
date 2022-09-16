<?php
    session_start();
    include "include/MySql.php";
    include "include/functions.php";
?>
<head>
    <title>Jogos | UEDA</title>
</head>
<?php require("template/header1.php");?>
    <main>
        <br><br>
        <center>
            <h1>JOGOS</h1>
        </center>
        <br>
        <div class="margem-lados">
            <div class="principal-jogos">
                <div class="principais-text-jogos">
                    <h1 class="titulo_principal">Jogo do dino</h1>
                    <h1 class="subtitulo_principal">Desenvolvido por: 🤣</h1>
                </div>
                <div class="jogo_ueda">
                    <img src="./images/temp_image_jogos.png" alt="">    
                </div>
                <div class="principais-text-jogos2">
                    <h1 class="descricao_titulo">Descrição</h1>
                    <h1 class="descricao">Um simples jogo onde você controla um <br>dinossauro, onde seu objetivo é alcançar <br>a maior pontuação sem encostar nos obstáculos.</h1>
                    <h1 class="num_jogado">Categoria: Simples</h1>
                </div> 
            </div> <br><br><br><br><br><br>
            
        </div>
        <br><br>
    </main>
<?php require("template/footer1.php");?>