<?php ob_start(); ?>
<h2 class="text-center text-decoration-underline mb-4 mt-4">Liste des figurines</h2>
<div class="row">
    <div class="col-4 offset-8">
        <form action="<?php $_SERVER["PHP_SELF"];?>" method="post" class="input-group">
            <input class="form-control" type="search" name="search" id="search" placeholder="Rechercher">
            <button type="submit" class="btn btn-outline-secondary" name="soumis"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>
<table class="table table-striped table-dark">
      <thead>
          <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Image</th>
            <th>Taille</th>
            <th>Quantite</th>
            <th>Année</th>
            <th>Description</th>
            <th>Categorie</th>
            <th colspan="2" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          <tr>
          <?php if(is_array($figs)){ foreach ($figs as  $fig) { ?>
              <td><?=$fig->getId_fig();?></td>
              <td><?=$fig->getNom();?></td>
              <td><?=$fig->getPrix();?> €</td>
              <td><img src="./assets/images/<?=$fig->getImage();?>" alt="" width="100"></td>
              <td><?=$fig->getTaille();?></td>
              <td><?=$fig->getQuantite();?></td>
              <td><?=$fig->getAnnee();?></td>
              <td ><?=substr($fig->getDescription(),0, 19);?></td>
              <td><?=$fig->getCategorie()->getNom_cat();?></td>
              <td class="text-center">
                <a class="btn btn-info <?= ($_SESSION["Auth"]->id_statut == 1 ) || ($_SESSION["Auth"]->id_statut == 2 ) ? 'enable' : 'disabled' ?>" href="index.php?action=edit_fig&id=<?= $fig->getId_fig();?>">
                    <i class="fas fa-pen"></i>
                </a>
              </td>
              <td  class="text-center">
                <a class="btn btn-danger <?= ($_SESSION["Auth"]->id_statut == 1 ) ? 'enable' : 'disabled' ?>" href="index.php?action=delete_fig&id=<?= $fig->getId_fig();?>"
                    onclick="return confirm('Etes vous sûr de vouloir supprimer')">
                    <i class="fas fa-trash"></i>
                </a>
              </td>
          </tr>
          <?php }} else{ echo"<tr class='text-center text-danger'><td colspan='10' >".$figs."</td></tr>";} ?>
      </tbody>
  </table>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
