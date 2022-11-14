<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<head>
    <title>Listagem de Usuários</title>
</head>
    <main>
        <div class="margem-lados">
        <br><br>
            <?php
                $sql = $pdo->prepare('SELECT * FROM usuario');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>LISTAGENS DE USUÁRIOS</h1><br>";
                    echo "<table class='listagens-table'";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Nome</th>";
                    echo "<th>E-mail</th>";
                    echo "<th>Senha</th>";
                    echo "<th>Nome Completo</th>";
                    echo "<th>Administrador</th>";
                    echo "<th>Alterar</th>";
                    echo "<th>Excluir</th>";
                    echo "</tr>";
            
                    foreach($info as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['id_usu']."</td>";
                        echo "<td>".$value['nome_usu']."</td>";
                        echo "<td>".$value['email_usu']."</td>";
                        echo "<td>".$value['senha_usu']."</td>";
                        echo "<td>".$value['nome_real_usu']."</td>";
                        echo "<td>".$value['adm']."</td>";
                        echo "<td><center><a class='alt' href='adm_alt_usu.php?id_usu=".$value['id_usu']."'>(+)</a></center></td>";
                        echo "<td><center><a class='del' href='adm_del_usu.php?id_usu=".$value['id_usu']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
            
                    echo "</table>";
                    echo "<br><button><a class='link-branco' href='cad_usu.php'>Cadastrar novo usuário</a></button>";
                    echo "</center>";
                }
            ?>
            <br>
        </div>
    </main>
<?php require("../template/footer.php");?>