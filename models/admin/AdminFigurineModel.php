<?php

class AdminFigurineModel extends Driver{
    public function getFigurines($search = null){
        if(!empty($search)){
            $sql = "SELECT * FROM figurine f
                INNER JOIN categorie c
                ON f.id_cat = c.id_cat
                WHERE nom LIKE :nom OR nom_cat LIKE :nom_cat OR taille LIKE :taille
                ORDER BY id_fig";

                $searchParams = [
                    "nom" => "%$search%",
                    "nom_cat" => "%$search%",
                    "taille" => "%$search%"
                ];

                $result = $this->getRequest($sql, $searchParams);
               
        }else{
            $sql = "SELECT * FROM figurine f
                INNER JOIN categorie c
                ON f.id_cat = c.id_cat
                ORDER BY id_fig";

                $result = $this->getRequest($sql);
        } 
        $figurines = $result->fetchAll(PDO::FETCH_OBJ);
        $tabFig = [];      
        foreach($figurines as $figurine){
            $f = new Figurine();
            $f->setId_fig($figurine->id_fig);
            $f->setNom($figurine->nom);
            $f->setPrix($figurine->prix);
            $f->setImage($figurine->image);
            $f->setQuantite($figurine->quantite);
            $f->setTaille($figurine->taille);
            $f->setAnnee($figurine->annee);
            $f->setDescription($figurine->description);
            $f->getCategorie()->setId_cat($figurine->id_cat);
            $f->getCategorie()->setNom_cat($figurine->nom_cat);
            array_push($tabFig, $f);
        }
        

        if($result->rowCount() > 0){
            return $tabFig;
        }else{
            return "Not found";
        }
    }

    public function insertFigurine(Figurine $figurine){
        $sql = "INSERT INTO figurine(nom, taille, prix, annee, quantite, image, description, id_cat)
                VALUES (:nom, :taille, :prix, :annee, :quantite, :image, :descr, :id_cat)";
       $tabParams = ["nom"=>$figurine->getNom(),
                    "taille"=>$figurine->getTaille(),
                    "prix"=>$figurine->getPrix(),
                    "annee"=>$figurine->getAnnee(),
                    "quantite"=>$figurine->getQuantite(),
                    "image"=>$figurine->getImage(),
                    "descr"=>$figurine->getDescription(),
                    "id_cat"=>$figurine->getCategorie()->getId_cat()];
        $result = $this -> getRequest($sql, $tabParams);
        return $result;
    }

    public function deleteFig($id){
        $sql = "DELETE FROM figurine WHERE id_fig = :id";
        $result = $this -> getRequest($sql, ["id" => $id]);
        $nb = $result -> rowCount();
        return $nb;
    }

    public function figurineItem(Figurine $figParam){

        $sql = "SELECT * FROM figurine WHERE id_fig = :id";
        $result = $this -> getRequest($sql, ["id" => $figParam->getId_fig()]);

        if($result -> rowCount() > 0){
            $FigurineRow = $result->fetch(PDO::FETCH_OBJ);

            $editFigurine = new Figurine();
            $editFigurine -> setId_fig($FigurineRow->id_fig);
            $editFigurine -> setNom($FigurineRow->nom);
            $editFigurine -> setTaille($FigurineRow->taille);
            $editFigurine -> setPrix($FigurineRow->prix);
            $editFigurine -> setQuantite($FigurineRow->quantite);
            $editFigurine -> setAnnee($FigurineRow->annee);
            $editFigurine -> setImage($FigurineRow->image);
            $editFigurine -> setDescription($FigurineRow->description);
            $editFigurine -> getCategorie()->setId_cat($FigurineRow->id_cat);
            return $editFigurine;
        }
    }

    public function updateFigurine(Figurine $updateFig){
        if($updateFig -> getImage() === ""){
            $sql = "UPDATE figurine
                SET nom = :nom, taille = :taille, prix = :prix, annee = :annee, quantite = :quantite, description = :description, id_cat = :id_cat
                WHERE id_fig = :id_fig";

            $tabParams = ["nom"=>$updateFig->getNom(),
                            "taille"=>$updateFig->getTaille(),
                            "prix"=>$updateFig->getPrix(),
                            "annee"=>$updateFig->getAnnee(),
                            "quantite"=>$updateFig->getQuantite(),
                            "description"=>$updateFig->getDescription(),
                            "id_cat"=>$updateFig->getCategorie()->getId_cat(),
                            "id_fig"=>$updateFig->getId_fig()];

        }else{
            $sql = "UPDATE figurine
                SET nom = :nom, taille = :taille, prix = :prix, annee = :annee, quantite = :quantite, image = :image, description = :description, id_cat = :id_cat
                WHERE id_fig = :id_fig";

            $tabParams = ["nom"=>$updateFig->getNom(),
                            "taille"=>$updateFig->getTaille(),
                            "prix"=>$updateFig->getPrix(),
                            "annee"=>$updateFig->getAnnee(),
                            "quantite"=>$updateFig->getQuantite(),
                            "image"=>$updateFig->getImage(),
                            "description"=>$updateFig->getDescription(),
                            "id_cat"=>$updateFig->getCategorie()->getId_cat(),
                            "id_fig"=>$updateFig->getId_fig()];
        }

        $result = $this -> getRequest($sql, $tabParams);
        return $result -> rowCount();
    }
}
?>