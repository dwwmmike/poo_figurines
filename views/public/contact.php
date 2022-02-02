<?php ob_start();?>

<div class="container">
<h2 class="text-white">Contact</h2>
<div class="row">
    <div class="col">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label text-white">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom...">
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label text-white">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prenom...">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label text-white">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse email...">
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label text-white">Adresse</label>
            <input type="adresse" class="form-control" id="adresse" name="adresse" placeholder="Entrez votre adresse...">
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label text-white">Téléphone</label>
            <input type="tel" class="form-control" id="tel" name="tel" placeholder="Entre votre numéro de téléphone...">
        </div>
        <div class="mb-3">
        <label for="tel" class="form-label text-white">Message</label>
        <textarea class="form-control" name="message" placeholder="Entrez votre message..." id="message"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-secondary col-12 mb-2">Envoyer</button> 
        </form>
    </div>
    <div class="col mt-4">
        <iframe class="rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d51801.77132597731!2d139.18880482163092!3d35.760372025042095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6019249feec1e9d1%3A0xfebc85e4a2fae700!2sHinode%2C%20Nishitama%2C%20Tokyo%2C%20Japon!5e0!3m2!1sfr!2sfr!4v1617820139973!5m2!1sfr!2sfr" width="550" height="560" style="border:12;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>