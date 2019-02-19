<?php
/*
ADMIN
- id;
- nome_admin;
- senha;
- email;
- img (sha1);

. Cadastro;
. Exclusao;
. Atualização;
 */
include_once 'Conectar.php';
require_once 'Controles.php';
class Admin {
    private $id, $nome_admin, $senha, $email, $imagem, $tmp_imagem;
    private $con, $ct;

    function getId() {
        return $this->id;
    }

    function getNome_admin() {
        return $this->nome_admin;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEmail() {
        return $this->email;
    }

    function getImagem() {
        return $this->imagem;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome_admin($nome_admin) {
        $this->nome_admin = $nome_admin;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    function getTmp_imagem() {
        return $this->tmp_imagem;
    }

    function setTmp_imagem($tmp_imagem) {
        $this->tmp_imagem = $tmp_imagem;
    }

    function inserir() {
        try {
            $this->con = new Conectar();
            $sql = "INSERT INTO `admin`(`id`, `nome_admin`, `senha`, `email`, `imagem`) VALUES (null,?,?,?,?)";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getNome_admin(), PDO::PARAM_STR);
            $ligacao->bindValue(2, $this->getSenha(), PDO::PARAM_STR);
            $ligacao->bindValue(3, $this->getEmail(), PDO::PARAM_STR);
            $ligacao->bindValue(4, $this->getImagem(), PDO::PARAM_STR);
            if ($ligacao->execute() == 1) {
                $this->ct = new Controles();
                return "Administrador cadastrado com sucesso."
                        . " "
                        . $this->ct->enviarArquivo($this->getTmp_imagem(), "../imagem/admin/" . $this->getImagem());
            } else {
                return "Erro ao cadastrar Administrador.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function editarDados() {
    //function editarDados($id) {
        try {
            $this->con = new Conectar();
            $sql = "UPDATE admin SET nome_admin=?,senha=?,email=? WHERE id = ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getNome_admin(), PDO::PARAM_STR);
            $ligacao->bindValue(2, $this->getSenha(), PDO::PARAM_STR);
            $ligacao->bindValue(3, $this->getEmail(), PDO::PARAM_STR);
            $ligacao->bindValue(4, $this->getId(), PDO::PARAM_INT);
            //$ligacao->bindValue(4, $id, PDO::PARAM_INT);
            if ($ligacao->execute() == 1) {
                return "Administrador editado com sucesso.";
            } else {
                return "Erro ao editar Administrador.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function excluir() {
        try {
            $this->con = new Conectar();
            $this->ct = new Controles();
            $mostrar = $this->consultar($this->getId());
            foreach ($mostrar as $capturar) {
                $capturar['imagem'];
            }
            $sql = "Delete from admin where id = ?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(1, $this->getId(), PDO::PARAM_INT);
            if ($ligacao->execute() == 1) {
                return "Administrador excluído com sucesso." .
                        $this->ct->excluirArquivo("../imagem/admin/" . $capturar['imagem']);
            } else {
                return "Erro ao excluir Administrador.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function editarImagem() {
        try {
            $this->con = new Conectar();
            $this->ct = new Controles();
            $mostrar = $this->consultar($this->getId());
            foreach ($mostrar as $capturar) {
                $capturar['imagem'];
            }
            $sql = "Update admin set imagem = ? where id=?";
            $ligacao = $this->con->prepare($sql);
            $ligacao->bindValue(2, $this->getId(), PDO::PARAM_INT);
            $ligacao->bindValue(1, $this->getImagem(), PDO::PARAM_STR);
            if ($ligacao->execute() == 1) {
                return "Imagem atual excluída." .
                        $this->ct->excluirArquivo("../imagem/admin/" . $capturar['imagem'])
                        . "Administrador cadastrado com sucesso."
                        . " "
                        . $this->ct->enviarArquivo($this->getTmp_imagem(), "../imagem/admin/" . $this->getImagem());
            } else {
                return "Erro ao editar imagem de Administrador.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function consultar($id) {
        try {
            $this->con = new Conectar();
            if ($id == "") {
                $sql = "SELECT * FROM admin";
                $ligacao = $this->con->prepare($sql);
            } else if ($id != "" || $id != NULL) {
                $sql = "Select * From admin Where id = ?";
                $ligacao = $this->con->prepare($sql);
                $ligacao->bindValue(1, $id, PDO::PARAM_INT);
            }
            if ($ligacao->execute() == 1) {
                return $ligacao->fetchAll();
            } else {
                return "Erro ao consultar Administrador.";
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
