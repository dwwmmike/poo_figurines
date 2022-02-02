<?php ob_start(); ?>

<h2 class="text-center text-decoration-underline mb-4 mt-4 title">Liste des utilisateurs</h2>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Identifiant</th>
            <th>Email</th>
            <th>Statut</th>
            <?php 
                if($_SESSION["Auth"]->id_statut == 1){?> 
            <th colspan="2" class="text-center">Action</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allUsers as $user){?>
            
        <tr>
            <td><?=$user->getId_u();?></td>
            <td><?=$user->getNom();?></td>
            <td><?=$user->getPrenom();?></td>
            <td><?=$user->getIdentifiant();?></td>
            <td><?=$user->getEmail();?></td>
            <td><?=$user->getStatut()->getNom_stat();?></td>
            <?php 
                if($_SESSION["Auth"]->id_statut == 1){?> 
            <td class="text-center">
                <?php echo($user->getActif())
                    ?'<a href="index.php?action=list_u&id='.$user->getId_u()."&actif=".$user->getActif().'"onclick="return confirm(`Etes-vous sûr de vouloir désactiver cet utilisateur?`)" class="btn btn-success"><i class="fas fa-unlock"></i> DESACTIVER</a>'    
                    :'<a href="index.php?action=list_u&id='.$user->getId_u()."&actif=".$user->getActif().'"onclick="return confirm(`Etes-vous sûr de vouloir activer cet utilisateur?`)" class="btn btn-danger"><i class="fas fa-lock"></i> ACTIVER</a>';
                ?>
            </td>
            <?php }}?>
        </tr>
    </tbody>
</table>
<?php $contenu = ob_get_clean();
    require_once("./views/templateAdmin.php");
?>