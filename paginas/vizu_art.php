<?php require("../template/header.php");?>
<?php
    /* Visualização do artigo selecionado */

    $titulo = $_SESSION['titulo'];
    $intro = $_SESSION['intro'];
    $desc = $_SESSION['desc'];
    $img = $_SESSION['img'];
    $concl = $_SESSION['concl'];
    $ref = $_SESSION['ref'];
?> 
    <head>
        <title><?php echo $titulo ?> | UEDA</title>
    </head>
    <body>
    <div class="margem-lados">
        <?php 
        echo "<div class='container_art'>";
            echo "<div class='titulo_art'>";
                echo '<h1>'. $titulo. '</h1>'.'<br>';
            echo "</div>";
            echo "<div class='intro_art'>";
                echo '<p>'.$intro.'</p><br>';
            echo "</div>";
            echo "<div class='desc_art'>";
                echo '<p>'.$desc.'</p><br>';
            echo "</div>";
            echo "<div class='image_art'>";
                echo '<img src="data:image/jfifi;base64,'.$img.'"/>';
            echo "</div>";
            echo "<div class='conclusao_art'>";
                echo '<p>'.$concl.'</p><br>';
            echo '</div>';
            echo '<hr>';
            echo '<br>';
            echo '<b> Referências: </b>';
            echo "<div class='referencia'>";
                echo '<p>'.$ref.'</p><br>';
            echo "</div>";
        echo '</div>';
        ?>
       </div> 
    </body>     
</html>
<?php require("../template/footer.php")?>