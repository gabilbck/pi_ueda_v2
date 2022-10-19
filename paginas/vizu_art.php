<?php require("../template/header.php");?>
<?php
    /* Visualização do artigo selecionado */

    $titulo = $_GET['titulo'];
    $intro = $_GET['intro'];
    $desc = $_GET['desc'];
    $img = $_GET['img'];
    $concl = $_GET['concl'];
    $ref = $_GET['ref'];
?> 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php 

        echo '<h1>'.$titulo.'</h1><br>';
        echo '<p>'.$intro.'</p><br>';
        echo '<p>'.$desc.'</p><br>';
        echo '<img src="data:image/jpg;charset=utf8;base64,'.base64_encode($img).'"/>';
        echo '<p>'.$concl.'</p><br>';
        echo '<p>'.$ref.'</p><br>';
        ?>
    </body>     
</html>
<?php require("../template/footer.php")?>