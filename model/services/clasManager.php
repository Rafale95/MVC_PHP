<?php

use ProjetExam\exception\DbFailureRequestException;
use ProjetExam\exception\DeleteClassWithStudentsException;

include_once ('../../model/clas.php');
include_once ('dbManager.php');
include_once ('etudManager.php');
include_once ('etabManager.php');

include_once ('CRUD.php');

 // Import the exception class

class clasManager implements CRUD
{
    public function  __construct()
    {
        $this->pdb = dbManager::get_instance();
        $this->etabManager = new etabManager();
    }



    public function create($entity)
    {
        if(!$entity instanceof clas) //sécu pour éviter une erreur de type de la part du dev
            throw new UnexpectedValueException(clas::class, get_class($entity));

        $etab = (int) $this->etabManager->get_etabId();
        $niv = $entity->get_niv();
        $ident = $entity->get_ident();
        $nbEtud = 0;
        try {
            $query = <<< SQL
                INSERT INTO clas
                VALUES (null, '$niv', '$ident', '$nbEtud', '$etab');
            SQL;
            $run = $this->pdb->query($query);
            if($run) $entity->set_Pk($this->pdb->lastInsertId());
            else throw new DbFailureRequestException();
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Classe : Erreur d\'insertion en DB", 21);
        }
        catch (DbFailureRequestException $e)
        {
            throw $e;
        }
        return 0;
    }

    public function read(int $id = null, string $etud = null)
    {
        $TClas = array();
        switch (true)
        {
            case $id !== null:
                $query = <<< SQL
                SELECT * FROM clas WHERE PkClas='$id';
            SQL;
                break;

            case $etud !== null:
                $query = <<< SQL
            SELECT * FROM clas WHERE PkClas IN
                SELECT FkClas FROM etud WHERE FkClas='$etud';
            SQL;
                break;

            default:
                $query = <<< SQL
                SELECT * FROM clas;
            SQL;
                break;
        }

        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            $result = $run->fetchAll();
            foreach ($result as $row)
            {
                $t_clas = new clas;
                $etudManager = new etudManager();
                $t_clas->set_niv($row['Niv']);
                $t_clas->set_ident($row['Ident']);
                $t_clas->set_nbEtud($etudManager->get_NbEtudByClasDB($row['PkClas']));
                $t_clas->set_Pk($row['PkClas']);
                $t_clas->set_etab($this->etabManager->get_etabId());
                $TClas[] = $t_clas;
            }
            return $TClas;
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Classe : Erreur de lecture en DB", 20);
        }
    }

    public function update($entity)
    {
        if(!$entity instanceof clas)
            throw new UnexpectedValueException(clas::class, get_class($entity));
        $etudManager = new etudManager();
        $niv = $entity->get_niv();
        $ident = $entity->get_ident();
        $etab = $this->etabManager->get_etabId();
        $PkClas = $entity->get_Pk();
        $nbEtud = $etudManager->get_NbEtudByClasDB($PkClas); //nécessaire pour qu'il y ait une modif en DB

        $query = <<< SQL
            UPDATE clas SET Niv = '$niv', Ident = '$ident', NbEtud = '$nbEtud' 
            WHERE PkClas = '$PkClas';
        SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Classe : Erreur de mise à jour en DB", 22);
        }
        return 0;
    }

    public function delete(int $id)
    {
        try
        {
            $etudManager = new etudManager();
            $nbEtud = $etudManager->get_NbEtudByClasDB($id);
            if (!($nbEtud == 0 || $nbEtud == null))
                throw new DeleteClassWithStudentsException();
            else
            {
                $query = <<<SQL
                DELETE FROM clas WHERE PkClas='$id';
                SQL;

                $run = $this->pdb->prepare($query);
                $run->execute();
            }
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Classe : Erreur de suppression en DB", 23);
        }
        catch (DeleteClassWithStudentsException $e)
        {
            throw $e; // Re-throw exception for handling in the controller
        }
    }

    /**
     * @param $ClasName
     * @return void
     */
    public function get_ClasId($ClasName = null, $Pk = null)
    {

        try{
            if($Pk == null)
                $query = <<< SQL
                SELECT PkClas FROM clas left join etud e on clas.PkClas = e.FkClas where Ident = '$ClasName';
                SQL;
            else
                $query = <<< SQL
                SELECT PkClas FROM clas left join etud e on clas.PkClas = e.FkClas where PkEtud = '$Pk';
                SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll()[0][0]; // retourne la première colonne de la première ligne de résultat.
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Classe : Erreur de récupération en DB", 24);
        }
    }

    public function get_ClasName($PkClas)
    {
        $query = <<<SQL
            SELECT Ident FROM clas where PkClas = '$PkClas';
        SQL;

        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll()[0][0]; // retourne la première colonne de la première ligne de résultat.
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Classe : Erreur de récupération en DB", 24);
        }
    }
    public function get_ClasNames()
    {
        $query = <<<SQL
            SELECT Ident FROM clas;
        SQL;

        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll();
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Classe : Erreur de récupération en DB", 24);
        }
    }

    public function get_NbClasDB() //retourne le nombre d'étudiant dans une classe
    {
        $query = <<< SQL
        SELECT Count(*) FROM Clas;
        SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetch()[0];
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Classe - Erreur de récupération en DB", 21);
        }
    }
}
