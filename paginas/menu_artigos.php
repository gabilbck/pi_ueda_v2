<?php require("../template/header.php");?>
<?php 
    /* Deve ser feito o php da página, para que mostre esses artigos
    registrados ao usuário, tendo a mesma função que as listagens,
    no entanto, NÃO POSSUEM funções como exclusão o alteração dos artigos */
?>
<head>
    <title>Artigos | UEDA</title>
</head>
    <main>
        <div class="margem-lados">
            <br><Br>
            <center>
                <h1>ARTIGOS</h1>
            </center>
            <div class="margem-titulo"></div>

            <?php
                $sql = $pdo->prepare("SELECT * FROM `artigo`");
                if($sql->execute()){
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $i){
                        $id = $i['id_art'];
                        $tituloart = $i['titulo_art'];
                        $etiqueta = $i['id_eti'];
                        $desc = $i['des_art'];
                        $link_arts = $i['link_art'];

                        if($etiqueta == 2){
                            $str = 'Art. Cientifico';
                            $class = 'artc';
                        }else if($etiqueta == 1){
                            $str = 'Noticia';
                            $class = 'not';
                        }else  if($etiqueta == 3){
                            $str = 'Art. de Site';
                            $class = 'site';
                        }else{
                            $str = 'Null';
                            $class = 'artc';
                        };

                        echo '<div class="artigo">';
                        echo '<a href="#"><h2>'.$tituloart.'</h2></a>';
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

            <!-- <div class="artigo">
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
            <br> -->
        </div>
        <br>
    </main>
<?php require("../template/footer.php");?>