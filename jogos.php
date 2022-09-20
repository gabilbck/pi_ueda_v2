<?php
    session_start();
    include "include/MySql.php";
    include "include/functions.php";
?>
<head>
    <title>Jogos | UEDA</title>
</head>
<?php require("template/header1.php");?>
    <main>
        <br><br>
        <center>
            <h1>JOGOS</h1>
        </center>
        <br>
        <div class="margem-lados">
            <div class="principal-jogos">
                <div class="principais-text-jogos">
                    <h1 class="titulo_principal">Jogo do dino</h1>
                    <h1 class="subtitulo_principal">Desenvolvido por: Equipe UEDA</h1>
                </div>
                <div class="jogo_ueda">
                    <img src="./images/temp_image_jogos.png" alt="">    
                </div>
                <div class="principais-text-jogos2">
                    <h1 class="descricao_titulo">Descrição</h1>
                    <h1 class="descricao">Um simples jogo onde você controla uma <br>gota de água e desvia de obstáculos.</h1>
                    <h1 class="obj-jogo">Objetivo</h1>
                    <h1 class="obj-jogo2">O objetivo do jogo é alcançar a maior pontuação evitando os obstáculos, que são os lixos no oceano.
                </div> 
            </div> <br><br><br><br><br><br><br><br>
            <?php
            
            $sql = $pdo->prepare("SELECT * FROM jogos");
            if ($sql->execute()){
                $info = $sql->fetchAll(PDO::FETCH_ASSOC);}

                echo "<div class='jogos'>";
                foreach($info as $key => $values){       
                    echo "<div class='section-jogos'>";         
                    $image_jogo = $values['image_jogo'];
                    echo '<img style="max-width:300px; max-height:200px; width: auto; height: auto;" src="data:image/jpg;charset=utf8;base64,'.base64_encode($image_jogo).'"/>';
                        echo "<div class='nome-jogos'>";    
                            echo '<p>'.$values['nome_jogo'].'</p>';
                        echo "</div>";
                        echo "<div class='desc-jogos'>";  
                            echo '<p>'.$values['desc_jogo'].'</p>';
                        echo "</div>";
                        echo "<div class='link-jogos'>";  
                            echo '</p>'.$values['link_jogo'].'</p>';
                        echo "</div>";
                    echo "</div>";
                }   
                echo "</div>";

            /*echo "<div class='section-jogos'>";
                foreach($info as $key => $values){
                    echo "<div class='jogos'>";
                    $image_jogo = $values['image_jogo'];
                    echo '<img style="width: 350px;" src="data:image/jpg;charset=utf8;base64,'.base64_encode($image_jogo).'"/>';
                    echo $values['nome_jogo'];
                    echo $values['desc_jogo'];
                    echo $values['link_jogo'];
                    echo "</div>";
                }
            echo "</div>";*/
            

            $image_jogo = $values['image_jogo'];
            base64_encode($image_jogo);
            ?> 
        </div>
        <br><br>
    </main>
<?php require("template/footer1.php");?>