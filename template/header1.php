<!-- ATENÇÃO!!!!!!!!!!
Header APENAS para as páginas que NÃO estão DENTRO de pastas! -->
<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!--negrito-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!--texto-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&family=Poppins:wght@200;300&family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">

    <link rel="shortcut icon" type="imagem/x-icon" href="images/slogan_azul.png"/>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a class="logo" href="index.php" title="UEDA"><img src="images/slogan_branco.png" width="70" alt="UEDA Logo"></a>  
    <a href="index.php">Home</a>
    <a href="artigos.php">Artigos</a>
    <a href="forum.php">Fórum</a>
    <a href="jogos.php">Jogos</a>
    <a href="sobre.php">Sobre</a>
    <?php if($_SESSION['adm']){?>
        <a class="sair" href="adm/adm.php">ADM</a>
    <?php }?>
    <a class="sair" href="login/cadastro.php">Cadastrar-se</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"><img src="images/hamburguer.png"></i>
    </a>
</div>
<div class="clear"></div>
<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
              x.className = "topnav";
        }
    }
</script>