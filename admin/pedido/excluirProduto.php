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

echo '<div class="container-fluid p-3">'
 . '<div class="alert alert-success alert-dismissible">'
 . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
 . '<h5><i class="icon fa fa-check"></i> Exclusão do produto do pedido</h5>'
 . $p->excluirProduto()
 . '</div>'
 . '</div>';
?>

<meta http-equiv="refresh" content="2,URL='?p=pedido/consultarProduto&id=<?php echo $id; ?>'"