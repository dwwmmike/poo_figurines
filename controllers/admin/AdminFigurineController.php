<?php

class AdminFigurineController{
    private $adfigm;

     public function __construct(){
        $this->adfigm = new AdminFigurineModel();
        $this -> adCat = new AdminCategorieModel();
    }

    public function listFigurines(){
        AuthController::isLogged();
        if(isset($_POST["soumis"]) && !empty($_POST["search"])){
            $search = trim(htmlentities(addslashes($_POST["search"])));
            $figs = $this->adfigm->getFigurines($search);
            require_once("./views/admin/figurines/adminFigurinesItems.php");
        }else{
            $figs = $this->adfigm->getFigurines();
            require_once("./views/admin/figurines/adminFigurinesItems.php");
        }
       
    }
    public function addFigurine(){
        AuthController::isLogged();
        if(isset($_POST["soumis"]) && !empty($_POST["nom"]) && !empty($_POST["prix"]) && !empty($_POST["cat"])){
            $nom = addslashes(htmlspecialchars(trim($_POST["nom"])));
            $taille = addslashes(htmlspecialchars(trim($_POST["taille"])));
            $prix = addslashes(htmlspecialchars(trim($_POST["prix"])));
            $quantite = addslashes(htmlspecialchars(trim($_POST["quantite"])));
            $annee = addslashes(htmlspecialchars(trim($_POST["annee"])));
            $id_cat = addslashes(htmlspecialchars(trim($_POST["cat"])));
            $description = addslashes(htmlspecialchars(trim($_POST["descr"])));
            $image = $_FILES ["image"]["name"];

            $newFig = new Figurine();
            $newFig->setNom($nom);
            $newFig->setPrix($prix);
            $newFig->setTaille($taille);
            $newFig->setQuantite($quantite);
            $newFig->setAnnee($annee);
            $newFig->getCategorie()->setId_cat($id_cat);
            $newFig->setDescription($description);
            $newFig->setImage($image);
            $destination = "./assets/images/";

            move_uploaded_file($_FILES["image"]["tmp_name"], $destination.$image);

            $ok = $this->adfigm->insertFigurine($newFig);
            if($ok){
                header("location:index.php?action=list_fig");
            }
        }
        $tabCat = $this -> adCat  -> getCategories();

        require_once("./views/admin/figurines/adminAddFig.php");
    }

    public function removeFig(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && $_GET["id"] < 1000 && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = trim($_GET["id"]);
            $nbLine = $this -> adfigm -> deleteFig($id);
            if($nbLine > 0){
                header("location:index.php?action=list_fig");
            }
        }
    }

    public function editFig(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && filter_var($_GET["id"], FILTER_VALIDATE_INT)){
            $id = $_GET["id"];
            $editFig = new Figurine;
            $editFig->setId_fig($id);

            $editFig = $this->adfigm->figurineItem($editFig); 
            $tabCat = $this->adCat->getCategories();
        
            if(isset($_POST["soumis"]) && !empty($_POST["nom"]) && !empty($_POST["prix"])){
        
                $nom = addslashes(htmlspecialchars(trim($_POST["nom"])));
                $taille = addslashes(htmlspecialchars(trim($_POST["taille"])));
                $prix = addslashes(htmlspecialchars(trim($_POST["prix"])));
                $quantite = addslashes(htmlspecialchars(trim($_POST["quantite"])));
                $annee = addslashes(htmlspecialchars(trim($_POST["annee"])));
                $id_cat = addslashes(htmlspecialchars(trim($_POST["cat"])));
                $description = addslashes(htmlspecialchars(trim($_POST["desc"])));
                $image = $_FILES ["image"]["name"];

                $editFig->setNom($nom);
                $editFig->setTaille($taille);
                $editFig->setPrix($prix);
                $editFig->setQuantite($quantite);
                $editFig->setAnnee($annee);
                $editFig->getCategorie()->setId_cat($id_cat);
                $editFig->setDescription($description);
                $editFig->setImage($image);
                
                $destination = "./assets/images/";
                move_uploaded_file($_FILES["image"]["tmp_name"], $destination.$image);

                $ok = $this->adfigm->updateFigurine($editFig);
                    header("location:index.php?action=list_fig");
            }
            require_once("./views/admin/figurines/adminEditFig.php");
        }
    }
}
?>