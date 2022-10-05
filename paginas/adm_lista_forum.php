<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<head>
    <title>Listagem de Publicações do Fórums | UEDA</title>
</head>
<body>
<?php require("../template/header.php");?>
    <br><br>
    <main>
        <div class="margem-lados">
            <?php
                $sql = $pdo->prepare('SELECT * FROM publica_forum');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>LISTAGEM DE PUBLICAÇÕES DO FÓRUM</h1><br>";
                    echo "<table class='listagens-table'";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>ID (Usuário)</th>";
                    echo "<th>Texto</th>";
                    echo "<th>Imagem</th>";
                    echo "<th>Comentários</th>";
                    echo "<th>Alterar</th>";
                    echo "<th>Excluir</th>";
                    echo "</tr>";
                    foreach($info as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['id_publi']."</td>";
                        echo "<td>".$value['id_usu']."</td>";
                        echo "<td>".$value['text_publi']."</td>";
                        echo "<td>".$value['img_publi']."</td>";
                        echo "<td><center><a class='alt' href='adm_lista_com.php?id_publi=".$value['id_publi']."'>Comentários</a></center></td>";
                        echo "<td><center><a class='alt' href='adm_alt_forum.php?id_publi=".$value['id_publi']."'>(+)</a></center></td>";
                        echo "<td><center><a class='del' href='adm_del_forum.php?id_publi=".$value['id_publi']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br><button><a class='link-branco' href='cad_for.php'>Publicar no Fórum</a></button>";
                    echo "</center>";
                }
            ?>
            <br>
        </div>
    </main>
<?php require("../template/footer.php");?>