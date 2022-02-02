<?php ob_start(); ?>

<div class="container">
<h2 class="text-center text-decoration-underline mb-4 mt-4">Inscription d'un utilisateur</h2>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="text-center">
                <div class="row mt-3">
                    <div class="col">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom">
                    </div>
                    <div class="col">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom">
                    </div>
                    <div class="col">
                        <label for="statut">Statut</label>
                        <select id="statut" name="statut" class="form-select">
                            <?php foreach ($tabStatut  as $statut) {; ?>
                            <option value="<?=$statut->getId_stat();?>"><?=$statut->getNom_stat();?></option>
                            <?php }; ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="col">
                        <label for="pass">Mot de passe</label>
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Mot de passe">
                    </div>
                    <div class="col">
                        <label for="identifiant">Identifiant</label>
                        <input type="text" id="identifiant" name="identifiant" class="form-control" placeholder="Identifiant">
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