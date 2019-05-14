<?php
require_once "../Model/Viagem.php";

class ViagemDAO{

    function cadastrar(Condutor $condutor){
        /*$comando = "INSERT INTO tbcondutor (nome,cnh,validadeCNH) values (:nome, :cnh, :validadeCNH)";
        $stm = $this->pdo->prepare($comando);

        $stm->bindValue(':nome',$condutor->getNome());
        $stm->bindValue(':cnh',$condutor->getCnh());
        $stm->bindValue(':validadeCNH',$condutor->getValidadeCNH());

        $stm->execute();
        header('Location:../View/condutorView.php?success=true');*/
    }

    function excluir($id){
        /*$comando = "DELETE FROM tbcondutor WHERE id = :id";
        $stm = $this->pdo->prepare($comando);

        $stm->bindParam(':id',$id);
        $stm->execute();
        header('Location:../View/condutorView.php?success=true');*/
    }

    //Retorna todos os condutores em uma lista de objetos da classe modelo Condutor
    public function listar(){
        $comando = "SELECT * FROM tbViagem";
        $stm = $this->pdo->prepare($comando);
        $stm->execute();
        $result =array();
        while($row = $stm->fetch(PDO::FETCH_ASSOC)){
            $obj = new Viagem($row['nome'],$row['cnh'],$row['validadeCNH']);
            $result[] = $obj;
        }
        return $result;
    }

    function atualizar(Condutor $condutor){
/*
        $comando = "UPDATE tbcondutor SET nome=:nome,cnh=:cnh,validadeCNH=:validadeCNH WHERE id = :id";
        $stm = $this->pdo->prepare($comando);

        $stm->bindValue(':nome',$condutor->getNome());
        $stm->bindValue(':cnh',$condutor->getCnh());
        $stm->bindValue(':validadeCNH',$condutor->getValidadeCNH());
        $stm->bindValue(':id',$condutor->getId());

        $stm->execute();
        header('Location:../View/condutorView.php?success=true');*/
    }

    public function listarPorId($id){
        /*$comando = "SELECT * from tbcondutor WHERE id = :id";
        $stm = $this->pdo->prepare($comando);

        $stm->bindValue(':id',$id);

        $stm->execute();
        $resul = $stm->fetch(PDO::FETCH_ASSOC);
        $obj = new Condutor($resul['nome'],$resul['cnh'],$resul['validadeCNH'],$resul['id']);

        return $obj;*/
    }
}