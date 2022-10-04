<?php
    // falta id_publi
    session_start();
    include "../include/MySql.php";
    include "../include/functions.php";
?>
<head>
    <title>Listagem de Comentários Em Publicações do Fórums | UEDA</title>
</head>
<body>
<?php require("../template/header.php");?>
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
                    //echo "<th>ID (Fórum)</th>";
                    echo "<th>ID</th>";
                    echo "<th>Texto</th>";
                    echo "<th>ID (Usuário)</th>";
                    echo "<th>Comentários</th>";
                    echo "<th>Alterar</th>";
                    echo "<th>Excluir</th>";
                    echo "</tr>";
                    foreach($info as $key => $value){
                        echo "<tr>";
                        //echo "<td>".$value['id_publi']."</td>";
                        echo "<td>".$value['id_cmt']."</td>";
                        echo "<td>".$value['text_cmt']."</td>";
                        echo "<td>".$value['id_usu']."</td>";
                        echo "<td><center><a class='alt' href='adm_alt_com.php?id_com=".$value['id_com']."'>(+)</a></center></td>";
                        echo "<td><center><a class='del' href='adm_del_com.php?id_com=".$value['id_com']."'>(-)</a></center></td>";
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