<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}
$ok = 's';
$n = "";
$s = "";
$e = "";
include_once '../class/admin.php';
$adm = new Admin();
if (filter_input(INPUT_GET, 'id')) {
    $ok = 'e';
    $dados = $adm->consultar(filter_input(INPUT_GET, 'id'));
    foreach ($dados as $mostrar) {
        $n = $mostrar['nome_admin'];
        $s = $mostrar['senha'];
        $e = $mostrar['email'];
    }
}
?>
<script type="text/javascript">
    function confirmar(id) {
        var resposta = confirm("Deseja excluir?");

        if (resposta) {
            window.location.href = "?p=usuario/excluir&id=" + id;
        }
    }
</script>
<!-- Content Header (Page header) - Início da página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Administradores</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=pagina-inicial">Home</a></li>
                    <li class="breadcrumb-item"><a href="?p=admin/consultar">Administradores</a></li>
                    <li class="breadcrumb-item active">Adicionar admin</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Adicionar Administrador</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nome">Nome do usuário</label>
                        <input type="text" class="form-control" id="nome_admin" name="nome_admin" placeholder="Escreva o nome de usuário" value="<?php echo $n; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Endereço de email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Escreva seu email" value="<?php echo $e; ?>">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha do usuário</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Escreva sua senha" value="<?php echo $s; ?>">
                    </div>
                    <?php if ($ok == 's') { ?>
                        <div class="form-group">
                            <label>Imagem:</label>
                            <input type="file" class="form-control" name="imagem">
                        </div>
                    <?php } ?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btnSalvar" name="btnSalvar" value="add">Salvar</button>
                    <a href="?p=admin/consultar" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</section>
<?php
//verifica se botão foi pressionado
if (filter_input(INPUT_POST, 'btnSalvar')) {
    $nome = filter_input(INPUT_POST, 'nome_admin', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    if ($ok == 's') {
        $imagem = $_FILES['imagem']['name'];
        $tmp_imagem = $_FILES['imagem']['tmp_name'];
        $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
        if (@strstr('.jpg;.png;.jpeg', $extensao)) {
            $adm->setNome_admin($nome);
            $adm->setEmail($email);
            $adm->setSenha(sha1($senha));
            $adm->setImagem(sha1(time() . $imagem) . "." . $extensao);
            $adm->setTmp_imagem($tmp_imagem);

            echo '<div class="container-fluid">'
            . '<div class="alert alert-success alert-dismissible">'
            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
            . '<h5><i class="icon fa fa-check"></i> OK!</h5>'
            . $adm->inserir()
            . '</div>'
            . '</div>';
            echo '<meta http-equiv="refresh" content="3; url=?p=admin/consultar"';
        } else {
            echo '<div class="container-fluid">'
            . '<div class="alert alert-danger alert-dismissible">'
            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
            . '<h5><i class="icon fa fa-ban"></i> Erro!</h5>'
            . 'Escolha uma imagem .jpg, .jpeg ou .png'
            . '</div>'
            . '</div>';
        }
    } else if ($ok == "e") {
        //editar
        $adm->setId(filter_input(INPUT_GET, 'id'));
        $adm->setNome_admin($nome);
        $adm->setEmail($email);
        $adm->setSenha(sha1($senha));

        echo '<div class="box">'
        . '<div class="alert alert-success" role="alert">'
        . '<h3>'
        . $adm->editarDados()
        //. $adm->editarDados(filter_input(INPUT_GET, 'id'))        
        . '</h3>'
        . '</div>'
        . '</div>';
        echo '<meta http-equiv="refresh" content="1; url=?p=admin/consultar"';
    }
}
