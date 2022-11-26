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
    
    <link href="../css/style.css?versao=5" rel="stylesheet">

    <link rel="shortcut icon" type="imagem/x-icon" href="../images/logo.png"/>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a class="logo" href="home.php" title="UEDA"><img src="../images/logo.png" width="70" alt="UEDA Logo"></a>  
    <a href="home.php">Home</a>
    <a href="menu_artigos.php">Artigos</a>
    <a href="menu_forum.php">Fórum</a>
    <a href="menu_jogos.php">Jogos</a>
    <a href="menu_sobre.php">Sobre</a>
    <?php if(array_key_exists("id_usu",$_SESSION) && $_SESSION['adm']){?>
        <a class="sair" href="adm.php">ADM</a>
    <?php }?>
    <?php if(!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){?>
        <a class="sair" href="cad_usu.php">Cadastrar-se</a>
    <?php } else{
        echo '<a class="sair" href="menu_sair.php">Sair</a>';
    }
    ?>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"><img src="../images/hamburguer.png"></i>
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