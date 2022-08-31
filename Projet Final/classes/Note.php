<?php

class Note{

    //propriété
    private $id_;
    private $idStade_;
    private $idUser_;
    private $note_;


    //méthode
    public function __construct ($newIddUser,$newIdStade,$NewNote){
        $this->idStade_ = $newIdStade;
        $this->idUser_ = $newIddUser;
        $this->note_ = $NewNote;
    }

public function saveInBdd(){
    if(is_null($this->id_)) {
        $RequetSql = "Select stade.id
            FROM stade,note,user
            WHERE
            stade.id = note.idstade
            AND
            note.iduser = user.id
            AND
            stade.id = '" . $this->idStade_ . "'  
            AND 
            user.id = '" . $this->idUser_ . "'  
            Group By stade.id;";

            $resultat = $GLOBALS["pdo"]->query($RequetSql); //resultat sera de type pdoStatement
            if ($resultat->rowCount() > 0) {
                $requetSQL = "UPDATE `note` SET 
                `note`='" . $this->note_ . "'
                WHERE note.idstade = '" .$this->idStade_ . "'
                AND note.idstade ='" .$this->idUser_ . "'";
                $GLOBALS["pdo"]->query($requetSQL);
            }else{
                $requetSQL = "INSERT INTO `note` ( `iduser`, `idstade`, `note`) 
                VALUES ( '".$this->idUser_."', '".$this->idStade_."', '".$this->note_."');";
                $GLOBALS["pdo"]->query($requetSQL);
                $this->id_ = $GLOBALS["pdo"]->lastInsertId();
            }
        //UPDATE
    }else{}

        $requetSQL = "UPDATE `note` SET 
        `note`='".$this->note_."', 
        WHERE `id` = '".$this->id_."'";
        $GLOBALS["pdo"]->query($requetSQL);
    }
}


?>