<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<head>
    <title>Listagem de Comentários Em Publicações do Fórums | UEDA</title>
</head>
<body>
    <br><br>
    <main>
        <div class="margem-lados">
            <?php
                $sql = $pdo->prepare('SELECT * FROM comentario');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                    echo "<center>";
                    echo "<h1>LISTAGEM DE COMENTÁRIOS DO FÓRUM</h1><br>";
                    echo "<table class='listagens-table'";
                    echo "<tr>";
                    echo "<th>ID (Fórum)</th>";
                    echo "<th>ID (Comentário)</th>";
                    echo "<th>Texto</th>";
                    echo "<th>ID (Usuário)</th>";
                    echo "<th>Nome (Usuário)</th>";
                    echo "<th>Excluir</th>";
                    echo "</tr>";
                    foreach($info as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['id_publi']."</td>";
                        echo "<td>".$value['id_cmt']."</td>";
                        echo "<td>".$value['text_cmt']."</td>";
                        echo "<td>".$value['id_usu']."</td>";
                        $sql = $pdo->prepare('SELECT nome_usu FROM usuario WHERE id_usu =?');
                        if($sql->execute(array($value['id_usu']))){
                            $usuario = $sql->fetchAll(PDO::FETCH_ASSOC);
                            $nome_usu = $usuario[0]['nome_usu'];
                            echo "<td>".$nome_usu."</td>";
                        }
                        echo "<td><center><a class='del' href='adm_del_com.php?id_cmt=".$value['id_cmt']."'>(-)</a></center></td>";
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