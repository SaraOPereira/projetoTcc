<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}
include_once '../class/cliente.php';
$cli = new Cliente();
$cpf = filter_input(INPUT_GET, 'cpf');
$cli->setCpf_cliente($cpf);

echo '<div class="container-fluid p-3">'
 . '<div class="alert alert-success alert-dismissible">'
 . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
 . '<h5><i class="icon fa fa-check"></i> Exclusão de Cliente</h5>'
 . $cli->excluir()
 . '</div>'
 . '</div>';
?>

<meta http-equiv="refresh" content="2,URL='?p=cliente/consultar'"