<?php
date_default_timezone_set('America/Sao_Paulo');
//session_start();
include_once '../class/Url.php';
$url = new Url();
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin - Ótica Express</title>
        <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../css/styleAdmin.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div>
            <div class="col-8 offset-2 p-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2 class="text-center"> Login - Ótica Express</h2>
                        </div>
                        <div class="col-10 offset-1">
                            <form method="post">
                                <div class="form-group">
                                    <label for="usuario">Nome do Usuário</label>
                                    <input type="text" class="form-control" id="usuario" placeholder="Nome" name="txtNome">
                                </div>
                                <div class="form-group">
                                    <label for="senha">Senha</label>
                                    <input type="password" class="form-control" id="senha" placeholder="Senha" name="txtSenha">
                                </div>
                                <input class="btn btn-primary" type="submit" name="btnLogin" value="Entrar">
                                <a class="btn btn-danger" href="<?php $url->getBase(); ?>../">Voltar ao site</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../js/jquery/jquery.min.js" type="text/javascript"></script>
    </body>
</html>
<?php
if (filter_input(INPUT_POST, 'btnLogin')) {
    //recebendo dados do form
    $nome = filter_input(INPUT_POST, 'txtNome', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'txtSenha', FILTER_SANITIZE_STRING);
    //pesquisa na table usuario
    include_once '../class/Conectar.php';
    $con = new Conectar();
    $sql = "select * from admin where nome_admin = ? and senha = ?;";
    $ligacao = $con->prepare($sql);
    $ligacao->bindValue(1, $nome, PDO::PARAM_STR);
    $ligacao->bindValue(2, sha1($senha), PDO::PARAM_STR);
    $ligacao->execute();
    //comparar dados
    if ($ligacao->rowCount() > 0) {
        file_put_contents('adminAtivo.json', json_encode($ligacao->fetchAll()));
        session_start();
        $_SESSION['acesso'] = sha1(time());
        //redireciona página
        header("Location:admin.php");
    } else {
        echo '<div class="container">'
        . '<div class="alert alert-danger" role="alert">'
        . '<h3>Nome e/ou senha incorreto(s)</h3>'
        . '<p>Tente novamente!</p>'
        . '</div>'
        . '</div>';
    }
}