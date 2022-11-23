<?php require("../template/header.php");?>
<?php
    /* Visualização do artigo selecionado */
    $id_art = $_GET['id_art'];
    $sql = $pdo->prepare('SELECT * FROM artigo WHERE id_art =?');
    if ($sql->execute(array($id_art))){
        $info = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($info as $key => $value){
            $titulo = $value['titulo_art'] ?? NULL;
            $intro = $value['intro_art'] ?? NULL;
            $des = $value['des_art'] ?? NULL;
            $img = $value['img_art'] ?? NULL;
            $con = $value['con_art'] ?? NULL;
            $ref = $value['ref_art'] ?? NULL;
        }
    }
?> 
    <head>
        <title><?php echo $titulo ?> | UEDA</title>
    </head>
    <body>
    <div class="margem-lados">
        <br><br>
        <?php 
        echo "<div class='container_art'>";
            echo "<div class='titulo_art'>";
                echo '<h1>'. $titulo. '</h1>';
            echo "</div>";
            echo "<div class='intro_art'>";
                echo '<p>'.$intro.'</p><br>';
            echo "</div>";
            echo "<div class='desc_art'>";
                echo '<p>'.$des.'</p><br>';
            echo "</div>";
            echo "<div class='image_art'>";
                echo '<img style="width: 500px;" src="data:image/jfifi;base64,'.$img.'"/>';
            echo "</div>";
            echo "<div class='conclusao_art'>";
                echo '<p>'.$con.'</p><br>';
            echo '</div>';
            echo '<hr>';
            echo '<br>';
            echo '<b> Referências: '.$ref.'</b>';
            echo '<br><br>';
        echo '</div>';
        ?>
       </div> 
    </body>     
</html>
<?php require("../template/footer.php")?>