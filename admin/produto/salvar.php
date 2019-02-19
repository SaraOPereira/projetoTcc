<?php
//session_start();
if (!isset($_SESSION['acesso'])) {
    session_destroy();
    unset($_SESSION['acesso']);
    header('location:index.php');
}
$ok = 's';
$_cod = "";
$_nome = "";
$_val = "";
$_cor = "";
$_modelo = "";
$_material = "";
$_defeito = "";
$_preco = "";
$_idade = "";
$_dis = "";
$_sexo = "";
$_tam = "";
$_tipo = "";
$_marca = "";
$_desc = "";
$adulto = "selected";
$infantil = "";
$oculosGrau = "selected";
$oculosSol = "";
$oculosSolGrau = "";
$lente = "";
$lenteGrau = "";
$m = "";
$f = "";
$todos = "selected";
$sim = "selected";
$nao = "";
include_once '../class/produto.php';
$pro = new Produto();
if (filter_input(INPUT_GET, 'id')) {
    $ok = 'e';
    $dados = $pro->consultar(filter_input(INPUT_GET, 'id'));
    foreach ($dados as $mostrar) {
        $_cod = $mostrar['cod_produto'];
        $_nome = $mostrar['nome_produto'];
        $_val = $mostrar['validade_lentecont'];
        $_cor = $mostrar['cor'];
        $_modelo = $mostrar['modelo'];
        $_material = $mostrar['material'];
        $_defeito = $mostrar['defeito_refrativo'];
        $_marca = $mostrar['marca_produto'];
        $_desc = $mostrar['descricao'];
        $_tam = $mostrar['tamanho_oculos'];

        $_p = $mostrar['preco_produto'];
        $casasAntes = "";
        $casasDepois = "";
        $_preco = "";
        if (substr($_p, -3, 1) == '.') {
            $casasAntes = substr($_p, -2);
            $casasDepois = substr($_p, 3);
            $_preco = $casasDepois . "," . $casasAntes;
        } else {
            $_preco = $_p . ",00";
        }

        $adulto = "selected";
        $infantil = "";
        if ($mostrar['faixa_etaria'] == 'Adulto') {
            $adulto = "selected";
            $infantil = "";
        } else if ($mostrar['faixa_etaria'] == 'Infantil') {
            $adulto = "";
            $infantil = "selected";
        }

        $m = "";
        $f = "";
        $todos = "selected";
        if ($mostrar['sexo'] == 'todos') {
            $todos = "selected";
        } else if ($mostrar['sexo'] == 'mas') {
            $todos = "";
            $m = "selected";
        } else if ($mostrar['sexo'] == 'fem') {
            $m = "";
            $f = "selected";
        }

        $oculosGrau = "selected";
        $oculosSol = "";
        $oculosSolGrau = "";
        $lente = "";
        $lenteGrau = "";
        if ($mostrar['tipo'] == 'oculosGrau') {
            $oculosGrau = "selected";
        } else if ($mostrar['tipo'] == 'oculosSol') {
            $oculosGrau = "";
            $oculosSol = "selected";
        } else if ($mostrar['tipo'] == 'oculosSolGrau') {
            $oculosSol = "";
            $oculosSolGrau = "selected";
        } else if ($mostrar['tipo'] == 'lente') {
            $oculosSolGrau = "";
            $lente = "selected";
        } else if ($mostrar['tipo'] == 'lenteGrau') {
            $lente = "";
            $lenteGrau = "selected";
        }

        $sim = "selected";
        $nao = "";
        if ($mostrar['disponibilidade'] == "sim") {
            $sim = "selected";
            $nao = "";
        } else if ($mostrar['disponibilidade'] == "nao") {
            $sim = "";
            $nao = "selected";
        }
    }
}
?>
<!-- Mascara para moeda -->
<script type="text/javascript">
    function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e) {
        var sep = 0;
        var key = '';
        var i = j = 0;
        var len = len2 = 0;
        var strCheck = '0123456789';
        var aux = aux2 = '';
        var whichCode = (window.Event) ? e.which : e.keyCode;
        if (whichCode == 13)
            return true;
        key = String.fromCharCode(whichCode); // Valor para o código da Chave
        if (strCheck.indexOf(key) == -1)
            return false; // Chave inválida
        len = objTextBox.value.length;
        for (i = 0; i < len; i++)
            if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal))
                break;
        aux = '';
        for (; i < len; i++)
            if (strCheck.indexOf(objTextBox.value.charAt(i)) != -1)
                aux += objTextBox.value.charAt(i);
        aux += key;
        len = aux.length;
        if (len == 0)
            objTextBox.value = '';
        if (len == 1)
            objTextBox.value = '0' + SeparadorDecimal + '0' + aux;
        if (len == 2)
            objTextBox.value = '0' + SeparadorDecimal + aux;
        if (len > 2) {
            aux2 = '';
            for (j = 0, i = len - 3; i >= 0; i--) {
                if (j == 3) {
                    aux2 += SeparadorMilesimo;
                    j = 0;
                }
                aux2 += aux.charAt(i);
                j++;
            }
            objTextBox.value = '';
            len2 = aux2.length;
            for (i = len2 - 1; i >= 0; i--)
                objTextBox.value += aux2.charAt(i);
            objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
        }
        return false;
    }
