<?php ob_start(); ?>

<div class="container">
<h2 class="text-center text-decoration-underline mb-4 mt-4">Formulaire d'ajout de catégorie</h2>
    <div class="row mt-3">
        <div class="col-6 offset-3">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="text-center">

                <label for="categorie">Catégorie</label>
                <input type="text" id="categorie" name="categorie" class="form-control mt-3" placeholder="Nom de la catégorie...">
                <button type="submit" class="btn btn-dark text-warning col-12 mt-3" name="soumis" style="border-radius: 30px;">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>