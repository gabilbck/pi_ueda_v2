<?php
    include "../include/MySql.php";
    include "../include/functions.php";
?>
<head>
    <title>Listagem de Bugs | UEDA</title>
</head>
<body>
<?php require("../template/header.php");?>
    <br><br>
    <main>
        <div class="margem-lados">
            <?php
                $sql = $pdo->prepare('SELECT * FROM bug');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>LISTAGEM DE REPORTES</h1><br>";
                    echo "<table class='listagens-table'";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>E-mail</th>";
                    echo "<th>Descrição</th>";
                    echo "<th>Alterar</th>";
                    echo "<th>Excluir</th>";
                    echo "</tr>";
                    foreach($info as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['cod_bug']."</td>";
                        echo "<td>".$value['email_bug']."</td>";
                        echo "<td>".$value['desc_bug']."</td>";
                        echo "<td><center><a class='alt' href='../alt/alt_bug.php?cod_bug=".$value['cod_bug']."'>(+)</a></center></td>";
                        echo "<td><center><a class='del' href='../del/del_bug.php?cod_bug=".$value['cod_bug']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br><button><a class='link-branco' href='bug.php'>Reportar Bugs</a></button>";
                    echo "</center>";
                }
            ?>
            <br>
        </div>
    </main>
<?php require("../template/footer.php");?>