</script>
<!-- Content Header (Page header) - Início da página -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Produtos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?p=pagina-inicial">Home</a></li>
                    <li class="breadcrumb-item"><a href="?p=produto/consultar">Produtos</a></li>
                    <li class="breadcrumb-item active"><?php
                        if ($ok == 'e') {
                            echo 'Editar';
                        } else if ($ok == 's') {
                            echo 'Adicionar';
                        }
                        ?> produto</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?php
                    if ($ok == 'e') {
                        echo 'Editar';
                    } else if ($ok == 's') {
                        echo 'Adicionar';
                    }
                    ?> Produto</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nome">Nome do produto</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Escreva o nome do produto" value="<?php echo $_nome; ?>">
                    </div>
                    <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control" name="tipo">
                            <option value="oculosGrau" <?php echo $oculosGrau; ?>>Óculos de grau</option>
                            <option value="oculosSol" <?php echo $oculosSol; ?>>Óculos de sol sem grau</option>
                            <option value="oculosSolGrau" <?php echo $oculosSolGrau; ?>>Óculos de sol com grau</option>
                            <option value="lenteGrau" <?php echo $lenteGrau; ?>>Lente com grau</option>
                            <option value="lente" <?php echo $lente; ?>>Lente sem grau</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                            <label>Data de validade da lente (caso óculos, deixe nulo)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" class="form-control" value="<?php echo $_idade ?>" name="idade" maxlength="10">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cor">Cor do produto (caso óculos, da armação, caso lente, da lente de contato)</label>
                        <input type="text" class="form-control" id="cor" name="cor" placeholder="Escreva o nome da cor do produto" value="<?php echo $_cor; ?>">
                    </div>
                    <div class="form-group">
                        <label for="modelo">Modelo do produto</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Escreva o modelo do produto" value="<?php echo $_modelo; ?>">
                    </div>
                    <div class="form-group">
                        <label for="material">Material do produto</label>
                        <input type="text" class="form-control" id="material" name="material" placeholder="Escreva o material do produto" value="<?php echo $_material; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tamanho">Tamanho do produto</label>
                        <input type="text" class="form-control" id="tamanho" name="tamanho" placeholder="Escreva o tamanho do produto" value="<?php echo $_tam; ?>">
                    </div>
                    <div class="form-group">
                        <label for="marca">Marca do produto</label>
                        <input type="text" class="form-control" id="marca" name="marca" placeholder="Escreva a marca do produto" value="<?php echo $_marca; ?>">
                    </div>
                    <div class="form-group">
                        <label for="defeito">Defeito refrativo do produto</label>
                        <input type="text" class="form-control" id="defeito" name="defeito" placeholder="Escreva o defeito refrativo que o produto corrige" value="<?php echo $_defeito; ?>">
                    </div>
                    <div class="form-group">
                        <label for="defeito">Disponibilidade do produto</label>
                        <select class="form-control" name="disponivel">
                            <option value="sim" <?php echo $sim; ?>>Sim</option>
                            <option value="nao" <?php echo $nao; ?>>Não</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sexo</label>
                        <select class="form-control" name="sexo">
                            <option value="todos" <?php echo $todos; ?>>Todos</option>
                            <option value="mas" <?php echo $m; ?>>Masculino</option>
                            <option value="fem" <?php echo $f; ?>>Feminino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Faixa etária</label>
                        <select class="form-control" name="idade">
                            <option value="adulto" <?php echo $adulto; ?>>Adulto</option>
                            <option value="infantil" <?php echo $infantil; ?>>Infantil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="preco">Preço unitário do produto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" id="preco" name="preco" onkeypress="return(MascaraMoeda(preco, '.', ',', event))" class="form-control" value="<?php echo $_preco ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição do produto</label>
                        <textarea name="descricao" id="descricao" type="text" rows="3" class="form-control"><?php echo $_desc; ?></textarea>
                    </div>    

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btnSalvar" name="btnSalvar" value="add">Salvar</button>
                    <a href="?p=produto/consultar" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</section>
