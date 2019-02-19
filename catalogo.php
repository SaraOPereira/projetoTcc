<?php
date_default_timezone_set('America/Sao_Paulo');
//session_start();
include_once 'class/Url.php';
$url = new Url();

include_once './class/Produto.php';
$prod = new Produto();

include_once './class/Pedido.php';
$ped = new Pedido();
?>
<div class="h-50 d-flex align-items-center" style="background: url(imagem/background.jpg) no-repeat; margin-bottom: 2rem;">
    <div class="container">
        <div class="row">
            <div class="mx-auto text-center col-md-6 text-white">
                <h1 class="display-1">Catálogo</h1>
            </div>
        </div>
    </div>
</div>
<!-- Filtros -->
<div class="container">
    <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#filtro" role="button" aria-expanded="false" aria-controls="collapseExample">
            Filtros
        </a>
    </p>
    <div class="collapse" id="filtro">
        <form method="post" enctype="multipart/form-data" role="form">
            <div class="card card-body">
                <input placeholder="Pesquise aqui..." name="pesquisa" type="text" class="form-control">
                <br>
                <div class="container">
                    <div class="row">
                        <select class="form-control" style="width: 21.9rem;height: auto;" name="marca">
                            <option value="" selected>Marca</option>
                            <?php
                            $marca = $prod->consultarFiltro('marca_produto', "");
                            foreach ($marca as $mMarca) {
                                ?>
                                <option value="<?php echo $mMarca['marca_produto']; ?>"><?php echo $mMarca['marca_produto']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <select class="form-control" style="width: 21.9rem;height: auto; margin-left: 0.5rem;" name="cor">
                            <option value="" selected>Cor</option>
                            <?php
                            $cor = $prod->consultarFiltro('cor', "");
                            foreach ($cor as $mCor) {
                                ?>
                                <option value="<?php echo $mCor['cor']; ?>"><?php echo $mCor['cor']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <select class="form-control" style="width: 21.9rem;height: auto; margin-left: 0.5rem;" name="defeito">
                            <option value="" selected>Defeito Refrativo</option>
                            <?php
                            $defeito = $prod->consultarFiltro('defeito_refrativo', "");
                            foreach ($defeito as $mDefeito) {
                                ?>
                                <option value="<?php echo $mDefeito['defeito_refrativo']; ?>"><?php echo $mDefeito['defeito_refrativo']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="row">
                        <select class="form-control" style="width: 21.9rem;height: auto;" name="tamanho">
                            <option value="" selected>Tamanho</option>
                            <?php
                            $tamanho = $prod->consultarFiltro('tamanho_oculos', "");
                            foreach ($tamanho as $mTamanho) {
                                ?>
                                <option value="<?php echo $mTamanho['tamanho_oculos']; ?>"><?php echo $mTamanho['tamanho_oculos']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <select class="form-control" style="width: 21.9rem;height: auto; margin-left: 0.5rem;" name="disponivel">
                            <option value="" selected>Disponibilidade</option>
                            <?php
                            $disponivel = $prod->consultarFiltro('disponibilidade', "");
                            foreach ($disponivel as $mDisponivel) {
                                ?>
                                <option value="<?php echo $mDisponivel['disponibilidade']; ?>"><?php echo $mDisponivel['disponibilidade']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <select class="form-control" style="width: 21.9rem;height: auto; margin-left: 0.5rem;" name="material">
                            <option value="" selected>Material</option>
                            <?php
                            $material = $prod->consultarFiltro('material', "");
                            foreach ($material as $mMaterial) {
                                ?>
                                <option value="<?php echo $mMaterial['material']; ?>"><?php echo $mMaterial['material']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="row">
                        <select class="form-control" style="width: 21.9rem;height: auto;" name="faixa">
                            <option value="" selected>Faixa Etária</option>
                            <?php
                            $faixa = $prod->consultarFiltro('faixa_etaria', "");
                            foreach ($faixa as $mFaixa) {
                                ?>
                                <option value="<?php echo $mFaixa['faixa_etaria']; ?>"><?php echo $mFaixa['faixa_etaria']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <select class="form-control" style="width: 21.9rem;height: auto; margin-left: 0.5rem;" name="sexo">
                            <option value="" selected>Sexo</option>
                            <?php
                            $sexo = $prod->consultarFiltro('sexo', "");
                            foreach ($sexo as $mSexo) {
                                ?>
                                <option value="<?php echo $mSexo['sexo']; ?>"><?php echo $mSexo['sexo']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <select class="form-control" style="width: 21.9rem;height: auto; margin-left: 0.5rem;" name="tipo">
                            <option value="" selected>Tipo</option>
                            <?php
                            $tipo = $prod->consultarFiltro('tipo', "");
                            foreach ($tipo as $mTipo) {
                                ?>
                                <option value="<?php echo $mTipo['tipo']; ?>"><?php echo $mTipo['tipo']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <button class="btn btn-info" value="add" type="submit" name="btnFiltrar">Filtrar</button>
            </div>
            <!-- Fim do card -->
            <br>
        </form>
    </div>
</div>
<?php
if (filter_input(INPUT_POST, 'btnFiltrar')) {
    $arrayFiltro = array(
        "Marca" => filter_input(INPUT_POST, 'marca'),
        "Cor" => filter_input(INPUT_POST, 'cor'),
        "Defeito" => filter_input(INPUT_POST, 'defeito'),
        "Tamanho" => filter_input(INPUT_POST, 'tamanho'),
        "Disponivel" => filter_input(INPUT_POST, 'disponivel'),
        "Material" => filter_input(INPUT_POST, 'material'),
        "Faixa" => filter_input(INPUT_POST, 'faixa'),
        "Sexo" => filter_input(INPUT_POST, 'sexo'),
        "Tipo" => filter_input(INPUT_POST, 'tipo'),
        "Pesquisa" => filter_input(INPUT_POST, 'pesquisa'),
    );

    $sql = 'SELECT * FROM produto';
    if ($arrayFiltro['Marca'] != '') {
        $sql .= ' WHERE marca_produto = "' . $arrayFiltro['Marca'] . '"';
    }
    if ($arrayFiltro['Cor'] != '') {
        if ($arrayFiltro['Marca'] != '') {
            $sql .= ' AND cor = "' . $arrayFiltro['Cor'] . '"';
        } else {
            $sql .= ' WHERE cor = "' . $arrayFiltro['Cor'] . '"';
        }
    }
    if ($arrayFiltro['Defeito'] != '') {
        if ($arrayFiltro['Marca'] != '' || $arrayFiltro['Cor'] != '') {
            $sql .= ' AND defeito_refrativo = "' . $arrayFiltro['Defeito'] . '"';
        } else {
            $sql .= ' WHERE defeito_refrativo = "' . $arrayFiltro['Defeito'] . '"';
        }
    }
    if ($arrayFiltro['Tamanho'] != '') {
        if ($arrayFiltro['Marca'] != '' || $arrayFiltro['Cor'] != '' || $arrayFiltro['Defeito'] != '') {
            $sql .= ' AND tamanho_oculos = "' . $arrayFiltro['Tamanho'] . '"';
        } else {
            $sql .= ' WHERE tamanho_oculos = "' . $arrayFiltro['Tamanho'] . '"';
        }
    }
    if ($arrayFiltro['Disponivel'] != '') {
        if ($arrayFiltro['Marca'] != '' || $arrayFiltro['Cor'] != '' || $arrayFiltro['Defeito'] != '' ||
                $arrayFiltro['Tamanho'] != '') {
            $sql .= ' AND disponibilidade = "' . $arrayFiltro['Disponivel'] . '"';
        } else {
            $sql .= ' WHERE disponibilidade = "' . $arrayFiltro['Disponivel'] . '"';
        }
    }
    if ($arrayFiltro['Material'] != '') {
        if ($arrayFiltro['Marca'] != '' || $arrayFiltro['Cor'] != '' || $arrayFiltro['Defeito'] != '' ||
                $arrayFiltro['Tamanho'] != '' || $arrayFiltro['Disponivel'] != '') {
            $sql .= ' AND material = "' . $arrayFiltro['Material'] . '"';
        } else {
            $sql .= ' WHERE material = "' . $arrayFiltro['Material'] . '"';
        }
    }
    if ($arrayFiltro['Faixa'] != '') {
        if ($arrayFiltro['Marca'] != '' || $arrayFiltro['Cor'] != '' || $arrayFiltro['Defeito'] != '' ||
                $arrayFiltro['Tamanho'] != '' || $arrayFiltro['Disponivel'] != '' || $arrayFiltro['Material'] != '') {
            $sql .= ' AND faixa_etaria = "' . $arrayFiltro['Faixa'] . '"';
        } else {
            $sql .= ' WHERE faixa_etaria = "' . $arrayFiltro['Faixa'] . '"';
        }
    }
    if ($arrayFiltro['Sexo'] != '') {
        if ($arrayFiltro['Marca'] != '' || $arrayFiltro['Cor'] != '' || $arrayFiltro['Defeito'] != '' ||
                $arrayFiltro['Tamanho'] != '' || $arrayFiltro['Disponivel'] != '' || $arrayFiltro['Material'] != '' ||
                $arrayFiltro['Faixa'] != '') {
            $sql .= ' AND sexo = "' . $arrayFiltro['Sexo'] . '"';
        } else {
            $sql .= ' WHERE sexo = "' . $arrayFiltro['Sexo'] . '"';
        }
    }
    if ($arrayFiltro['Tipo'] != '') {
        if ($arrayFiltro['Marca'] != '' || $arrayFiltro['Cor'] != '' || $arrayFiltro['Defeito'] != '' ||
                $arrayFiltro['Tamanho'] != '' || $arrayFiltro['Disponivel'] != '' || $arrayFiltro['Material'] != '' ||
                $arrayFiltro['Faixa'] != '' || $arrayFiltro['Sexo'] != '') {
            $sql .= ' AND tipo = "' . $arrayFiltro['Tipo'] . '"';
        } else {
            $sql .= ' WHERE tipo = "' . $arrayFiltro['Tipo'] . '"';
        }
    }
    if ($arrayFiltro['Pesquisa']) {
        if ($arrayFiltro['Marca'] != '' || $arrayFiltro['Cor'] != '' || $arrayFiltro['Defeito'] != '' ||
                $arrayFiltro['Tamanho'] != '' || $arrayFiltro['Disponivel'] != '' || $arrayFiltro['Material'] != '' ||
                $arrayFiltro['Faixa'] != '' || $arrayFiltro['Sexo'] != '' || $arrayFiltro['Tipo'] != '') {
            $sql .= ' AND nome_produto LIKE "%' . $arrayFiltro['Pesquisa'] . '%"';
        } else {
            $sql .= ' WHERE nome_produto LIKE "%' . $arrayFiltro['Pesquisa'] . '%"';
        }
    }

    include_once './class/Conectar.php';
    try {
        $con = new Conectar();
        $ligacao = $con->prepare($sql);
        if ($ligacao->execute() == 1) {
            $filtro = $ligacao->fetchAll();
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
<!-- Produtos -->
<div class="container col-md-10" id="produtos">
    <div class="card-columns">
        <?php
        if (filter_input(INPUT_POST, 'btnFiltrar')) {
            foreach ($filtro as $mostrar) {
                $dadosImg = $prod->consultarImagem($mostrar['cod_produto'], "1");
                foreach ($dadosImg as $mostrarImg) {
                    $img = $mostrarImg['imagem'];
                }
                $id = $mostrar['cod_produto'];
                ?>
                <div class="card">
                    <img class="img-fluid card-img-top" src="imagem/produto/<?php echo $img; ?>" alt="Primeira Imagem" style="height: auto;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $mostrar['nome_produto']; ?></h5>
                        <p class="card-text"><?php echo $mostrar['descricao']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" href="<?php $url->getBase(); ?>produto" data-toggle="modal" data-target="#exampleModal<?php echo $id; ?>">
                            Ver mais</a>
                    </div>
                </div>
                <div class="modal fade bd-example-modal-lg" id="exampleModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $mostrar['nome_produto']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="carousel slide" data-ride="carousel" id="carouselExampleControls">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="img-fluid" src="imagem/produto/<?php echo $img; ?>" alt="First slide">
                                        </div>
                                        <?php
                                        $dadosImg2 = $prod->consultarImagem($mostrar['cod_produto'], "2");
                                        foreach ($dadosImg2 as $mostrarImg) {
                                            ?>
                                            <div class="carousel-item">
                                                <img class="img-fluid" src="imagem/produto/<?php echo $mostrarImg['imagem']; ?>" alt="Second slide">
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <p class="text-justify"><?php echo $mostrar['descricao']; ?></p>
                                <p>Cor: <?php echo $mostrar['cor']; ?></p>
                                <p>Marca: <?php echo $mostrar['marca_produto']; ?></p>
                                <p>Material: <?php echo $mostrar['material']; ?></p>
                                <p>Modelo: <?php echo $mostrar['modelo']; ?></p>
                                <p>Defeito refrativo: <?php echo $mostrar['defeito_refrativo']; ?></p>
                                <p>Disponibilidade: <?php echo $mostrar['disponibilidade']; ?></p>
                                <h4>R$ <?php echo $mostrar['preco_produto']; ?></h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            $dados = $prod->consultar("");
            foreach ($dados as $mostrar) {
                $dadosImg = $prod->consultarImagem($mostrar['cod_produto'], "1");
                foreach ($dadosImg as $mostrarImg) {
                    $img = $mostrarImg['imagem'];
                }
                $id = $mostrar['cod_produto'];
                ?>
                <div class="card">
                    <img class="img-fluid card-img-top" src="imagem/produto/<?php echo $img; ?>" alt="Primeira Imagem" style="height: auto;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $mostrar['nome_produto']; ?></h5>
                        <p class="card-text"><?php echo $mostrar['descricao']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" href="<?php $url->getBase(); ?>produto" data-toggle="modal" data-target="#exampleModal<?php echo $id; ?>">
                            Ver mais</a>
                    </div>
                </div>
                <div class="modal fade bd-example-modal-lg" id="exampleModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $mostrar['nome_produto']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <div class="carousel slide" data-ride="carousel" id="carouselExampleControls" style="height: auto; width: auto;">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="img-fluid" src="imagem/produto/<?php echo $img; ?>" alt="First slide">
                                            </div>
                                            <?php
                                            $dadosImg2 = $prod->consultarImagem($mostrar['cod_produto'], "2");
                                            foreach ($dadosImg2 as $mostrarImg) {
                                                ?>
                                                <div class="carousel-item">
                                                    <img class="img-fluid" src="imagem/produto/<?php echo $mostrarImg['imagem']; ?>" alt="Second slide">
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    <p class="text-justify"><?php echo $mostrar['descricao']; ?></p>
                                    <p>Código: <?php echo $mostrar['cod_produto']; ?></p>
                                    <p>Cor: <?php echo $mostrar['cor']; ?></p>
                                    <p>Marca: <?php echo $mostrar['marca_produto']; ?></p>
                                    <p>Material: <?php echo $mostrar['material']; ?></p>
                                    <p>Modelo: <?php echo $mostrar['modelo']; ?></p>
                                    <p>Defeito refrativo: <?php echo $mostrar['defeito_refrativo']; ?></p>
                                    <p>Disponibilidade: <?php echo $mostrar['disponibilidade']; ?></p>
                                    <h4>R$ <?php echo $mostrar['preco_produto']; ?></h4>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<br>