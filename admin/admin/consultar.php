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
            window.location.href = "?p=admin/excluir&id=" + id;
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
                    <li class="breadcrumb-item active">Administradores</li>
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
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Imagem</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once '../class/Admin.php';
                            $adm = new Admin();
                            $dados = $adm->consultar(NULL);
                            foreach ($dados as $mostrar) {
                                ?>
                                <tr>
                                    <td><?php echo $mostrar['id']; ?></td>
                                    <td><?php echo $mostrar['nome_admin']; ?></td>
                                    <td><?php echo $mostrar['email']; ?></td>
                                    <td>
                                        <a href="?p=admin/editarImagem&id=<?php echo $mostrar['id']; ?>&img=<?php echo $mostrar['imagem']; ?>"title="editar imagem">
                                            <img src="../imagem/admin/<?php echo $mostrar['imagem']; ?>" alt="Imagem de <?php echo $mostrar['nome_admin']; ?>" style="width: 150px;">
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a class='btn btn-info btn-xs' href="?p=admin/salvar&id=<?php echo $mostrar['id']; ?>"> Editar</a>
                                        <a href="javascript:func()" onclick="confirmar(<?php echo $mostrar['id']; ?>)" class="btn btn-danger btn-xs"> Deletar</a>
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
                    <a href="?p=admin/salvar" class="btn btn-block btn-primary btn-lg" style="color: white;">Add Admin</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->