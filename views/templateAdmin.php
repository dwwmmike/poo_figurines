<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./assets/css/templateAdmin.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
<div class="sidenav">
  <h1 class="text-center text-white" id="navtitle">Figurama</h1>
  <div class="text-center"><img src="./assets/images/logo.png" width="50%" alt=""></div>
    <a href="index.php?action=logout"><i class="fas fa-sign-out-alt text-white"></i></i></i>Déconnexion</a>
  <button class="dropdown-btn"><i class="fas fa-folder-open text-white"></i></i>Catégories
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
  <?php 
  if(isset($_SESSION) && isset($_SESSION["Auth"]) && ($_SESSION["Auth"]->id_statut == 1 || $_SESSION["Auth"]->id_statut == 2)){?> 
    <a href="index.php?action=add_cat"><i class="fas fa-plus text-white"></i>Ajout</a>
  <?php } ?>
    <a href="index.php?action=list_cat"><i class="fas fa-list text-white"></i>Liste</a>
  </div>
  <button class="dropdown-btn"><i class="fas fa-feather-alt text-white"></i>Figurines 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
  <?php 
  if(isset($_SESSION) && isset($_SESSION["Auth"]) && ($_SESSION["Auth"]->id_statut == 1 || $_SESSION["Auth"]->id_statut == 2)){?> 
    <a href="index.php?action=add_fig"><i class="fas fa-plus text-white"></i>Ajout</a>
    <?php } ?>
    <a href="index.php?action=list_fig"><i class="fas fa-list text-white"></i>Liste</a>
  </div>
  <button class="dropdown-btn"><i class="fas fa-users text-white"></i>Utilisateurs 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
  <?php 
  if(isset($_SESSION) && isset($_SESSION["Auth"]) && ($_SESSION["Auth"]->id_statut == 1 || $_SESSION["Auth"]->id_statut == 2)){?> 
    <a href="index.php?action=register"><i class="fa fa-registered text-white" aria-hidden="true"></i>Inscription</a>
    <?php } ?>
    <a href="index.php?action=list_u"><i class="fa fa-list text-white" aria-hidden="true"></i> Liste</a>
  </div>
</div>
<div class="container mt-5">
    <div class="main">
        <h1 class="bg-dark text-center text-warning" style="border-radius: 30px;">Administration</h1>
        <?= $contenu; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./assets/js/templateAdmin.js"></script>
<script src="./assets/js/scriptAjax.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html> 