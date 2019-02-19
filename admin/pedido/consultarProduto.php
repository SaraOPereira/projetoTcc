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
            window.location.href = "?p=pedido/excluirProduto&id=" + id;
        }
    }
</script>
<!-- Content Header (Page header) - Início da página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Produtos do pedido</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=pagina-inicial">Home</a></li>
                    <li class="breadcrumb-item"><a href="?p=pedido/consultar">Pedidos</a></li>
                    <li class="breadcrumb-item active">Produtos</li>
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
                                <th>Código do Pedido</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once '../class/pedido.php';
                            $ped = new Pedido();
                            $id = filter_input(INPUT_GET, 'id');
                            $dados = $ped->consultarProduto($id);
                            foreach ($dados as $mostrar) {
                                ?>
                                <tr>
                                    <td><?php echo $mostrar['cod_pedido']; ?></td>
                                    <td><?php echo $mostrar['cod_produto']; ?></td>
                                    <td><?php echo $mostrar['qtde']; ?></td>
                                    <td class="text-center">
                                        <a class='btn btn-primary btn-xs' href="?p=pedido/editarProduto&id=<?php echo $mostrar['cod_pedido']; ?>">Editar</a>
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
                    <a href="?p=pedido/salvarProduto&id=<?php echo $id; ?>" class="btn btn-block btn-primary btn-lg" style="color: white;">Add Produto</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->