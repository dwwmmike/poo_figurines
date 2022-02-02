<?php ob_start(); ?>
<div class="container">
<h2 class="text-center text-decoration-underline mb-4 mt-4">Ajout d'une figurine</h2>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="text-center" enctype="multipart/form-data">
                <div class="row mt-3">
                    <div class="col">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom">
                    </div>
                    <div class="col">
                        <label for="taille">Taille</label>
                        <input type="text" id="taille" name="taille" class="form-control" placeholder="Taille">
                    </div>
                    <div class="col">
                        <label for="cat">Catégorie</label>
                        <select id="cat" name="cat" class="form-select">
                            <option value="">Choisir</option>
                            <?php foreach ($tabCat  as $cat) {; ?>
                            <option value="<?=$cat->getId_cat();?>"><?=$cat->getNom_cat();?></option>
                            <?php }; ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" placeholder="Prix">
                    </div>
                    <div class="col">
                        <label for="quantite">Quantité</label>
                        <input type="number" id="quantite" name="quantite" class="form-control" placeholder="Quantité">
                    </div>
                    <div class="col">
                        <label for="annee">Année</label>
                        <input type="date" id="annee" name="annee" class="form-control" placeholder="Année">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" >
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="descr">Description</label>
                        <textarea  id="descr" name="descr" class="form-control" placeholder="Description ..." ></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark text-warning col-12 mt-3" name="soumis" style="border-radius: 30px;">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>