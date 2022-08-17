<?php
class Stade{


    //Propriété private
    private $id_;
    private $nom_;
    private $description_;
    private $lienImage_;


    //Methode public
    public function __construct($id,$nom,$description,$lienImage){
        $this->id_ = $id;
        $this->nom_ = $nom;
        $this->description_ = $description;
        $this->lienImage_ = $lienImage;
    }

    public function setStadeById($id){

    }

    public function getAllStade(){
        $ListStades = array();
        //chercher en bdd tous les stades
        $RequetSql = "SELECT * FROM `stade`"; 
       

        $resultat = $GLOBALS["pdo"]->query($RequetSql); //resultat de type pdo statement
        while($tab=$resultat->fetch()){
            $stade = new Stade($tab['id'],$tab['nom'],$tab['description'],$tab['lienImage'],);
            array_push($ListStades,$stade);
        }

        return $ListStades;
    }

    public function getNom(){
        return $this->nom_;
    }

    public function getDescription(){
        return $this->description_;
    }

    public function getImage(){
        $imageHTML = '<img src="'.$this->lienImage_.'"alt="'.$this->nom_.'"/>';
        return $imageHTML;
    }

}

?>