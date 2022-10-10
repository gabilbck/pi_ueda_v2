<?php require("../template/header.php");?>
<head>
    <title>VOCÊ NÃO POSSUI ACESSO À PÁGINA! | UEDA</title>
</head>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>VOCÊ NÃO POSSUI ACESSO À PÁGINA!</h1>
                <br>
                <h2>Volte à página principal <?php 
                if (!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
                    echo 'ou inicie uma nova sessão:'; }
                ?></h2>
                <br>
                <a class="link-branco" href="home.php"><button>PÁGINA PRINCIPAL</button></a>
                <?php if (!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
                    echo '<br><br><a class="link-branco" href="login_usu.php"><button>LOGIN</button></a><div class="margizinha">ou</div><a class="link-branco" href="cad_usu.php"><button>CADASTRE-SE</button></a>';}
                ?>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>