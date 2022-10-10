<?php require("../template/header.php");?>
<head>
    <title>Jogos | UEDA</title>
</head>
    <main>
        <br><br>
        <center>
            <h1>JOGOS</h1>
        </center>
        <br>
        <div class="margem-lados">
            <div class="principal-jogos">
                <div class="principais-text-jogos">
                    <h1 class="titulo_principal">Jogo da gotinha</h1>
                    <h1 class="subtitulo_principal">Desenvolvido por: Equipe UEDA</h1>
                </div>
                <a target='_blank' href="../jogo/jogo-ueda/index.html">
                    <div class="jogo_ueda">
                        <img style="width:100%;" src="../images/banner-jogo.png" alt="">    
                    </div>    
                </a>
                <div class="principais-text-jogos2">
                    <h1 class="descricao_titulo">Descrição</h1>
                    <h1 class="descricao">Um simples jogo onde você controla uma <br>gota de água e desvia de obstáculos.</h1>
                    <h1 class="obj-jogo">Objetivo</h1>
                    <h1 class="obj-jogo2">O objetivo do jogo é alcançar a maior pontuação evitando os obstáculos, que são os lixos no oceano.</h1>
                </div>
            </div>
            </div>
            <div class="separacao-jogos">
                <img src="../images/bg-developers1.png" alt="">
            </div>
            <div class="background-jogos">
                <?php
                    $sql = $pdo->prepare("SELECT * FROM jogos");
                    if ($sql->execute()){
                        $info = $sql->fetchAll(PDO::FETCH_ASSOC);}
                        
                        echo "<div class='jogos'>";
                        foreach($info as $key => $values){
                                $image_jogo = $values['image_jogo']; 
                                echo "<div class='jogos-agua'>";
                                echo "<div class='container-jogos'>";
                                    echo "<div class='jogo-image'>";
                                        echo '<img style="width:400px; max-height:200px; width: auto; height: auto;" src="data:image/jpg;charset=utf8;base64,'.base64_encode($image_jogo).'"/>'; 
                                    echo "</div>";
                                    echo "<div class='jogo-info'>";
                                        echo "<div class='nome-jogos'>";
                                            echo $values['nome_jogo']."<br>";
                                        echo "</div>";
                                        echo "<div class='desc-info'>";
                                            echo $values['desc_jogo']."<br>";
                                        echo "</div>";
                                        echo "<div class='link-info'>";
                                            echo "<a target='_blank' href=".$values['link_jogo'].">Jogue</a>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "<div class='fundo-jogos'>"."</div>";
                            }
                        echo "</div>";
                        echo "<br>";
                ?> 
            </div>
            
            
        
    </main>
<?php require("../template/footer.php");?>