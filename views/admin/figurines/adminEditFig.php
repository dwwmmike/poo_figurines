<?php ob_start(); ?>

<div class="container">
<h2 class="text-center text-decoration-underline mb-4 mt-4">Modifier la figurine <?=$editFig->getNom();?></h2>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="" enctype="multipart/form-data">

                <div class="row mt-3">
                    <div class="col">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" value="<?=$editFig->getNom();?>">
                    </div>
                    <div class="col">
                        <label for="taille">Taille</label>
                        <input type="text" id="taille" name="taille" class="form-control" placeholder="Taille" value="<?=$editFig->getTaille();?>">
                    </div>

                    <div class="col">
                        <label for="cat">Catégorie</label>
                        <select id="cat" name="cat" class="form-select">
                            <option value="<?=$editFig->getCategorie()->getId_cat();?>">
                                <?php
                                    foreach ($tabCat as $cat){
                                        if($cat->getId_cat() == $editFig->getCategorie()->getId_cat()){
                                            echo $cat -> getNom_cat();
                                        }
                                    }
                                ?>
                            </option>
                                <?php
                                    foreach ($tabCat as $cat) {
                                        if( $cat->getId_cat() != $editFig->getCategorie()->getId_cat()) {
                                ?>
                            <option value="<?=$cat->getId_cat();?>"><?=$cat->getNom_cat();?></option>
                                <?php }}; ?>            
                        </select>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" placeholder="Prix" value="<?=$editFig->getPrix();?>">
                    </div>
                    <div class="col">
                        <label for="quantite">Quantité</label>
                        <input type="number" id="quantite" name="quantite" class="form-control" placeholder="Quantité" value="<?=$editFig->getQuantite();?>">
                    </div>
                    <div class="col">
                        <label for="annee">Année</label>
                        <input type="date" id="annee" name="annee" class="form-control" placeholder="Année" value="<?=$editFig->getAnnee();?>">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" value="">
                    </div>
                    <div class="col">
                        <img src="./assets/images/<?=$editFig->getImage();?>" alt="" width="200" class="img-thumbnail mt-2">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="desc">Description</label>
                        <textarea  id="desc" name="desc" class="form-control" placeholder="Description ..." rows=""><?=$editFig->getDescription();?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark text-warning col-12 mt-3" name="soumis" style="border-radius: 30px;">Modifier</button>
            </form>
        </div>
    </div>
</div>
<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>
