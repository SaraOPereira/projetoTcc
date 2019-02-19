<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}

include_once '../class/produto.php';
$pro = new Produto();
$id = filter_input(INPUT_GET, 'id');
$codImg = filter_input(INPUT_GET, 'codImagem');
?>
<!-- Content Header (Page header) - Início da página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Produto - Editar imagem</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=pagina-inicial">Home</a></li>
                    <li class="breadcrumb-item"><a href="?p=produto/consultar">produto</a></li>
                    <li class="breadcrumb-item active">Editar imagem</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar imagem</h3>
            </div>
            <div class="container p-2">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Escolha a nova imagem:</label>
                        <input type="file" class="form-control" name="imagem">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="btnSalvar" name="btnSalvar" value="add">Salvar</button>
                        <a href="?p=produto/consultarImagem&id=<?php echo $id; ?>" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>

            <!-- /.card -->
        </div>
    </div>
</section>
<?php
//verifica se botão foi pressionado
if (filter_input(INPUT_POST, 'btnSalvar')) {
    $imagem = $_FILES['imagem']['name'];
    $tmp_imagem = $_FILES['imagem']['tmp_name'];
    $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
    if (@strstr('.jpg;.png;.jpeg', $extensao)) {
        $pro->setCod_produto($id);
        $pro->setCod_imagem($codImg);
        $pro->setImagem(sha1(time() . $imagem) . "." . $extensao);
        $pro->setTmp_imagem($tmp_imagem);

        echo '<div class="container-fluid">'
        . '<div class="alert alert-success alert-dismissible">'
        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
        . '<h5><i class="icon fa fa-check"></i> PRODUTO!</h5>'
        . $pro->editarImagem()
        . '</div>'
        . '</div>';
        echo '<meta http-equiv="refresh" content="3; url=?p=produto/consultarImagem&id='. $id .'"' ;
    } else {
        echo '<div class="container-fluid">'
        . '<div class="alert alert-danger alert-dismissible">'
        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
        . '<h5><i class="icon fa fa-ban"></i> Erro!</h5>'
        . 'Escolha uma imagem .jpg, .jpeg ou .png'
        . '</div>'
        . '</div>';
    }
}    