<?php

require_once '../Services/Autoload.php';

class GastoDao extends CrudDao
{

    function cadastrar(GastoModel $gasto){
        $comando = "INSERT INTO tbGasto (tipo,valor) values (:tipo, :valor)";
        $stm = $this->pdo->prepare($comando);

        $stm->bindValue(':tipo',$gasto->getTipo());
        $stm->bindValue(':cnh',$gasto->getValor());

        $stm->execute();
    }

    function cadastrarGastos($gastos,$idViagem){
        $comando = "insert into tbGasto (tipo,valor,idViagem) values ";
        $parametros = array();
        foreach ($gastos as $gasto){
            $comando .= '(?,?,?),';
            $parametros[] = $gasto->getTipo();
            $parametros[] = $gasto->getValor();
            $parametros[] = $idViagem;
        }

        $comando = trim($comando,',');
        $stm = $this->pdo->prepare($comando);
        $stm->execute($parametros);
    }

    function excluir($id){
        $comando = "DELETE FROM tbGasto WHERE id = :id";
        $stm = $this->pdo->prepare($comando);

        $stm->bindParam(':id',$id);
        $stm->execute();

    }


    public function listarPorIdViagem($idViagem){
        $comando = "SELECT * FROM tbGasto WHERE idViagem= :id";
        $stm = $this->pdo->prepare($comando);
        $stm->bindParam(':id',$idViagem);
        $stm->execute();
        $result =array();
        while($row = $stm->fetch(PDO::FETCH_ASSOC)){
            $obj = new GastoModel($row['valor'],$row['tipo'],$row['id']);
            $result[] = $obj;
        }
        return $result;
    }

    public function listar(){
        $comando = "SELECT * FROM tbGasto";
        $stm = $this->pdo->prepare($comando);
        $stm->bindParam(':id',$idViagem);
        $stm->execute();
        $result =array();
        while($row = $stm->fetch(PDO::FETCH_ASSOC)){
            $obj = new GastoModel($row['valor'],$row['tipo'],$row['id']);
            $result[] = $obj;
        }
        return $result;
    }

    function atualizar(GastoModel $gasto){
        $comando = "UPDATE tbGasto SET tipo=:tipo, valor=:valor WHERE id = :id";
        $stm = $this->pdo->prepare($comando);

        $stm->bindValue(':tipo',$gasto->getTipo());
        $stm->bindValue(':valor',$gasto->getValor());
        $stm->bindValue(':id',$gasto->getId());

        $stm->execute();

    }

}