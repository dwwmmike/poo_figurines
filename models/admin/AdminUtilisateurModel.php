<?php

class AdminUtilisateurModel extends Driver{
    public function getUsers(){
        $sql ="SELECT * FROM utilisateurs u
                INNER JOIN statut s
                ON u.id_statut = s.id_stat
                ORDER BY u.id_u";
        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tabUser = [];

        foreach($rows as $row){
            $user = new Utilisateur();
            $user->setId_u($row->id_u);
            $user->setNom($row->nom);
            $user->setPrenom($row->prenom);
            $user->setIdentifiant($row->identifiant);
            $user->setPassword($row->password);
            $user->getStatut()->setId_stat($row->id_stat);
            $user->getStatut()->setNom_stat($row->nom_stat);
            $user->setEmail($row->email);
            $user->setActif($row->actif);
            array_push($tabUser,$user);
        }
            return $tabUser;
    }

    public function updateActif(Utilisateur $user){
        $sql = "UPDATE utilisateurs SET actif = :actif WHERE id_u = :id";
        $result = $this -> getRequest($sql, ['actif' => $user -> getActif(), 'id' => $user -> getId_u()]);
        
        return $result -> rowCount();
    }

    public function register(Utilisateur $user){
        $sql = "SELECT * FROM utilisateurs
                WHERE  email = :email";
        $result = $this -> getRequest($sql, ["email" => $user -> getEmail()]);
        if($result -> rowCount() == 0){
            $req = "INSERT INTO utilisateurs(nom, prenom, identifiant, email, password, statut, id_stat)
                    VALUES (:nom, :prenom , :identifiant, :email, :password, :statut, :id_stat)";
            $tabUser = ["nom"=>$user->getNom(), "prenom"=>$user->getPrenom(), "identifiant"=>$user->getIdentifiant(), "email"=>$user->getEmail(), "password"=>$user->getPassword(), "statut"=>$user->getStatut(), "id_stat"=>$user->getStatut()->getId_stat()];
            $res = $this -> getRequest($req, $tabUser);
            return $res;
        }else{
            return "Cette utilisateur existe déjà";}
    }

    public function insertUser(Utilisateur $utilisateur){
        $sql = "INSERT INTO utilisateurs(nom, prenom, identifiant, email, password, id_statut, actif)
                VALUES (:nom, :prenom, :identifiant, :email, :password, :id_statut, :actif)";
        
        $tabParams = ["nom"=>$utilisateur->getNom(),
                    "prenom"=>$utilisateur->getPrenom(),
                    "identifiant"=>$utilisateur->getIdentifiant(),
                    "email"=>$utilisateur->getEmail(),
                    "password"=>$utilisateur->getPassword(),
                    "id_statut"=>$utilisateur->getStatut()->getId_stat(),
                    "actif"=> 1
                ];
                    
        $result = $this -> getRequest($sql, $tabParams);
        return $result;
    }
    public function signIn($loginEmail, $pass){
        $sql = "SELECT * FROM utilisateurs
                WHERE (identifiant = :logEmail OR email = :logEmail) AND password = :password";
        $result = $this -> getRequest($sql, ["logEmail" => $loginEmail, "password" => $pass]);
        
        $row = $result -> fetch(PDO::FETCH_OBJ);

        return $row;
    }
}
?>