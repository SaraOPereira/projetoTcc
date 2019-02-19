<?php
date_default_timezone_set('America/Sao_Paulo');
//session_start();
include_once 'class/Url.php';
$url = new Url();
?>
<html lang="pt-br">
    <head>
        <?php include_once 'head.php'; ?>
    </head>
    <body>
        <div class="geral text-body">
            <?php include_once 'navbar.php'; ?>
            <section>
                <?php
                //code para linkagem das páginas
                //captura a posição 0 (página) do vetor gerado pela class URL
                $p = $url->getURL(0);
                //se $p página for nula
                if ($p == null) {
                    $p = "home";
                }
                //se a página/arquivo não existe
                if (!file_exists($p . ".php")) {
                    echo "<br><br><div class='conteiner'>
                        <div class='row justify-content-center'>
                        <div class='col-lg-8 align-self-center'>
                        <div class='alert alert-danger' role='alert'>
                        <h3>Erro 404</h3>
                        <p>Página não encontrada</p>
                        </div></div></div></div><br><br>";
                } else {
                    include_once $p . ".php";
                }
                ?>
            </section>
            <footer class="footer">
                <?php include_once 'footer.php'; ?>
            </footer>
            <!-- Javascript's do Bootstrap -->
            <script src="js/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
            <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
            <script src="js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
            <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="js/holder.min.js"></script>
            <script src="js/ie10-viewport-bug-workaround.js"></script>
        </div>
    </body>
</html>