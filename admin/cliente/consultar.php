<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}
?>
<script type="text/javascript">
    function confirmar(cpf) {
        var resposta = confirm("Deseja excluir?");

        if (resposta) {
            window.location.href = "?p=cliente/excluir&cpf=" + cpf;
        }
    }
</script>
<!-- Content Header (Page header) - Início da página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Clientes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=pagina-inicial">Home</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
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
                                <th>CPF</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Data de Nascimento</th>
                                <th>Defeito refrativo</th>
                                <th>CEP</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once '../class/Cliente.php';
                            $cli = new Cliente();
                            $dados = $cli->consultar(NULL);
                            foreach ($dados as $mostrar) {
                                ?>
                                <tr>
                                    <td><?php echo $mostrar['cpf']; ?></td>
                                    <td><?php echo $mostrar['nome']; ?></td>
                                    <td><?php echo $mostrar['email']; ?></td>
                                    <td><?php echo $mostrar['telefone']; ?></td>
                                    <td><?php echo $mostrar['data_nasc']; ?></td>
                                    <td><?php echo $mostrar['defeito_refrativo']; ?></td>
                                    <td><?php echo $mostrar['cep']; ?></td>
                                    <td class="text-center">
                                        <a class='btn btn-info btn-xs' href="?p=cliente/salvar&id=<?php echo $mostrar['cpf']; ?>"> Editar</a>
                                        <a href="javascript:func()" onclick="confirmar('<?php echo $mostrar['cpf']; ?>')" class='btn btn-danger btn-xs'> Deletar</a>
                                    </td>
                                </tr>  
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-body">
                    <a href="?p=cliente/salvar" class="btn btn-block btn-primary btn-lg" style="color: white;">Add Cliente</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->