<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}
$ok = 's';
$_nome = "";
$_cpf = "";
$_dataNasc = "";
$_telefone = "";
$_email = "";
$_defeito = "";
$_cep = "";
include_once '../class/cliente.php';
$cli = new Cliente();
if (filter_input(INPUT_GET, 'id')) {
    $ok = 'e';
    $dados = $cli->consultar(filter_input(INPUT_GET, 'id'));
    foreach ($dados as $mostrar) {
        $_nome = $mostrar['nome'];
        $_cpf = $mostrar['cpf'];
        $_dataNasc = $mostrar['data_nasc'];
        $_telefone = $mostrar['telefone'];
        $_email = $mostrar['email'];
        $_defeito = $mostrar['defeito_refrativo'];
        $_cep = $mostrar['cep'];
    }
}
?>
<script type="text/javascript">
    $("#telefone").mask("(99) 9999-9999");
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
                    <li class="breadcrumb-item"><a href="?p=cliente/consultar">Clientes</a></li>
                    <li class="breadcrumb-item active"><?php if($ok == 'e'){echo 'Editar';}else{ echo 'Adicionar';}?> Cliente</li>
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
                <h3 class="card-title"><?php if($ok == 'e'){echo 'Editar';}else{ echo 'Adicionar';}?> Cliente</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nome">Nome do cliente</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Escreva o nome do cliente" value="<?php echo $_nome; ?>">
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF do cliente</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Escreva o CPF do cliente" value="<?php echo $_cpf; ?>">
                    </div>
                    <!-- Date range -->
                    <div class="form-group">
                        <label>Data de nascimento</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            <input type="date" class="form-control float-right" id="dataNasc" name="dataNasc" value="<?php echo $_dataNasc; ?>" maxlength="14">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- phone mask -->
                    <div class="form-group">
                        <label>Telefone</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" name="telefone" value="<?php echo $_telefone; ?>" maxlength="15">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label for="email">Endereço de email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Escreva o email do cliente" value="<?php echo $_email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="defeito">Defeito refrativo</label>
                        <input type="text" class="form-control" id="defeito" name="defeito" placeholder="Escreva o defeito refrativo do cliente" value="<?php echo $_defeito; ?>">
                    </div>
                    <div class="form-group">
                        <label>CEP</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-arrow-alt-circle-down"></i></span>
                            </div>
                            <input type="text" class="form-control" name="cep" value="<?php echo $_cep; ?>" date-inpumask="'mask':['99999-999']">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btnSalvar" name="btnSalvar" value="add">Salvar</button>
                    <a href="?p=cliente/consultar" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</section>
<?php
//verifica se botão foi pressionado
if (filter_input(INPUT_POST, 'btnSalvar')) {
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
    $resultado = FALSE;
    $res1 = $cpf[0] * 10;
    $res2 = $cpf[1] * 9;
    $res3 = $cpf[2] * 8;
    $res4 = $cpf[4] * 7;
    $res5 = $cpf[5] * 6;
    $res6 = $cpf[6] * 5;
    $res7 = $cpf[8] * 4;
    $res8 = $cpf[9] * 3;
    $res9 = $cpf[10] * 2;
    $soma1 = $res1 + $res2 + $res3 + $res4 + $res5 + $res6 + $res7 + $res8 + $res9;
    $div1 = $soma1 % 11;
    $final1 = 11 - $div1;
    if ($final1 == 10 || $final1 == 11) {
        $final1 = 0;
    }
    if ($final1 == $cpf[12]) {
        $re1 = $cpf[0] * 11;
        $re2 = $cpf[1] * 10;
        $re3 = $cpf[2] * 9;
        $re4 = $cpf[4] * 8;
        $re5 = $cpf[5] * 7;
        $re6 = $cpf[6] * 6;
        $re7 = $cpf[8] * 5;
        $re8 = $cpf[9] * 4;
        $re9 = $cpf[10] * 3;
        $re10 = $cpf[12] * 2;
        $soma2 = $re1 + $re2 + $re3 + $re4 + $re5 + $re6 + $re7 + $re8 + $re9 + $re10;
        $div2 = $soma2 % 11;
        $final2 = 11 - $div2;
        if ($final2 == 10 || $final2 == 11) {
            $final2 = 0;
        }
        if ($final2 == $cpf[13]) {
            $resultado = true;
        } else {
            $resultado = false;
        }
    } else {
        $resultado = false;
    }
    if ($resultado == true) {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $data = filter_input(INPUT_POST, 'dataNasc', FILTER_SANITIZE_STRING);
        $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
        $defeito = filter_input(INPUT_POST, 'defeito', FILTER_SANITIZE_STRING);
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);

        if ($ok == 's') {
            $cli->setCpf_cliente($cpf);
            $cli->setNome_cliente($nome);
            $cli->setEmail_cliente($email);
            $cli->setCep($cep);
            $cli->setData_nasc($data);
            $cli->setDefeito($defeito);
            $cli->setTelefone($telefone);
            echo '<div class="container-fluid">'
            . '<div class="alert alert-success alert-dismissible">'
            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
            . '<h5><i class="icon fa fa-check"></i> CLIENTE</h5>'
            . $cli->inserir()
            . '</div>'
            . '</div>';
            echo '<meta http-equiv="refresh" content="3; url=?p=cliente/consultar"';
        } else if ($ok == "e") {
            $cli->setCpf_cliente(filter_input(INPUT_GET, 'id'));
            $cli->setNome_cliente($nome);
            $cli->setEmail_cliente($email);
            $cli->setCep($cep);
            $cli->setData_nasc($data);
            $cli->setDefeito($defeito);
            $cli->setTelefone($telefone);
            echo '<div class="box">'
            . '<div class="alert alert-success" role="alert">'
            . '<h3>'
            . $cli->editarDados()
            . '</h3>'
            . '</div>'
            . '</div>';
            echo '<meta http-equiv="refresh" content="1; url=?p=cliente/consultar"';
        }
    } else {
        echo '<div class="container-fluid">'
        . '<div class="alert alert-danger alert-dismissible">'
        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
        . '<h5><i class="icon fa fa-times"></i> CLIENTE</h5>'
        . 'Seu CPF está incorreto!'
        . '</div>'
        . '</div>';
    }
}
    