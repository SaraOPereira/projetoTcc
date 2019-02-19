<!-- Carousel -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img class="first-slide img-fluid" src="imagem/carousel2.jpg" class="img-fluid" alt="First slide">
            <div class="container">
                <div class="carousel-caption d-none d-md-block text-left">
                    <h1>Bem vindo à Ótica Express</h1>
                    <p>Aqui você encontra uma variedade de produtos que irão te atender em todas as necessidades.</p>
                    <p><a class="btn btn-lg btn-primary" href="<?php echo $url->getBase(); ?>catalogo" role="button">Ver o catálogo</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="second-slide img-fluid" src="imagem/carousel1.jpg" alt="Second slide">
            <div class="container">
                <div class="carousel-caption d-none d-md-block">
                    <h1>Nosso diferencial</h1>
                    <p>Levamos nossos produtos até sua casa, garantindo, assim, sua total satisfação.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img class="third-slide img-fluid" src="imagem/carousel3.jpg" alt="Third slide">
            <div class="container">
                <div class="carousel-caption d-none d-md-block text-right">
                    <h1>Quer nossa visita?</h1>
                    <p><a class="btn btn-lg btn-primary" href="<?php echo $url->getBase();?>mensagem" role="button">Pedir visita</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
    </a>
</div>
<!-- Carousel - Fim -->
<div class="container marketing">
    <!-- START THE FEATURETTES -->
    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">Óculos de grau. <span class="text-muted">Feito para sua necessidade.</span></h2>
            <p class="lead">Nossos óculos de grau são desenvolvidos com o objetivo de ser confortáveis ao cliente e te ajudar com o defeito refrativo.</p>
        </div>
        <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="imagem/img2.jpg" alt="Generic placeholder image">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-5 pull-md-7">
            <img class="featurette-image img-fluid mx-auto" src="imagem/img3.jpg" alt="Generic placeholder image">
        </div>
        <div class="col-md-7 push-md-5">
            <h2 class="featurette-heading">Óculos de sol. <span class="text-muted">Estilo e conforto.</span></h2>
            <p class="lead">Nosos óculos de sol são de ótimas marcas e super confortáveis, se adaptando ao seu tipo de rosto.</p>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">Lentes de contato. <span class="text-muted">Cor e grau.</span></h2>
            <p class="lead">Temos lentes de contato para aquilo que você quer, sendo somente cor, somente grau ou uma combinação perfeita dos dois.</p>
        </div>
        <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="imagem/img1.jpg" alt="Generic placeholder image">
        </div>
    </div>
    <hr class="featurette-divider">
    <!-- /END THE FEATURETTES -->
</div><!-- /.container -->