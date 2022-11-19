<?php
session_start();
include_once "../include/MySql.php";
include_once "../include/functions.php";

    if(!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
        header("location:n_adm_msg.php");
        die;
    } else{
        if($_SESSION['adm'] != 1){
            header("location:n_adm_msg.php");
            die;
        } else{
            require("../template/header_s_php.php");
        }
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