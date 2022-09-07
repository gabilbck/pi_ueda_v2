<?php
    session_start();
?>
<head>
    <title>Listagem de Bugs | UEDA</title>
</head>
<body>
<?php require("../template/header2.php");?>
    <br><br><br><br><br>
    <center>
      <h1 class="h1_título_topo">COMENTÁRIOS DOS BUGS</h1>
    </center>
    <br>
<?php
    include '../include/MySql.php';

    $sql = $pdo->prepare("SELECT * FROM bug");

    if ($sql->execute()){
        $info = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($info as $key => $value){
            echo "<hr>";
            echo "<div style='margin-left: 50px;'>"."<br>";
            echo "Código: ".$value['cod_bug']."<br>";
            echo "Email: ".$value['email_bug']."<br>";
            echo "Descrição: ".$value['desc_bug']."<br>";
            echo "</div>";
            echo "<hr>";
        }
    }
?>
<?php require("template/footer2.php");?>