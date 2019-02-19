<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}
include_once '../class/admin.php';
$adm = new Admin();
$id = filter_input(INPUT_GET, 'id');
$adm->setId($id);

echo '<div class="container-fluid p-3">'
 . '<div class="alert alert-success alert-dismissible">'
 . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
 . '<h5><i class="icon fa fa-check"></i> Exclusão de administrador</h5>'
 . $adm->excluir()
 . '</div>'
 . '</div>';
?>

<meta http-equiv="refresh" content="2,URL='?p=admin/consultar'"