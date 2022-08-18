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

    //create si id est null et fait un update si id existe
    public function saveInBdd(){
        //cas si id = null => INSERT
        $nom = addslashes($this->nom_);
        $description = addslashes($this->description_);
        $lienImage = addslashes($this->lienImage_);
    }

    public function deleteInBdd(){
        if(!is_null($this->id_)){
            $requetSQL = "DELETE FROM `stade`
            WHERE 
            id = '".$this->id_."'";
            $GLOBALS["pdo"]->query($requetSQL);
            echo "Le stade ".$this->nom_." a été supprimé";
    }

        if(is_null($this->id_)){
            $requetSQL = "INSERT INTO `stade`
            ( `nom`, `description`, `lienImage`) 
            VALUES 
            ('".$nom."','".$description."','".$lienImage."')";

            $resultat = $GLOBALS["pdo"]->query($requetSQL);
            $this->id_ = $GLOBALS["pdo"]->lastInsertId();
        }else{
            //UPDATE
            echo "tu va updater le film id N°".$this->id_;

            $nom = addslashes($this->nom_);
            $description = addslashes($this->description_);
            $lienImage = addslashes($this->lienImage_);

            $requetSQL = "UPDATE `stade` SET 
            `nom`='".$this->nom_."',
            `description`='".$this->description_."',
            `lienImage`='".$this->lienImage_."' 
            WHERE `id` = '".$this->id_."'";
            $resultat = $GLOBALS["pdo"]->query($requetSQL);
        }
    }




    public function setStadeById($id){
        $RequetSql = "SELECT * FROM `stade`
        WHERE `id` = '".$id."' "; 

        $resultat = $GLOBALS["pdo"]->query($RequetSql);
        if($resultat->rowCount()>0){
            $tab=$resultat->fetch();
            $this->id_ = $tab['id'];
            $this->nom_ = $tab['nom'];
            $this->description_ = $tab['description'];
            $this->lienImage_ = $tab['lienImage'];
        }
    }

    public function getAllStade(){
        $ListStades = array();
        //chercher en bdd tous les stades
        $RequetSql = "SELECT * FROM `stade`"; 
       

        $resultat = $GLOBALS["pdo"]->query($RequetSql); //resultat de type pdo statement
        while($tab=$resultat->fetch()){
            $lestade = new Stade($tab['id'],$tab['nom'],$tab['description'],$tab['lienImage'],);
            array_push($ListStades,$lestade);
        }

        return $ListStades;
    }

    public function getNom(){
        return $this->nom_;
    }

    public function getId(){
        return $this->id_;
    }

    public function getDescription(){
        return $this->description_;
    }

    public function renderHTML(){
        echo "<li>";
        echo $this->nom_;
        echo $this->description_;
        echo $this->getImage();
        echo "</li>";
    }

    public function getImage(){
        $imageHTML = '<img src="'.$this->lienImage_.'"alt="'.$this->nom_.'"/>';
        return $imageHTML;
    }

    public function getLienImage(){
        return $this->lienImage_ ;
    }

    public function setNom($nom){
        $this->nom_ = $nom;
    }

    public function setDescription($description){
        $this->description_ = $description;
    }

    public function setLienImage($lienImage){
        $this->leinImage_ = $lienImage;
    }
}

?>