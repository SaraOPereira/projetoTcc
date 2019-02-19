<?php
require_once 'Conectar.php';
require_once 'Controles.php';

class Produto {
    private $cod_produto, $validade_lente, $cor, $modelo, $material, $defeito_refrativo, $preco_produto, $faixa_etaria, $disponibilidade, $sexo,
            $tamanho_oculos, $tipo, $marca_produto, $nome_produto, $descricao, $imagem, $tmp_imagem, $cod_imagem;
    private $con, $ct;

    function getCod_produto() {
        return $this->cod_produto;
    }

    function getValidade_lente() {
        return $this->validade_lente;
    }

    function getCor() {
        return $this->cor;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getMaterial() {
        return $this->material;
    }

    function getDefeito_refrativo() {
        return $this->defeito_refrativo;
    }

    function getPreco_produto() {
        return $this->preco_produto;
    }

    function getFaixa_etaria() {
        return $this->faixa_etaria;
    }

    function getDisponibilidade() {
        return $this->disponibilidade;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getTamanho_oculos() {
        return $this->tamanho_oculos;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getNome_produto() {
        return $this->nome_produto;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getTmp_imagem() {
        return $this->tmp_imagem;
    }

    function setCod_produto($cod_produto) {
        $this->cod_produto = $cod_produto;
    }

    function setValidade_lente($validade_lente) {
        $this->validade_lente = $validade_lente;
    }

    function setCor($cor) {
        $this->cor = $cor;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setMaterial($material) {
        $this->material = $material;
    }

    function setDefeito_refrativo($defeito_refrativo) {
        $this->defeito_refrativo = $defeito_refrativo;
    }

    function setPreco_produto($preco_produto) {
        $this->preco_produto = $preco_produto;
    }

    function setFaixa_etaria($faixa_etaria) {
        $this->faixa_etaria = $faixa_etaria;
    }

    function setDisponibilidade($disponibilidade) {
        $this->disponibilidade = $disponibilidade;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setTamanho_oculos($tamanho_oculos) {
        $this->tamanho_oculos = $tamanho_oculos;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setNome_produto($nome_produto) {
        $this->nome_produto = $nome_produto;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setTmp_imagem($tmp_imagem) {
        $this->tmp_imagem = $tmp_imagem;
    }

    function getMarca_produto() {
        return $this->marca_produto;
    }

    function setMarca_produto($marca_produto) {
        $this->marca_produto = $marca_produto;
    }
    
    function getCod_imagem() {
        return $this->cod_imagem;
    }

    function setCod_imagem($cod_imagem) {
        $this->cod_imagem = $cod_imagem;
    }

    function inserirDados() {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO `produto`(`cod_produto`, `validade_lentecont`, `cor`, `modelo`, `material`, `defeito_refrativo`"
                    . ", `preco_produto`, `faixa_etaria`, `disponibilidade`, `sexo`, `tamanho_oculos`, `tipo`, `marca_produto`,"
                    . " `nome_produto`, `descricao`) VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getValidade_lente(), PDO::PARAM_STR);
            $ligacao->bindValue(2, $this->getCor(), PDO::PARAM_STR);
            $ligacao->bindValue(3, $this->getModelo(), PDO::PARAM_STR);
            $ligacao->bindValue(4, $this->getMaterial(), PDO::PARAM_STR);
            $ligacao->bindValue(5, $this->getDefeito_refrativo(), PDO::PARAM_STR);
            $ligacao->bindValue(6, $this->getPreco_produto(), PDO::PARAM_STR);
            $ligacao->bindValue(7, $this->getFaixa_etaria(), PDO::PARAM_STR);
            $ligacao->bindValue(8, $this->getDisponibilidade(), PDO::PARAM_STR);
            $ligacao->bindValue(9, $this->getSexo(), PDO::PARAM_STR);
            $ligacao->bindValue(10, $this->getTamanho_oculos(), PDO::PARAM_STR);
            $ligacao->bindValue(11, $this->getTipo(), PDO::PARAM_STR);
            $ligacao->bindValue(12, $this->getMarca_produto(), PDO::PARAM_STR);
            $ligacao->bindValue(13, $this->getNome_produto(), PDO::PARAM_STR);
            $ligacao->bindValue(14, $this->getDescricao(), PDO::PARAM_STR);
            if ($ligacao->execute() == 1) {
                $this->ct = new Controles();
                return "Produto cadastrado com sucesso.  ";
            } else {
                return "Erro ao cadastrar os dados do Produto (" . $ligacao->errorCode() . ")";
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    function inserirImagem() {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO `produto_img`(`cod_produto`, `cod_imagem`, `imagem`) VALUES (?,?,?)";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getCod_produto(), PDO::PARAM_INT);
            $ligacao->bindValue(2, $this->getCod_imagem(), PDO::PARAM_INT);
            $ligacao->bindValue(3, $this->getImagem(), PDO::PARAM_STR);
            if ($ligacao->execute() == 1) {
                $this->ct = new Controles();
                return "Imagem do produto cadastrado com sucesso."
                        . " "
                        . $this->ct->enviarArquivo($this->getTmp_imagem(), "../imagem/produto/" . $this->getImagem());
            } else {
                return "Erro ao cadastrar a imagem do Produto (" . $ligacao->errorCode() . ").";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function editarDados() {
        try {
            $this->con = new Conectar();
            $sql = "UPDATE `produto` SET `validade_lentecont`=?,`cor`=?,`modelo`=?,`material`=?,`defeito_refrativo`=?,`preco_produto`=?,"
                    . "`faixa_etaria`=?,`disponibilidade`=?,`sexo`=?,`tamanho_oculos`=?,`tipo`=?,`marca_produto`=?,`nome_produto`=?,`descricao`=?"
                    . " WHERE cod_produto = ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getValidade_lente(), PDO::PARAM_STR);
            $ligacao->bindValue(2, $this->getCor(), PDO::PARAM_STR);
            $ligacao->bindValue(3, $this->getModelo(), PDO::PARAM_STR);
            $ligacao->bindValue(4, $this->getMaterial(), PDO::PARAM_STR);
            $ligacao->bindValue(5, $this->getDefeito_refrativo(), PDO::PARAM_STR);
            $ligacao->bindValue(6, $this->getPreco_produto(), PDO::PARAM_STR);
            $ligacao->bindValue(7, $this->getFaixa_etaria(), PDO::PARAM_STR);
            $ligacao->bindValue(8, $this->getDisponibilidade(), PDO::PARAM_STR);
            $ligacao->bindValue(9, $this->getSexo(), PDO::PARAM_STR);
            $ligacao->bindValue(10, $this->getTamanho_oculos(), PDO::PARAM_STR);
            $ligacao->bindValue(11, $this->getTipo(), PDO::PARAM_STR);
            $ligacao->bindValue(12, $this->getMarca_produto(), PDO::PARAM_STR);
            $ligacao->bindValue(13, $this->getNome_produto(), PDO::PARAM_STR);
            $ligacao->bindValue(14, $this->getDescricao(), PDO::PARAM_STR);
            $ligacao->bindValue(15, $this->getCod_produto(), PDO::PARAM_INT);
            if ($ligacao->execute() == 1) {
                return "Produto editado com sucesso.";
            } else {
                return "Erro ao editar Produto (" . $ligacao->errorCode() . ").";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function editarImagem() {
        try {
            $this->con = new Conectar();
            $this->ct = new Controles();
            $mostrar = $this->consultarImagem($this->getCod_produto(), $this->getCod_imagem());
            foreach ($mostrar as $capturar) {
                $img = $capturar['imagem'];
            }
            $sql = "UPDATE `produto_img` SET `imagem`=? WHERE `cod_produto`=? AND `cod_imagem`=?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(3, $this->getCod_imagem(), PDO::PARAM_INT);
            $ligacao->bindValue(2, $this->getCod_produto(), PDO::PARAM_INT);
            $ligacao->bindValue(1, $this->getImagem(), PDO::PARAM_STR);
            if ($ligacao->execute() == 1) {
                return "Imagem atual excluída. <br>"
                        . $this->ct->excluirArquivo("../imagem/produto/" . $img) . "<br>"
                        . "Produto editado com sucesso." . "<br>"
                        . $this->ct->enviarArquivo($this->getTmp_imagem(), "../imagem/produto/" . $this->getImagem());
            } else {
                return "Erro ao editar imagem de Produto.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function excluir() {
        try {
            $this->con = new Conectar();
            $this->ct = new Controles();
            $mostrar = $this->consultar($this->getCod_produto());
            foreach ($mostrar as $capturar) {
                $capturar['imagem'];
            }
            $sql = "Delete from produto where cod_produto = ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getCod_produto(), PDO::PARAM_INT);
            if ($ligacao->execute() == 1) {
                return "Produto excluído com sucesso." .
                        $this->ct->excluirArquivo("../imagem/produto/" . $capturar['imagem']);
            } else {
                return "Erro ao excluir Produto.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    function excluirImagem() {
        try {
            $this->con = new Conectar();
            $this->ct = new Controles();
            $mostrar = $this->consultarImagem($this->getCod_produto(), $this->cod_imagem);
            foreach ($mostrar as $capturar) {
                $capturar['imagem'];
            }
            $sql = "Delete from produto_img where cod_produto = ? AND cod_imagem = ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getCod_produto(), PDO::PARAM_INT);
            $ligacao->bindValue(2, $this->getCod_imagem(), PDO::PARAM_INT);
            if ($ligacao->execute() == 1) {
                return "Imagem do produto excluído com sucesso." .
                        $this->ct->excluirArquivo("../imagem/produto/" . $capturar['imagem']);
            } else {
                return "Erro ao excluir imagem do produto.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consultar($param) {
        try {
            $this->con = new Conectar();
            if ($param == "" || $param == NULL) {
                $sql = "SELECT * FROM produto";
                $ligacao = $this->con->prepare($sql);
            } else if ($param) {
                $sql = "SELECT * FROM `produto` WHERE `cod_produto` = " . $param;
                $ligacao = $this->con->prepare($sql);
            }
            if ($ligacao->execute() == 1) {
                return $ligacao->fetchAll();
            } else { return "Erro ao consultar Produto."; }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consultarImagem($idProd, $idImg) {
        try {
            $this->con = new Conectar();
            if ($idImg == "" && $idProd == "") {
                $sql = "SELECT * FROM produto_img";
                $ligacao = $this->con->prepare($sql);
            } else if ($idProd && $idImg == "") {
                $sql = "Select * From produto_img Where cod_produto = ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, $idProd, PDO::PARAM_INT);
            }else if ($idProd == "" && $idImg != "") {
                $sql = "Select * From produto_img Where cod_imagem = ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, $idImg, PDO::PARAM_INT);
            }else if ($idProd != "" && $idImg != "") {
                $sql = "Select * From produto_img Where cod_imagem = ? AND cod_produto = ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, $idImg, PDO::PARAM_INT);
                $ligacao->bindValue(2, $idProd, PDO::PARAM_INT);
            }
            if ($ligacao->execute() == 1) {
                return $ligacao->fetchAll();
            } else {
                return "Erro ao consultar a imagem do produto (" . $ligacao->errorCode() . ").";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    function consultarFiltro($filtro, $valor){
        try {
            $this->con = new Conectar();
            if ($valor == NULL || $valor == "") {
                $sql = "SELECT DISTINCT ". $filtro ." FROM `produto`";
                $ligacao = $this->con->prepare($sql);
            }else if ($valor != NULL || $valor != "") {
                $sql = "SELECT * FROM `produto` WHERE ? like ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, $filtro, PDO::PARAM_STR);
                $ligacao->bindValue(2, "%".$valor."%", PDO::PARAM_STR);
            }
            if ($ligacao->execute() == 1) {
                return $ligacao->fetchAll();
            } else { return "Erro ao consultar Produto."; }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
