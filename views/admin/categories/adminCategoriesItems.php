
<?php ob_start(); ?>
<h2 class="text-center text-decoration-underline mb-4 mt-4">Liste des catégories</h2>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allCat as $cat){?>   
        <tr>
            <td><?=$cat->getId_cat();?></td>
            <td><?=$cat->getNom_cat();?></td>
            <td class="text-center">
                <a class="btn btn-info <?= ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 ) ? 'enable' : 'disabled' ?>" href="index.php?action=edit_cat&id=<?= $cat->getId_cat();?>">
                <i class="fas fa-pen"></i></a>
            </td>
            <td class="text-center">
                <a class="btn btn-danger <?= ($_SESSION["Auth"]->id_statut == 1 ) ? 'enable' : 'disabled' ?>" href="index.php?action=delete_cat&id=<?= $cat->getId_cat();?>"
                onclick="return confirm('Etes-vous sûr de vouloir supprimer')">
                <i class="fas fa-trash"></i></a>
            </td>
            <?php } ?>
        </tr>
    </tbody>
</table>

<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>