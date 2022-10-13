<?php require("../template/header.php");?>
<?php
    /* Essa página de "listagem" do fórum só pode ser utilizada se o
    usuário for cadastrado */
?>
<head>
    <title>Fórum | UEDA</title>
</head>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>FÓRUM</h1>
                <br>
                <h2>Você também gostaria de compartilhar algo em nosso fórum? Publique agora!</h2>
                <br><br>
                <a class="link-branco" href="cad_for.php"><button>PUBLICAR NO FÓRUM</button></a>
                <br><br>
            </center>
                <?php
                $sql = $pdo->prepare("SELECT * FROM `artigo`");
                if($sql->execute()){
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $value){
                        $id_publi = $value['id_publi'];
                        $id_usu = $value['id_usu'];
                        $titulo_publi = $value['titulo_publi'];
                        $text_publi = $value['text_publi'];
                        $img_publi = $value['img_publi'];

                        echo '<div class="foruns">';
                        echo '<a href="#"><h2>'.$text_publi.'</h2></a>';
                        echo '<div class="margem-art"></div>';
                        echo '<a class="et-'.$class.'" href="#">'.$str.'</a>';
                        echo '<div class="margem-art"></div>';
                        echo '<p>'.$desc.'</p>';
                        echo '<div class="margem-art"></div>';
                        echo "<a target='_blank' href=".$link_arts.">Ver Agora</a>";
                        echo '<hr>';
                        echo '</div>';
                        echo '<br>';
                    };
                };
                ?>
        </div>
    </main>
<?php require("../template/footer.php");?>