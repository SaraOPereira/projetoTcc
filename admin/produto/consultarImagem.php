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
            window.location.href = "?p=produto/excluirImagem&id=" + id;
        }
    }
</script>
<!-- Content Header (Page header) - Início da página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Produtos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=pagina-inicial">Home</a></li>
                    <li class="breadcrumb-item"><a href="?p=produto/consultar">Produtos</a></li>
                    <li class="breadcrumb-item active">Imagens do Produto <?php ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
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
                                <th>Código da Imagem</th>
                                <th>Imagem</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once '../class/Produto.php';
                            $p = new Produto();
                            $dados = $p->consultarImagem(filter_input(INPUT_GET, 'id'), "");
                            foreach ($dados as $mostrar) {
                                ?>
                                <tr>
                                    <td><?php echo $mostrar['cod_produto']; ?></td>
                                    <td><?php echo $mostrar['cod_imagem']; ?></td>
                                    <td>
                                        <img src="../imagem/produto/<?php echo $mostrar['imagem']; ?>" alt="Imagem de <?php echo $mostrar['imagem']; ?>" style="width: 150px;">
                                    </td>
                                    <td class="text-center">
                                        <a class='btn btn-info btn-xs' href="?p=produto/editarImagem&id=<?php echo filter_input(INPUT_GET, 'id'); ?>&codImagem=<?php echo $mostrar['cod_imagem'];?>"> Editar</a>
                                        <a href="javascript:func()" onclick="confirmar(<?php echo filter_input(INPUT_GET, 'id'); ?>)" class="btn btn-danger btn-xs"> Deletar</a>
                                    </td>
                                </tr>  
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="?p=produto/salvarImagem&id=<?php echo filter_input(INPUT_GET, 'id'); ?>" class="btn btn-block btn-primary btn-lg" style="color: white;">Add Imagem</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->