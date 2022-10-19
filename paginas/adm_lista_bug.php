<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<head>
    <title>Listagem de Bugs | UEDA</title>
</head>
<body>
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
                    echo "<th>Excluir</th>";
                    echo "</tr>";
                    foreach($info as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['cod_bug']."</td>";
                        echo "<td>".$value['email_bug']."</td>";
                        echo "<td>".$value['desc_bug']."</td>";
                        echo "<td><center><a class='del' href='adm_del_bug.php?cod_bug=".$value['cod_bug']."'>(-)</a></center></td>";
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