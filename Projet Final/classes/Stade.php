<?php
class Stade{


    //Propriété private
    private $id_;
    private $nom_;
    private $description_;
    private $lienImage_;
    private $MoyenneNote_;


    //Methode public
    public function __construct($id, $nom, $description, $lienImage, $note){
        $this->id_ = $id;
        $this->nom_ = $nom;
        $this->description_ = $description;
        $this->lienImage_ = $lienImage;
        $this->MoyenneNote_ = $note;
    }

    //create si id est null et fait un update si id existe
    public function saveInBdd(){
        //cas si id = null => INSERT
        $nom = addslashes($this->nom_);
        $description = addslashes($this->description_);
        $lienImage = addslashes($this->lienImage_);

        if(is_null($this->id_)){
            $requetSQL = "INSERT INTO `stade`
            ( `nom`, `description`, `lienImage`) 
            VALUES 
            ('".$nom."','".$description."','".$lienImage."')";

            $resultat = $GLOBALS["pdo"]->query($requetSQL);
            $this->id_ = $GLOBALS["pdo"]->lastInsertId();

            $requetSQL = "INSERT INTO `note`
            ( `iduser`, `idstade`, `note`) 
            VALUES 
            ('".$_SESSION['id']."', '".$this->id_."', '".$this->MoyenneNote_."');";
            $GLOBALS["pdo"]->query($requetSQL);

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

    public function deleteInBdd(){
        if(!is_null($this->id_)){
            $requetSQL = "DELETE FROM `stade`
            WHERE 
            id = '".$this->id_."'";
            $GLOBALS["pdo"]->query($requetSQL);
            echo "Le stade ".$this->nom_." a été supprimé";
        }
    }




    public function setStadeById($id){
        $RequetSql = "SELECT stade.id,stade.nom,stade.description,stade.lienImage, AVG(note.note) as 'note' 
        FROM stade,note,user
        WHERE
        stade.id = note.idstade
        AND
        note.iduser = user.id
        AND 
        stade.id = '" . $id . "'  
        Group By stade.id;";

        $resultat = $GLOBALS["pdo"]->query($RequetSql);
        if($resultat->rowCount()>0){
            $tab=$resultat->fetch();
            $this->id_ = $tab['id'];
            $this->nom_ = $tab['nom'];
            $this->description_ = $tab['description'];
            $this->lienImage_ = $tab['lienImage'];
            $this->MoyenneNote_ = $tab['note'];
        }
    }

    public function getAllStade(){
        $ListStades = array();
        //chercher en bdd tous les stades
        $RequetSql = "SELECT stade.id,stade.nom,stade.description,stade.lienImage, AVG(note.note) as 'note' 
        FROM stade,note,user
        WHERE
        stade.id = note.idstade
        AND
        note.iduser = user.id 
        Group By stade.id;";
       

        $resultat = $GLOBALS["pdo"]->query($RequetSql); //resultat de type pdo statement
        while($tab= $resultat->fetch()){
            $lestade = new Stade($tab['id'],$tab['nom'],$tab['description'],$tab['lienImage'],$tab['note']);
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
            ?>
                <!--catre a dupplicquer -->
                <div class="col mb-5">
            <div class="card h-100 white">
                <!-- Sale badge-->
                <div class="badge bg-yellow text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Vote</div>
                <!-- Product image-->
                <img class="card-img-top" src="<?= $this->getLienImage(); ?>" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder"><?= $this->nom_;?></h5>
                        <!-- Product reviews-->
                        <div class="d-flex justify-content-center small text-warning mb-2">
                            
                            <?php
                                for ($i=0; $i < round($this->MoyenneNote_); $i++) { 
                                   echo'<div class="bi-star-fill"></div>';
                                }
                                for ($i=$i; $i < 5; $i++) { 
                                    echo'<div class="bi-star"></div>';
                                }
                            ?>
                            <?= round($this->MoyenneNote_)."/5" ?>
                        </div>
                        <!-- Product price-->
                        <span class="text-muted"><?= $this->description_;?></span>

                    </div>
                </div>
                <!-- Product actions-->
            </div>
        </div>
            <?php
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