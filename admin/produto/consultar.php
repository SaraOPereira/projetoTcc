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
            window.location.href = "?p=produto/excluir&id=" + id;
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
                    <li class="breadcrumb-item active">Produtos</li>
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
                    <table id="tabela" class="table table-responsive table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Validade (lente)</th>
                                <th>Cor</th>
                                <th>Modelo</th>
                                <th>Material</th>
                                <th>Defeito</th>
                                <th>Preço</th>
                                <th>Faixa etária</th>
                                <th>Disbonibilidade</th>
                                <th>Sexo</th>
                                <th>Tamanho (óculos)</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th class="text-center">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once '../class/Produto.php';
                            $p = new Produto();
                            $dados = $p->consultar(NULL);
                            foreach ($dados as $mostrar) {
                                ?>
                                <tr>
                                    <!-- 0000-00-00 `cod_produto`, `validade_lentecont`, `cor`, `modelo`, `material`, `defeito_retrativo`, `preco_produto`, 
                                    `faixa_etaria`, `disponibilidade`, `sexo`, `tamanho_oculos`, `tipo`, `marca_produto`, `nome_produto`, `descricao` -->
                                    <?php
                                    $conversao = $mostrar['validade_lentecont'];
                                    $ano = substr($conversao, 0, -6);
                                    $mes = substr($conversao, 5, -3);
                                    $dia = substr($conversao, -2);
                                    $validade = $dia . "-" . $mes . "-" . $ano;
                                    ?>
                                    <td><?php echo $mostrar['cod_produto']; ?></td>
                                    <td><?php echo $mostrar['nome_produto']; ?></td>
                                    <td><?php echo $validade; ?></td>
                                    <td><?php echo $mostrar['cor']; ?></td>
                                    <td><?php echo $mostrar['modelo']; ?></td>
                                    <td><?php echo $mostrar['material']; ?></td>
                                    <td><?php echo $mostrar['defeito_refrativo']; ?></td>
                                    <td><?php echo $mostrar['preco_produto']; ?></td>
                                    <td><?php echo $mostrar['faixa_etaria']; ?></td>
                                    <td><?php echo $mostrar['disponibilidade']; ?></td>
                                    <td><?php echo $mostrar['sexo']; ?></td>
                                    <td><?php echo $mostrar['tamanho_oculos']; ?></td>
                                    <td><?php echo $mostrar['tipo']; ?></td>
                                    <td><?php echo $mostrar['marca_produto']; ?></td>
                                    <td class="text-center">
                                        <a class='btn btn-primary btn-xs m-1' href="?p=produto/salvar&id=<?php echo $mostrar['cod_produto']; ?>"> Editar</a>
                                        <a href="?p=produto/consultarImagem&id=<?php echo $mostrar['cod_produto']; ?>" class="btn btn-info btn-xs"> Imagens</a>
                                        <a href="javascript:func()" onclick="confirmar(<?php echo $mostrar['cod_produto']; ?>)" class="btn btn-danger btn-xs m-1"> Deletar</a>
                                    </td>
                                </tr>  
<?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="?p=produto/salvar" class="btn btn-block btn-primary btn-lg" style="color: white;">Add Produto</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->