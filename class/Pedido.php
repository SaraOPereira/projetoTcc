<?php

require_once 'Conectar.php';
require_once 'Controles.php';

class Pedido {

    private $cod_pedido, $data_pedido, $data_visita, $cpf_cliente, $cod_produto, $qtde;
    private $ct, $con;

    function getCod_pedido() {
        return $this->cod_pedido;
    }

    function getData_pedido() {
        return $this->data_pedido;
    }

    function getData_visita() {
        return $this->data_visita;
    }

    function getCpf_cliente() {
        return $this->cpf_cliente;
    }

    function getCod_produto() {
        return $this->cod_produto;
    }

    function getQtde() {
        return $this->qtde;
    }

    function setCod_pedido($cod_pedido) {
        $this->cod_pedido = $cod_pedido;
    }

    function setData_pedido($data_pedido) {
        $this->data_pedido = $data_pedido;
    }

    function setData_visita($data_visita) {
        $this->data_visita = $data_visita;
    }

    function setCpf_cliente($cpf_cliente) {
        $this->cpf_cliente = $cpf_cliente;
    }

    function setCod_produto($cod_produto) {
        $this->cod_produto = $cod_produto;
    }

    function setQtde($qtde) {
        $this->qtde = $qtde;
    }

    function inserir() {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO `pedido`(`cod_pedido`, `data_pedido`, `data_visita`, `cpf_cliente`) VALUES (null,?,?,?)";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getData_pedido(), PDO::PARAM_STR);
            $ligacao->bindValue(2, $this->getData_visita(), PDO::PARAM_STR);
            $ligacao->bindValue(3, $this->getCpf_cliente(), PDO::PARAM_STR);
            if ($ligacao->execute() == 1) {
                return "Pedido cadastrado com sucesso.";
            } else {
                return "Erro ao cadastrar Pedido.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function inserirProduto() {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO `aux_pedido`(`cod_pedido`, `cod_produto`, `qtde`) VALUES (?,?,?)";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getCod_pedido(), PDO::PARAM_INT);
            $ligacao->bindValue(2, $this->getCod_produto(), PDO::PARAM_INT);
            $ligacao->bindValue(3, $this->getQtde(), PDO::PARAM_INT);
            if ($ligacao->execute() == 1) {
                return "Produto cadastrado com sucesso.";
            } else {
                return "Erro ao cadastrar Produto.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function validarCliente($cpf) {
        try {
            $this->con = new Conectar();
            $sql = "SELECT `cpf` FROM `cliente` WHERE `cpf` = ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $cpf, PDO::PARAM_STR);
            if ($ligacao->execute() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function validarProduto($pro) {
        try {
            $this->con = new Conectar();
            $sql = "SELECT `cod_produto` FROM `produto` WHERE `cod_produto` = ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $pro, PDO::PARAM_INT);
            if ($ligacao->execute() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function editarDados() {
        try {
            $this->con = new Conectar();
            $sql = "UPDATE `pedido` SET `data_pedido`= ?,`data_visita`= ?,`cpf_cliente`= ? WHERE `cod_pedido`= ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getData_pedido(), PDO::PARAM_STR);
            $ligacao->bindValue(2, $this->getData_visita(), PDO::PARAM_STR);
            $ligacao->bindValue(3, $this->getCpf_cliente(), PDO::PARAM_STR);
            $ligacao->bindValue(4, $this->getCod_pedido(), PDO::PARAM_INT);
            if ($ligacao->execute() == 1) {
                return "Pedido editado com sucesso.";
            } else {
                return "Erro ao editar pedido (" . $ligacao->errorCode() . ")";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function editarProduto() {
        try {
            $this->con = new Conectar();
            $sql = "UPDATE `aux_pedido` SET `cod_produto`=?,`qtde`=? WHERE `cod_pedido`=?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getCod_produto(), PDO::PARAM_STR);
            $ligacao->bindValue(2, $this->getQtde(), PDO::PARAM_STR);
            $ligacao->bindValue(3, $this->getCod_pedido(), PDO::PARAM_STR);
            if ($ligacao->execute() == 1) {
                return "Produto editado com sucesso.";
            } else {
                return "Erro ao editar produto.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function excluir() {
        try {
            $this->con = new Conectar();
            $sql = "DELETE FROM `pedido` WHERE `cod_pedido` = ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getCod_pedido(), PDO::PARAM_INT);
            if ($ligacao->execute() == 1) {
                return "Pedido excluído com sucesso.";
            } else {
                return "Erro ao excluir Pedido.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function excluirProduto() {
        try {
            $this->con = new Conectar();
            $sql = "DELETE FROM `aux_pedido` WHERE `cod_pedido` = ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getCod_pedido(), PDO::PARAM_INT);
            if ($ligacao->execute() == 1) {
                return "Produto excluído com sucesso.";
            } else {
                return "Erro ao excluir Produto.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consultar($param) {
        try {
            $this->con = new Conectar();
            if ($param == "" || $param == null) {
                $sql = "SELECT * FROM pedido";
                $ligacao = $this->con->prepare($sql);
            } else if ($param != "" || $param != NULL) {
                $sql = "Select * From pedido Where cod_pedido = ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, $param, PDO::PARAM_STR);
            }
            if ($ligacao->execute() == 1) {
                return $ligacao->fetchAll();
            } else {
                return "Erro ao consultar Produto.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consultarProduto($param) {
        try {
            $this->con = new Conectar();
            if ($param == "" || $param == null) {
                $sql = "SELECT * FROM aux_pedido";
                $ligacao = $this->con->prepare($sql);
            } else if ($param != "" || $param != NULL) {
                $sql = "Select * From aux_pedido Where cod_pedido = ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, $param, PDO::PARAM_STR);
            }
            if ($ligacao->execute() == 1) {
                return $ligacao->fetchAll();
            } else {
                return "Erro ao consultar Pedido.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consUltimaInsercao() {
        try {
            $this->con = new Conectar();
            $sql = "SELECT `cod_pedido` FROM `pedido` ORDER BY `cod_pedido` DESC LIMIT 1";
            $ligacao = $this->con->prepare($sql);
            if ($ligacao->execute() == 1) {
                return $ligacao->fetchAll();
            } else {
                return "Erro ao consultar Pedido (" . $ligacao->errorCode() . ").";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}
