<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}
$ok = 's';
$_cpfCliente = "";
$_dataVisita = "";
$_dataPedido = "";
include_once '../class/pedido.php';
$ped = new Pedido();
if (filter_input(INPUT_GET, 'id')) {
    $ok = 'e';
    $dados = $ped->consultar(filter_input(INPUT_GET, 'id'));
    foreach ($dados as $mostrar) {
        $_dataPedido = $mostrar['data_pedido'];
        $_dataVisita = $mostrar['data_visita'];
        $_cpfCliente = $mostrar['cpf_cliente'];
    }
}
?>
<script type="text/javascript">
    function confirmar(id) {
        var resposta = confirm("Deseja excluir?");

        if (resposta) {
            window.location.href = "?p=pedido/excluir&id=" + id;
        }
    }
</script>
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
                    <li class="breadcrumb-item active">Adicionar pedido</li>
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
                <h3 class="card-title">Adicionar Pedido</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" name="form" id="form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="cpfCliente">CPF do cliente</label>
                        <input type="text" class="form-control"  id="cpfCliente" name="cpfCliente" value="<?php echo $_cpfCliente; ?>" maxlength="14">
                    </div>
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                        <label>Data de visita</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control"  value="<?php echo $_dataVisita ?>" name="dataVisita" maxlenght="10">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                        <label>Data do pedido</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control" value="<?php echo $_dataPedido ?>" name="dataPedido" maxlenght="10">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btnSalvar" name="btnSalvar" value="add">Salvar</button>
                    <a href="?p=pedido/consultar" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</section>
<?php
//verifica se botão foi pressionado
if (filter_input(INPUT_POST, 'btnSalvar')) {
    $res = $ped->validarCliente(filter_input(INPUT_POST, 'cpfCliente', FILTER_SANITIZE_STRING));
    if ($res) {
        $cpfCliente = filter_input(INPUT_POST, 'cpfCliente', FILTER_SANITIZE_STRING);
        $dataPedido = filter_input(INPUT_POST, 'dataPedido', FILTER_SANITIZE_STRING);
        $dataVisita = filter_input(INPUT_POST, 'dataVisita', FILTER_SANITIZE_STRING);

        if ($ok == 's') {
            $ped->setCpf_cliente($cpfCliente);
            $ped->setData_pedido($dataPedido);
            $ped->setData_visita($dataVisita);

            echo '<div class="container-fluid">'
            . '<div class="alert alert-success alert-dismissible">'
            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
            . '<h5><i class="icon fa fa-check"></i> PEDIDO!</h5>'
            . $ped->inserir()
            . '</div>'
            . '</div>';
            //echo '<meta http-equiv="refresh" content="3; url=?p=pedido/consultar"';
        } else if ($ok == "e") {
            $ped->setCod_pedido(filter_input(INPUT_GET, 'id'));
            $ped->setCpf_cliente($cpfCliente);
            $ped->setData_pedido($dataPedido);
            $ped->setData_visita($dataVisita);

            echo '<div class="container-fluid">'
            . '<div class="alert alert-success alert-dismissible">'
            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
            . '<h5><i class="icon fa fa-check"></i> PEDIDO!</h5>'
            . $ped->editarDados()
            . '</div>'
            . '</div>';
            echo '<meta http-equiv="refresh" content="2; url=?p=pedido/consultar"';
        }
    } else {
        echo '<div class="container-fluid">'
        . '<div class="alert alert-danger alert-dismissible">'
        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
        . '<h5><i class="icon fa fa-times"></i> ERRO!</h5>'
        . 'Insira um CPF válido!'
        . '</div>'
        . '</div>';
    }
}
