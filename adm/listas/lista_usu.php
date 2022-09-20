<?php 
    include "../../include/MySql.php";
    include "../../include/functions.php";
    session_start();
?>
<head>
    <title>Listagem de Usuários</title>
</head>
<?php require("../../template/header3.php");?>
    <main>
        <div class="margem-lados">
            <?php
                $sql = $pdo->prepare('SELECT * FROM usuario');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>Listagem de Usuários</h1>";
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
                        echo "<td><center><a class='alt' href='../del/del_usu.php?id_usu=".$value['id_usu']."'>(+)</a></center></td>";
                        echo "<td><center><a class='del' href='../alt/alt_usu.php?id_usu=".$value['id_usu']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
            
                    echo "</table>";
                    echo "<br><button><a href='../../login/cadastro.php'>Cadastrar novo usuário</a></button>";
                    echo "</center>";
                }
            ?>
        </div>
        <!-- <table class="listagens-table">
            <tr>
                <th>abc</th>
                <th>abc</th>
                <th>abc</th>
            </tr>
            <tr>
                <td>abc</td>
                <td>abc</td>
                <td>abc</td>
            </tr>
            <tr>
                <td>abc</td>
                <td>abc</td>
                <td>abc</td>
            </tr>
            <tr>
                <td>abc</td>
                <td>abc</td>
                <td>abc</td>
            </tr>
        </table> -->
    </main>
<?php require("../../template/footer3.php");?>