<?php
require_once 'class/Url.php';
$url = new Url();
$p = $url->getURL(0);

$home = "";
$quemSomos = "";
$catalogo = "";

if ($p == 'home' || $p == null) {
    $home = "active";
} else if ($p == 'quemSomos') {
    $home = "";
    $quemSomos = "active";
} else if ($p == 'catalogo') {
    $quemSomos = "";
    $catalogo = "active";
}
?>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo $url->getBase(); ?>home"><img src="imagem/1_Primary_logo_on_transparent_132x73.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php echo $home; ?>">
                    <a class="nav-link" href="<?php $url->getBase(); ?>home">Ótica Express <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php echo $quemSomos; ?>">
                    <a class="nav-link" href="<?php $url->getBase(); ?>quemSomos">Quem somos</a>
                </li>
                <li class="nav-item <?php echo $catalogo; ?>">
                    <a class="nav-link" href="<?php $url->getBase(); ?>catalogo">Catálogo</a>
                </li>
            </ul>
            <a class="btn btn-primary btn-lg" href="<?php $url->getBase(); ?>mensagem">Solicite nossa visita!</a>
        </div>
    </nav>
</header>