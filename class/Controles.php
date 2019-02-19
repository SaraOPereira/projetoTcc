<?php
class Controles {
    
    //envio de arquivos
    function enviarArquivo($temporario, $endereco) {
        //se o arquivo não for enviado        
        if (!move_uploaded_file($temporario, $endereco)) {
            return 'Erro no envio do arquivo.';
        } else {//conseguiu enviar
            return 'Arquivo enviado com sucesso.';
        }
    }
    
    //exclusão de arquivo
    function excluirArquivo($arquivo){
        if(unlink($arquivo)){
            return 'Arquivo excluido com sucesso.';
        }else{
            return 'Erro ao excluir arquivo.';
        }
    }
}
