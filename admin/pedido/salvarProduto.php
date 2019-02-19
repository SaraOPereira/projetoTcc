<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}
include_once '../class/pedido.php';
$p = new Pedido();
$id = filter_input(INPUT_GET, 'id');
$p->setCod_pedido($id);
?>
<!-- Content Header (Page header) - Início da página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pedidos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=pagina-inicial">Home</a></li>
                    <li class="breadcrumb-item"><a href="?p=pedido/consultar">Pedidos</a></li>
                    <li class="breadcrumb-item active">Adicionar produto do pedido</li>
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
                <h3 class="card-title">Adicionar Produto do Pedido</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" name="form" id="form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="codProduto">Código do produto</label>
                        <input type="text" class="form-control"  id="codProduto" name="codProduto">
                    </div>
                    <div class="form-group">
                        <label for="qtde">Quantidade do produto</label>
                        <input type="number" class="form-control"  id="qtde" name="qtde">
                    </div>                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btnSalvar" name="btnSalvar" value="add">Salvar</button>
                    <a href="?p=pedido/consultarProduto&id=<?php echo $id; ?>" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</section>
<?php
//verifica se botão foi pressionado
if (filter_input(INPUT_POST, 'btnSalvar')) {
    $res = $p->validarProduto(filter_input(INPUT_POST, 'codProduto', FILTER_SANITIZE_NUMBER_INT));
    if ($p->validarProduto(filter_input(INPUT_POST, 'codProduto', FILTER_SANITIZE_NUMBER_INT))) {
        $p->setCod_produto(filter_input(INPUT_POST, 'codProduto', FILTER_SANITIZE_NUMBER_INT));
        $p->setQtde(filter_input(INPUT_POST, 'qtde', FILTER_SANITIZE_NUMBER_INT));

        echo '<div class="container-fluid">'
        . '<div class="alert alert-success alert-dismissible">'
        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
        . '<h5><i class="icon fa fa-check"></i> OK!</h5>'
        . $p->inserirProduto()
        . '</div>'
        . '</div>';
        echo '<meta http-equiv="refresh" content="3; url=?p=pedido/consultarProduto"';
    }else{
        echo '<div class="container-fluid">'
        . '<div class="alert alert-danger alert-dismissible">'
        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
        . '<h5><i class="icon fa fa-times"></i> ERRO!</h5>'
        . 'Coloque um código válido para o produto'
        . '</div>'
        . '</div>';
    }
}