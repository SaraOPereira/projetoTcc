<?php
require_once 'Conectar.php';
class Cliente {
    private $cpf_cliente, $telefone, $data_nasc, $nome_cliente, $email_cliente, $defeito, $cep;
    private $con;
    
    function getCpf_cliente() {
        return $this->cpf_cliente;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getData_nasc() {
        return $this->data_nasc;
    }

    function getNome_cliente() {
        return $this->nome_cliente;
    }

    function getEmail_cliente() {
        return $this->email_cliente;
    }

    function getDefeito() {
        return $this->defeito;
    }

    function getCep() {
        return $this->cep;
    }

    function setCpf_cliente($cpf_cliente) {
        $this->cpf_cliente = $cpf_cliente;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setData_nasc($data_nasc) {
        $this->data_nasc = $data_nasc;
    }

    function setNome_cliente($nome_cliente) {
        $this->nome_cliente = $nome_cliente;
    }

    function setEmail_cliente($email_cliente) {
        $this->email_cliente = $email_cliente;
    }

    function setDefeito($defeito) {
        $this->defeito = $defeito;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

function inserir() {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO `cliente`(`cpf`, `nome`, `email`, `telefone`, `data_nasc`, `defeito_refrativo`, `cep`) "
                    . "VALUES (?,?,?,?,?,?,?)";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getCpf_cliente(), PDO::PARAM_STR);
            $ligacao->bindValue(2, $this->getNome_cliente(), PDO::PARAM_STR);
            $ligacao->bindValue(3, $this->getEmail_cliente(), PDO::PARAM_STR);
            $ligacao->bindValue(4, $this->getTelefone(), PDO::PARAM_STR);
            $ligacao->bindValue(5, $this->getData_nasc(), PDO::PARAM_STR);
            $ligacao->bindValue(6, $this->getDefeito(), PDO::PARAM_STR);
            $ligacao->bindValue(7, $this->getCep(), PDO::PARAM_STR);
            if ($ligacao->execute() == 1) {
                return "Cliente cadastrado com sucesso.";
            } else{ return "Erro ao cadastrar cliente (" . $ligacao->errorCode() . ")"; }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    function editarDados() {
        try {
            $this->con = new Conectar();
            $sql = "UPDATE `cliente` SET `nome`=?,`email`=?,`telefone`=?,`data_nasc`=?,`defeito_refrativo`=?,`cep`=? WHERE `cpf`=?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getNome_cliente(), PDO::PARAM_STR);
            $ligacao->bindValue(2, $this->getEmail_cliente(), PDO::PARAM_STR);
            $ligacao->bindValue(3, $this->getTelefone(), PDO::PARAM_STR);
            $ligacao->bindValue(4, $this->getData_nasc(), PDO::PARAM_STR);            
            $ligacao->bindValue(5, $this->getDefeito(), PDO::PARAM_STR);            
            $ligacao->bindValue(6, $this->getCep(), PDO::PARAM_STR);            
            $ligacao->bindValue(7, $this->getCpf_cliente(), PDO::PARAM_STR);            
            if ($ligacao->execute() == 1) {
                return "Cliente editado com sucesso.";
            } else {
                return "Erro ao editar Cliente.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    function excluir() {
        try {
            $this->con = new Conectar();
            $sql = "DELETE FROM `cliente` WHERE `cpf` = ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getCpf_cliente(), PDO::PARAM_STR);
            if ($ligacao->execute() == 1) {
                return "Cliente excluído com sucesso.";
            } else {
                return "Erro ao excluir Cliente.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
    function consultar($cpf) {
        try {
            $this->con = new Conectar();
            if ($cpf == "") {
                $sql = "SELECT * FROM cliente";
                $ligacao = $this->con->prepare($sql);
            }else if($cpf != "" || $cpf != NULL){
                $sql = "Select * From cliente Where cpf = ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, $cpf, PDO::PARAM_STR);
            }
            if ($ligacao->execute() == 1) {
                return $ligacao->fetchAll();
            } else {
                return "Erro ao consultar Cliente.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
