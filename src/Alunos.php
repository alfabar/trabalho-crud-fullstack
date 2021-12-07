<?php
require_once "Banco.php";

class Aluno {
    private int $id;
    private string $nome;
    private float $p_nota;
    private float $s_nota;
    private string $media;
    private string $situacao;

    
    private string $termo;

    private PDO $conexao;

    public function __construct(){
        $this->conexao = Banco::conecta();
    }

    public function lerAlunos():array {
        $sql = "SELECT * FROM alunos ORDER BY nome";
                try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die( "Erro: " .$erro->getMessage());
        }
        return $resultado;
    } // fim lerProdutos


    public function inserirAluno(){
        $sql = "INSERT INTO alunos(nome, p_nota, s_nota, media, situacao) VALUES(:nome, :p_nota, :s_nota, :media, :situacao)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindParam(":p_nota", $this->p_nota, PDO::PARAM_STR); 
            $consulta->bindParam(":s_nota", $this->s_nota, PDO::PARAM_INT);
            $consulta->bindParam(":media", $this->media, PDO::PARAM_STR);
            $consulta->bindParam(":situacao", $this->situacao, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die( "Erro: " .$erro->getMessage());
        }
    } // fim inserirProduto


    public function lerUmAluno(){
        $sql = "SELECT * FROM alunos WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die( "Erro: " .$erro->getMessage());
        }
        return $resultado;        
    } // fim lerUmProduto


    public function atualizarAluno(){
        $sql = "UPDATE alunos SET nome = :nome, p_nota = :p_nota,
        s_nota = :s_nota, media = :media,
        situacao = :situacao WHERE id = :id";
        
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $consulta->bindParam(':p_nota', $this->p_nota, PDO::PARAM_STR);
            $consulta->bindParam(':s_nota', $this->s_nota, PDO::PARAM_INT);
            $consulta->bindParam(':media', $this->media, PDO::PARAM_STR);
            $consulta->bindParam(":situacao", $this->situacao, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die( "Erro: " .$erro->getMessage());
        }
    } // fim atualizarProduto


    public function excluirAluno(){
        $sql = "DELETE FROM alunos WHERE id = :id";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die( "Erro: " .$erro->getMessage());
        }
    } // fim excluirProduto


    public function busca(){
        $sql = "SELECT nome, p_nota, s_nota, media, situacao FROM produtos WHERE nome LIKE :termo 
                OR media LIKE :termo ORDER BY nome";
        
        try {
            $consulta = $this->conexao->prepare($sql);

            // Juntando o termo com o operador coringa % para o LIKE funcionar
            $termoComOperador = "%".$this->termo."%";

            $consulta->bindParam(':termo', $termoComOperador, PDO::PARAM_STR);

            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $erro){
            die( "Erro: " .$erro->getMessage());
        }
        
        return $resultado;
    }

    



    /* Utilitários */
    public function formataNota(float $media):string {
        return number_format( $media, 2, ",", "." );
    }



    /* Getters */
    public function getId():int { return $this->id; }
    public function getNome():string { return $this->nome; }
    public function getNota():float { return $this->p_nota; }
    public function getNota1():float { return $this->s_nota; }

    public function getMedia():string { return $this->media; }
    public function getSituacao():string { return $this->situacao; }

    public function getTermo():string { return $this->termo; }

    /* Setters */
    public function setTermo(string $termo) {
        $this->termo = filter_var($termo, FILTER_SANITIZE_STRING);
    }

    public function setId(int $id) {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }
    public function setNome(string $nome) {
        $this->nome = filter_var($nome, FILTER_SANITIZE_STRING);
    }
    public function setNota(float $p_nota) {
        $this->p_nota = filter_var(
            $p_nota, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION
        );
    }
    public function setNota1(float $s_nota) {
        $this->s_nota = filter_var(
            $s_nota, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION
        );
    }
  
    public function setMedia(string $media) {
        $this->media = filter_var($media, FILTER_SANITIZE_STRING);
    }
    public function setSituacao(string $situacao) {
        $this->situacao = filter_var($situacao, FILTER_SANITIZE_STRING);
    }


}