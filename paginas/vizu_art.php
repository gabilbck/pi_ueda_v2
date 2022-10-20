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
    <head>
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