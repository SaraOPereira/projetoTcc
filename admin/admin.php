<?php
session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once 'head.php'; ?>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <?php require_once 'topo.php'; ?>
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <?php require_once 'nav.php'; ?>
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php
                $pagina = filter_input(INPUT_GET, 'p');
                //@$pagina = $_GET['p'];

                if ($pagina == '' || empty($pagina) || $pagina == 'index' ||
                        $pagina == 'index.php') {
                    include_once 'pagina-inicial.php';
                } else {
                    if (file_exists($pagina . '.php')) {
                        include_once $pagina . '.php';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">'
                        . '<h3>Erro 404</h3>'
                        . '<p>Página não encontrada!</p>'
                        . '</div>';
                    }
                }
                ?>
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS --><!-- jQuery -->
        <!-- jQuery -->
        <script src="../js/jquery/jquery.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../js/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../js/adminlte.min.js"></script>
        <script src="../js/demo.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="../js/plugins/daterangepicker/daterangepicker.js"></script>
    </body>
</html>