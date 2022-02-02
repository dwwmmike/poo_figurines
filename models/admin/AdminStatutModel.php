<?php

class AdminStatutModel extends Driver{

    public function getStatut(){

        $sql = "SELECT * FROM statut ORDER BY id_stat DESC";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);

        $tabStatut = [];

        foreach($rows as $row){
            $statut = new Statut();
            $statut->setId_stat($row->id_stat);
            $statut->setNom_stat($row->nom_stat);
            array_push($tabStatut, $statut);
        }
        return $tabStatut;
    }

    public function gradeItem($id){

        $sql = "SELECT * FROM statut WHERE id_stat = :id";
        $result = $this -> getRequest($sql, ["id" => $id]);
        if($result -> rowCount() > 0){

            $row = $result->fetch(PDO::FETCH_OBJ);

            $statut = new Statut();
            $statut -> setId_stat($row->id_stat);
            $statut -> setNom_stat($row->nom_stat);
            return $statut;
        }
    }
}
?>