<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}
include_once '../class/produto.php';
$pro = new Produto();
$id = filter_input(INPUT_GET, 'id');
$pro->setCod_produto($id);

echo '<div class="container-fluid p-3">'
 . '<div class="alert alert-success alert-dismissible">'
 . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
 . '<h5><i class="icon fa fa-check"></i> Exclusão da imagem do produto</h5>'
 . $pro->excluirImagem()
 . '</div>'
 . '</div>';
?>

<meta http-equiv="refresh" content="2,URL='?p=produto/consultar'"