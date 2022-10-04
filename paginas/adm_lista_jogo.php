<?php 
    include "../include/MySql.php";
    include "../include/functions.php";
    session_start();
?>
<head>
    <title>Listagem de Jogos</title>
</head>
<?php require("../template/header.php");?>
    <main>
        <div class="margem-lados">
            <br><br>
            <?php
                $sql = $pdo->prepare('SELECT * FROM jogos');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>LISTAGEM DE JOGOS</h1><br>";
                    echo "<table class='listagens-table'";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Nome</th>";
                    echo "<th>Descrição</th></th>";
                    echo "<th>Imagem</th>";
                    echo "<th>Link</th>";
                    echo "<th>Alterar</th>";
                    echo "<th>Excluir</th>";
                    echo "</tr>";
            
                    foreach($info as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['cod_jogo']."</td>";
                        echo "<td>".$value['nome_jogo']."</td>";
                        echo "<td>".$value['desc_jogo']."</td>";
                        echo "<td>".$value['image_jogo']."</td>";
                        echo "<td>".$value['link_jogo']."</td>";
                        echo "<td><center><a class='alt' href='adm_alt_jogo.php?cod_jogo=".$value['cod_jogo']."'>(+)</a></center></td>";
                        echo "<td><center><a class='del' href='adm_del_jogo.php?cod_jogo=".$value['cod_jogo']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
            
                    echo "</table>";
                    echo "<br><button><a class='link-branco' href='cad_jogo.php'>Cadastrar novo jogo</a></button>";
                    echo "</center>";
                }
            ?>
            <br>
        </div>
    </main>
<?php require("../template/footer.php");?>