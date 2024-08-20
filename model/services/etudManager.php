<?php

use ProjetExam\Exception\DbFailureRequestException;
use ProjetExam\Exception\DeleteStudentWithInscrException;
use ProjetExam\Exception\UnexpectedClassException;

include_once ('../../model/etud.php');
include_once ('CRUD.php');
include_once ('dbManager.php');
include_once ('clasManager.php');
include_once ('inscrManager.php');

/**
 *
 */
class etudManager implements CRUD
{
    public clasManager $clasManager;
    /**
     * constructeur
     */
    public function  __construct()
    {
        $this->pdb = dbManager::get_instance();
        $this->clasManager = new clasManager();
    }

    /**
     * @param $entity
     * @return void
     */
    public function create($entity)
    {
        if(!$entity instanceof etud)
            throw new UnexpectedClassException(etud::class, get_class($entity));

        $clas = (int) $this->clasManager->get_ClasId($entity->get_clas());
        $nom = $entity->get_nom();
        $pren = $entity->get_pren();
        $sexe = $entity->get_sexe();
        $nbInscr = 0;
        try
        {
            $query = <<< SQL
            INSERT INTO etud
            VALUES (null,'$clas','$nom','$pren','$sexe','$nbInscr');
            SQL;
            $run = $this->pdb->query($query);
            if($run) $entity->set_Pk($this->pdb->lastInsertId());
            else throw new DbFailureRequestException();
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Etudiant : Erreur d\'insertion en DB", 21);
        }
        catch (DbFailureRequestException $e)
        {
            throw $e;
        }
    }

    /**
     * @param int|null $id
     * @return array|void
     */
    public function read (int $id = null)
    {
        $Tuser = array();
        if($id !== null) // check si l'id n'est pas null et bien un entier
        {
            $query = <<< SQL
                SELECT * FROM etud WHERE PkEtud='$id';
            SQL;
        }
        else
        {
            $query = <<< SQL
                SELECT * FROM etud;
            SQL;
        }
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            $result = $run->fetchAll();
            foreach ($result as $row)
            {
                $t_user = new etud();
                $inscrManager = new inscrManager();
                $t_user->set_Pk($row['PkEtud']);
                $t_user->set_nom($row['Nom']);
                $t_user->set_pren($row['Pren']);
                $t_user->set_sexe($row['Sexe']);
                $t_user->set_nbInscr($inscrManager->get_NbInscrByEtudDB($row['PkEtud']));
                $t_user->set_clas($this->clasManager->get_ClasName($row['FkClas']));
                $Tuser[] = $t_user;
            }
            return $Tuser;
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Etudiant - Erreur de lecture en DB", 21);
        }
    }

    /**
     * @param $entity
     * @return void
     */
    public function update($entity)
    {
        if(!$entity instanceof etud)
            throw new UnexpectedValueException(etud::class, get_class($entity));
        $inscrManager = new inscrManager();
        $nom = $entity->get_nom();
        $pren = $entity->get_pren();
        $sexe = $entity->get_sexe();
        $clas = $this->clasManager->get_ClasId($entity->get_clas());
        $PkEtud = $entity->get_Pk();
        $nbInscr = $inscrManager->get_NbPartByEprDB($PkEtud);
        $query = <<< SQL
            UPDATE etud SET Nom='$nom', Pren='$pren', Sexe='$sexe', NbIns='$nbInscr', FkClas='$clas' WHERE PkEtud='$PkEtud';
        SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Etudiant - Erreur de modification en DB", 21);
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $inscrManager = new inscrManager();
        $nbInscr = $inscrManager->get_NbInscrByEtudDB($id);
        if($nbInscr > 0) throw new DeleteStudentWithInscrException("Etudiant - Erreur de suppression en DB", 21);
        $query = <<< SQL
            DELETE FROM etud WHERE PkEtud='$id';
        SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Etudiant - Erreur de suppression en DB", 21);
        }
        catch (DeleteStudentWithInscrException $e)
        {
            throw $e;
        }
    }


    public function get_NbEtudByClasDB(int $PkClas) //retourne le nombre d'étudiant dans une classe
    {
        $query = <<< SQL
        SELECT Count(*) FROM etud where FkClas = '$PkClas';
        SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetch()[0];
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Etudiant - Erreur de récupération en DB", 21);
        }
    }
    /**
     * @param $ClasName
     * @return void
     */
    public function get_EtudId($Pk)
    {
        try{
            $query = <<< SQL
                SELECT PkEtud FROM etud left join inscr i on etud.PkEtud = i.FkEtud where PkInscr = '$Pk';
                SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll()[0][0]; // retourne la première colonne de la première ligne de résultat.
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Etudiant : Erreur de récupération en DB", 24);
        }
    }


    public function get_EtudName($Pk) // retourne le nom de l'étudiant
    {
        try
        {
            $query = <<< SQL
                SELECT Nom FROM etud where PkEtud = '$Pk';
                SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll()[0][0]; // retourne la première colonne de la première ligne de résultat.
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Etudiant : Erreur de récupération en DB", 24);
        }
    }

    public function get_EtudFName($Pk) // retourne le prénom de l'étudiant
    {
        try
        {
            $query = <<< SQL
                SELECT Pren FROM etud where PkEtud = '$Pk';
                SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll()[0][0]; // retourne la première colonne de la première ligne de résultat.
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Etudiant : Erreur de récupération en DB", 24);
        }
    }

}