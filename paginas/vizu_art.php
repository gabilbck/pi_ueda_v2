<?php require("../template/header.php");?>
<?php
    /* Visualização do artigo selecionado */

    $titulo = $_SESSION['titulo_vizu'] ?? NULL;
    $intro = $_SESSION['intro_vizu'] ?? NULL;
    $desc = $_SESSION['desc_vizu'] ?? NULL;
    $img = $_SESSION['img_vizu'] ?? NULL;
    $concl = $_SESSION['concl_vizu'] ?? NULL;
    $ref = $_SESSION['ref_vizu'] ?? NULL;
?> 
    <head>
        <title><?php echo $titulo ?> | UEDA</title>
    </head>
    <body>
    <div class="margem-lados">
        <br>
        <?php 
        echo "<div class='container_art'>";
            echo "<div class='titulo_art'>";
                echo '<h1>'. $titulo. '</h1>';
            echo "</div>";
            echo "<div class='intro_art'>";
                echo '<p>'.$intro.'</p><br>';
            echo "</div>";
            echo "<div class='desc_art'>";
                echo '<p>'.$desc.'</p><br>';
            echo "</div>";
            echo "<div class='image_art'>";
                echo '<img style="width: 500px;" src="data:image/jfifi;base64,'.$img.'"/>';
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