<?php
if (filter_input(INPUT_POST, 'btnSalvar')) {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
    if ($tipo == "lente" || $tipo == "lenteGrau") {
        $conversao = filter_input(INPUT_POST, 'validade', FILTER_SANITIZE_STRING);
        $ano = substr($conversao, 6);
        $mes = substr($conversao, 3, -5);
        $dia = substr($conversao, 0, -8);
        $validade = $ano . "-" . $mes . "-" . $dia;
    } else {
        $validade = "0000-00-00";
    }
    $cor = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING);
    $modelo = filter_input(INPUT_POST, 'modelo', FILTER_SANITIZE_STRING);
    $material = filter_input(INPUT_POST, 'material', FILTER_SANITIZE_STRING);
    $defeito = filter_input(INPUT_POST, 'defeito', FILTER_SANITIZE_STRING);
    $casasDepoisVirgula = substr(filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT), -2);
    $casasAntesVirgula = substr(filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT), 0, -2);
    $preco = $casasAntesVirgula . "." . $casasDepoisVirgula;
    $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_STRING);
    $disponivel = filter_input(INPUT_POST, 'disponivel', FILTER_SANITIZE_STRING);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
    $tamanho = filter_input(INPUT_POST, 'tamanho', FILTER_SANITIZE_STRING);
    $marca = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    if ($ok == 's') {
        $pro->setNome_produto($nome);
        $pro->setValidade_lente($validade);
        $pro->setCor($cor);
        $pro->setModelo($modelo);
        $pro->setMaterial($material);
        $pro->setDefeito_refrativo($defeito);
        $pro->setPreco_produto($preco);
        $pro->setFaixa_etaria($idade);
        $pro->setDisponibilidade($disponivel);
        $pro->setSexo($sexo);
        $pro->setTamanho_oculos($tamanho);
        $pro->setTipo($tipo);
        $pro->setMarca_produto($marca);
        $pro->setDescricao($descricao);
        echo '<div class="container-fluid">'
        . '<div class="alert alert-success alert-dismissible">'
        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
        . '<h5><i class="icon fa fa-check"></i> OK!</h5>'
        . $pro->inserirDados()
        . '</div>'
        . '</div>';
        echo '<meta http-equiv="refresh" content="3; url=?p=produto/consultar"';
    } else if ($ok == "e") {
        $pro->setNome_produto($nome);
        $pro->setValidade_lente($validade);
        $pro->setCor($cor);
        $pro->setModelo($modelo);
        $pro->setMaterial($material);
        $pro->setDefeito_refrativo($defeito);
        $pro->setPreco_produto($preco);
        $pro->setFaixa_etaria($idade);
        $pro->setDisponibilidade($disponivel);
        $pro->setSexo($sexo);
        $pro->setTamanho_oculos($tamanho);
        $pro->setTipo($tipo);
        $pro->setMarca_produto($marca);
        $pro->setDescricao($descricao);
        $pro->setCod_produto(filter_input(INPUT_GET, 'id'));
        echo '<div class="container-fluid">'
        . '<div class="alert alert-success alert-dismissible">'
        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
        . '<h5><i class="icon fa fa-check"></i> OK!</h5>'
        . $pro->editarDados()
        . '</div>'
        . '</div>';
        echo '<meta http-equiv="refresh" content="1; url=?p=produto/consultar"';
    }
}
    