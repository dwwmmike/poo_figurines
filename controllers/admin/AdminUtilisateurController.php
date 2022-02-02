<?php

class AdminUtilisateurController{
    private $adUser;
    private $adStat;

    public function __construct(){
        $this-> adUser = new AdminUtilisateurModel();
        $this-> adStat = new AdminStatutModel();
    }

    public function listUsers(){
        AuthController::isLogged();
        if(isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["actif"])){
            $id = $_GET["id"];
            $actif = $_GET["actif"];
            $user = new Utilisateur();
            if($actif == 1){
                $actif = 0;
            }else{
                $actif = 1;
            }
            $user -> setId_u($id);
            $user->setActif($actif);
            $this -> adUser -> updateActif($user);
        }
        $allUsers = $this->adUser->getUsers();
        require_once("./views/admin/utilisateurs/adminUtilisateursItems.php");
    }

    public function login(){
        if(isset($_POST["soumis"])){
            if (isset($_POST["soumis"]) && strlen($_POST["password"]) >= 4 && !empty($_POST["loginEmail"])){
                $loginEmail = trim(htmlentities(addslashes($_POST["loginEmail"])));
                $pass = md5(trim(htmlentities(addslashes($_POST["password"]))));
                $data_u = $this -> adUser -> signIn($loginEmail, $pass);
                if(!empty($data_u)){
                    if($data_u -> actif > 0){
                        session_start();
                        $_SESSION["Auth"] = $data_u;
                        header("location:index.php?action=list_fig");
                    }else{
                        $error = "Votre compte n'existe plus";
                    }
                }else{
                    $error = "Votre login/email et/ou mot de passe ne correspondent pas";
                }
            }else{
                $error = "Veuillez entrer au moins 4 caractères";
            }
        }
        require_once("./views/admin/utilisateurs/login.php");
    }


    public function addUser(){
        AuthController::isLogged();
        if(isset($_POST["soumis"])){
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && strlen($_POST["pass"]) >= 4){
                $nom = trim(htmlentities(addslashes($_POST["nom"])));
                $prenom= trim(htmlentities(addslashes($_POST["prenom"])));
                $email = trim(htmlentities(addslashes($_POST["email"])));
                $password = trim(htmlentities(addslashes($_POST["pass"])));
                $identifiant = trim(htmlentities(addslashes($_POST["identifiant"])));
                $id_stat = trim(htmlentities(addslashes($_POST["statut"])));

                $newU = new Utilisateur();
                $newU->setNom($nom);
                $newU->setPrenom($prenom);
                $newU->setEmail($email);
                $newU->setPassword($password);
                $newU->setIdentifiant($identifiant);
                $newU->getStatut()->setId_stat($id_stat);
                $newU->setActif(1);

                $ok = $this->adUser->insertUser($newU);
                if($ok){
                    header("location:index.php?action=list_u");
                } 
            }
        }
        $tabStatut = $this -> adStat -> getStatut();

        require_once("./views/admin/utilisateurs/adminAddUtilisateurs.php");
    }
}
?>