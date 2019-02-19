<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
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
                    <li class="breadcrumb-item active">Pedidos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabela" class="table table-responsive-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Data do pedido</th>
                                <th>Data da Visita</th>
                                <th>CPF Cliente</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once '../class/pedido.php';
                            $ped = new Pedido();
                            $dados = $ped->consultar(null);
                            foreach ($dados as $mostrar) {
                                ?>
                                <tr>
                                    <td><?php echo $mostrar['cod_pedido']; ?></td>
                                    <td><?php echo $mostrar['data_pedido']; ?></td>
                                    <td><?php echo $mostrar['data_visita']; ?></td>
                                    <td><?php echo $mostrar['cpf_cliente']; ?></td>
                                    <td class="text-center">
                                        <a class='btn btn-primary btn-xs' href="?p=pedido/salvar&id=<?php echo $mostrar['cod_pedido']; ?>">Editar</a>
                                        <a class='btn btn-info btn-xs' href="?p=pedido/consultarProduto&id=<?php echo $mostrar['cod_pedido']; ?>">Produtos</a>
                                        <a href="javascript:func()" onclick="confirmar(<?php echo $mostrar['cod_pedido']; ?>)" class="btn btn-danger btn-xs">Deletar</a>
                                    </td>
                                </tr>  
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-body">
                    <a href="?p=pedido/salvar" class="btn btn-block btn-primary btn-lg" style="color: white;">Add Pedido</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->