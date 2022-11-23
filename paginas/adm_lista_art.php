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
    <title>Listagem de Artigos | UEDA</title>
    <style>
        .tamanho-especifico-td{
            width: 10rem;
        }
        .exc-alt{
            width: 55px;
        }
        .link{
            width: 60px;
        }
        .id-e{
            width: 100px;
        }
    </style>
</head>
<body>
    <br><br>
    <main>
        <div class="margem-lados">
            <?php
                $sql = $pdo->prepare('SELECT * FROM artigo');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>LISTAGEM DE ARTIGOS</h1><br>";
                    echo "<table class='listagens-table'>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Título</th>";
                    echo "<th>ID (Etiqueta)</th>";
                    echo "<th>Link</th>";
                    echo "<th>Resumo</th>";
                    echo "<th>Imagem</th>";
                    echo "<th>Introdução</th>";
                    echo "<th>Desenvolvimento</th>";
                    echo "<th>Conclusão</th>";
                    echo "<th>Referências</th>";
                    echo "<th>Alterar</th>";
                    echo "<th>Excluir</th>";
                    echo "</tr>";
                    foreach($info as $key => $value){
                        echo "<tr>";
                        //ID do artigo
                        echo "<td>".$value['id_art']."</td>";
                        //Título
                        echo "<td>".$value['titulo_art']."</td>";
                        //Etiquetas
                        if (($value['id_eti']) == 1){
                            echo "<td class='id-e'><center>".$value['id_eti']." (Notícia)</center></td>";
                        } else if (($value['id_eti']) == 2){
                            echo "<td class='id-e'><center>".$value['id_eti']." (Art. Científico)</center></td>";
                        } else if (($value['id_eti']) == 3){
                            echo "<td class='id-e'><center>".$value['id_eti']." (Art. de Site)</center></td>";
                        } else {
                            echo "<td class='id-e'><center>".$value['id_eti']."</center></td>";
                        }
                        //Link
                        if (!empty($value['link_art'])){ 
                            echo "<td class='link'><center><a href='".$value['link_art']."'>ACESSE</a></center></td>";
                        } else{
                            echo '<td class="link"><center><i>(Não possui)</i></center></td>';
                        }
                        //Resumo
                        echo "<td class='tamanho-especifico-td'>".$value['resumo_art']."</td>";
                        //Imagem
                        $imagem = $value['img_art'];
                        if (!empty($imagem)){ 
                            echo '<td><img width="150" src="data:image/jpg;charset=utf8;base64,'.($imagem).'"/></td>';
                        } else{
                            echo '<td><center><i>(Não possui)</i></center></td>';
                        }
                        //Introdução
                        if (!empty($value['intro_art'])){ 
                            echo "<td class='tamanho-especifico-td'>".$value['intro_art']."</td>";
                        } else{
                            echo '<td><center><i>(Não possui)</i></center></td>';
                        }
                        //Desenvolvimento
                        if (!empty($value['des_art'])){ 
                            echo "<td class='tamanho-especifico-td'>".$value['des_art']."</td>";
                        } else{
                            echo '<td><center><i>(Não possui)</i></center></td>';
                        }
                        //Conclusão
                        if (!empty($value['con_art'])){ 
                            echo "<td class='tamanho-especifico-td'>".$value['con_art']."</td>";
                        } else{
                            echo '<td><center><i>(Não possui)</i></center></td>';
                        }
                        //Referências
                        if (!empty($value['ref_art'])){ 
                            echo "<td class='tamanho-especifico-td'>".$value['ref_art']."</td>";
                        } else{
                            echo '<td><center><i>(Não possui)</i></center></td>';
                        }
                        echo "<td class='exc-alt'><center><a class='alt' href='adm_alt_art.php?id_art=".$value['id_art']."'>(+)</a></center></td>";
                        echo "<td class='exc-alt'><center><a class='del' href='adm_del_art.php?id_art=".$value['id_art']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br><button><a class='link-branco' href='cad_art.php'>Cadastrar Artigos</a></button>";
                    echo "</center>";
                }
            ?>
            <br>
        </div>
    </main>
<?php require("../template/footer.php");?>