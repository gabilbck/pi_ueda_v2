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
                include '../include/MySql.php';


                $sql = $pdo->prepare("SELECT * FROM artigo");
                if($sql->execute()){
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $i){

                        $id = $i['id_art'];
                        $img_art = $i['img_art'];
                        $tituloart = $i['titulo_art'];
                        $intro_art = $i['intro_art'];
                        $des_art = $i['des_art'];
                        $con_art = $i['con_art'];   
                        $ref_art = $i['ref_art'];

                        $etiqueta = $i['id_eti'];
                        $resumo_art = $i['resumo_art'];

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

                        if($etiqueta == 1){
                            $link = $i['link_art'];
                            unset($_SESSION['img']);
                            unset($_SESSION['titulo']);
                            unset($_SESSION['id']);
                            unset($_SESSION['intro']);
                            unset($_SESSION['desc']);
                            unset($_SESSION['concl']);
                            unset($_SESSION['ref']);
                        }else if($etiqueta == 2 || $etiqueta == 3){
                            $link = 'vizu_art.php?id_art='.$id;
                        };

                        echo '<div class="artigo">';
                        echo '<a href="#"><h2>'.$tituloart.'</h2></a>';
                        echo '<div class="margem-art"></div>';
                        echo '<a class="et-'.$class.'" href="#">'.$str.'</a>';
                        echo '<div class="margem-art"></div>';
                        echo '<p>'.$resumo_art.'</p>';
                        echo '<div class="margem-art"></div>';
                        echo "<a target='_blank' href=".$link.">Ver Agora</a>";
                        echo '<hr>';
                        echo '</div>';
                        echo '<br>';
                    };
                };
            ?>
        </div>
        <br>
    </main>
<?php require("../template/footer.php");?>