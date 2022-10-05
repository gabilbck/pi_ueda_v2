<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<?php
    // Implementação futura
?>
<head>
    <title>Cadastrar Etiqueta | UEDA</title>
</head>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>CADASTRAR ETIQUETAS</h1>
                <br>
                <h2>Implementação futura...</h2>
                <br><br>
            </center>
        </div>
<?php require("../template/footer.php");?>