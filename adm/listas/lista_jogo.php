<?php 
    include "../../include/MySql.php";
    include "../../include/functions.php";
    session_start();
?>
<head>
    <title>Listagem de Jogos</title>
</head>
<?php require("../../template/header3.php");?>
    <main>
        <div class="margem-lados">
            <?php
                $sql = $pdo->prepare('SELECT * FROM jogos');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>Listagem de Jogos</h1>";
                    //					
                    echo "<table class='listagens-table'";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Nome do Jogo</th>";
                    echo "<th>Descrição do Jogo</th></th>";
                    echo "<th>Imagem</th>";
                    echo "<th>Link do Jogo</th>";
                    echo "<th>Alterar</th>";
                    echo "<th>Excluir</th>";
                    echo "</tr>";
            
                    foreach($info as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['cod_Jogo']."</td>";
                        echo "<td>".$value['nome_jogo']."</td>";
                        echo "<td>".$value['desc_jogo']."</td>";
                        echo "<td>".$value['image_jogo']."</td>";
                        echo "<td>".$value['link_jogo']."</td>";
                        echo "<td><center><a class='alt' href='../del/del_usu.php?id_usu=".$value['cod_Jogo']."'>(+)</a></center></td>";
                        echo "<td><center><a class='del' href='../alt/alt_usu.php?id_usu=".$value['cod_Jogo']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
            
                    echo "</table>";
                    echo "<br><button><a href='../../#/#.php'>Cadastrar novo jogo</a></button>";
                    echo "</center>";
                }
            ?>
        </div>
    </main>
<?php require("../../template/footer3.php");?>