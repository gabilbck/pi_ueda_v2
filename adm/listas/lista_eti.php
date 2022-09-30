<?php
    session_start();
    include "../../include/MySql.php";
    include "../../include/functions.php";
?>
<head>
    <title>Listagem de Etiquetas | UEDA</title>
</head>
<body>
<?php require("../../template/header3.php");?>
    <br><br>
    <main>
        <div class="margem-lados">
            <?php
                $sql = $pdo->prepare('SELECT * FROM etiqueta_art');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>LISTAGEM DE ETIQUETAS</h1><br>";
                    echo "<table class='listagens-table'";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Nome</th>";
                    echo "<th>Alterar</th>";
                    echo "<th>Excluir</th>";
                    echo "</tr>";
                    foreach($info as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['id_eti']."</td>";
                        echo "<td>".$value['nome_eti']."</td>";
                        echo "<td><center><a class='alt' href='../del/del_eti.php?id_eti=".$value['id_eti']."'>(+)</a></center></td>";
                        echo "<td><center><a class='del' href='../alt/alt_eti.php?id_eti=".$value['id_eti']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br><button><a class='link-branco' href='../../etiquetas/cad_eti.php'>Cadastrar Etiqueta</a></button>";
                    echo "</center>";
                }
            ?>
            <br>
        </div>
    </main>
<?php require("../../template/footer3.php");?>