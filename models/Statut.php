<?php

Class Statut{
    private $id_stat;
    private $nom_stat;


    /**
     * Get the value of id_stat
     */ 
    public function getId_stat()
    {
        return $this->id_stat;
    }

    /**
     * Set the value of id_stat
     *
     * @return  self
     */ 
    public function setId_stat($id_stat)
    {
        $this->id_stat = $id_stat;

        return $this;
    }

    /**
     * Get the value of nom_statut
     */ 
    public function getNom_stat()
    {
        return $this->nom_stat;
    }

    /**
     * Set the value of nom_statut
     *
     * @return  self
     */ 
    public function setNom_stat($nom_stat)
    {
        $this->nom_stat = $nom_stat;

        return $this;
    }
}