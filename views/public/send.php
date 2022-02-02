<?php ob_start();?>

<div class="container">
<div class="alert alert-success text-center" role="alert">
  Message envoyé avec succès!
</div>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>