<!-- Brand Logo -->
<a href="?p=pagina-inicial" class="brand-link">
    <img src="../imagem/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Ótica Express</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <!-- Colocar imagem via PHP -->
            <img src="../imagem/admin/<?php $json = file_get_contents('adminAtivo.json'); foreach (json_decode($json) as $img){echo $img->imagem;} ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="?p=pagina-inicial" class="d-block"><?php $json = file_get_contents('adminAtivo.json'); foreach (json_decode($json) as $img){echo $img->nome_admin;} ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-align-justify"></i>
                    <p>
                        Páginas
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="?p=admin/consultar" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Administradores</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?p=cliente/consultar" class="nav-link">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>Clientes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?p=produto/consultar" class="nav-link">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p>Produtos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?p=pedido/consultar" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>Pedidos</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->