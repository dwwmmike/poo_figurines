<?php

class PublicModel extends Driver{

    public function findFigurinesByCat(Figurine $figurine){

        $sql = "SELECT * FROM figurine f
        INNER JOIN categorie c
        ON f.id_cat = c.id_cat
         WHERE f.id_cat=:id";
        $result = $this->getRequest($sql, ["id"=>$figurine->getCategorie()->getId_cat()]);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $figurines = [];
        foreach($rows as $row){

            $newFigurine = new Figurine();

            $newFigurine->setId_fig($row->id_fig);
            $newFigurine->setNom($row->nom);
            $newFigurine->setPrix($row->prix);
            $newFigurine->setAnnee($row->annee);
            $newFigurine->setQuantite($row->quantite);
            $newFigurine->setImage($row->image);
            $newFigurine->setDescription($row->description);
            $newFigurine->getCategorie()->setId_cat($row->id_cat);
            $newFigurine->getCategorie()->setNom_cat($row->nom_cat);

            array_push($figurines, $newFigurine);

        }
        return $figurines;
    }
    public function updateStock(Figurine $f){
        $sql = "UPDATE figurine SET quantite = :quantite WHERE id_fig = :id";
        $result = $this->getRequest($sql, ['quantite'=>$f->getQuantite(), 'id'=>$f->getId_fig()]);
        return $result->rowCount();
    }
}
?>