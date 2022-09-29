<?php
    include "../../include/MySql.php";
    include "../../include/functions.php";
    session_start();
?>
<head>
    <title>Listagem de Bugs | UEDA</title>
</head>
<body>
<?php require("../../template/header3.php");?>
    <br><br>
    <center>
        <h1 class="h1_título_topo">COMENTÁRIOS DOS BUGS</h1>
    </center>
    <br>
    <main>
        <div class="margem-lados">
            <?php
                $sql = $pdo->prepare('SELECT * FROM bug');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>Listagem de Bugs</h1>";
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
                        echo "<td><center><a class='alt' href='../del/del_usu.php?id_usu=".$value['cod_bug']."'>(+)</a></center></td>";
                        echo "<td><center><a class='del' href='../alt/alt_usu.php?id_usu=".$value['cod_bug']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br><button><a href='../../bug.php'>Reportar Bugs</a></button>";
                    echo "</center>";
                }
            ?>
        </div>
    </main>
<?php require("../../template/footer3.php");?>