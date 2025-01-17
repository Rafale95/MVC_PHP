<?php
use ProjetExam\Exception\DbFailureRequestException;
use ProjetExam\Exception\DeleteInscrWithTEndException;
use ProjetExam\Exception\UnexpectedClassException;

include_once('../../model/inscr.php');
include_once ('dbManager.php');
include_once ('CRUD.php');
include_once ('etudManager.php');
include_once ('eprManager.php');


class inscrManager implements CRUD
{
    public function  __construct()
    {
        $this->pdb = dbManager::get_instance();
    }

    public function create($entity)
    {
        if(!$entity instanceof inscr)
            throw new UnexpectedClassException(inscr::class, get_class($entity));
        $etudManager = new etudManager();
        $eprManager = new eprManager();
        $etud = (int) $entity->get_etudId();
        $epr = (int) $entity->get_eprId();
        $tStart = $entity->get_tStart();
        $NoDos = $entity->get_NoDos();
        $runWalk = $entity->get_rw();
        $temps = $entity->get_temps();
        $tEnd = $entity->get_Tend();
        $tStart = $tStart ? "'$tStart'" : 'NULL';
        $tEnd = $tEnd ? "'$tEnd'" : 'NULL';
        $temps = $temps ? "'$temps'" : 'NULL';

        $query = <<< SQL
            INSERT INTO inscr
            VALUES (null, '$etud', '$epr', '$NoDos', '$runWalk', $tStart, $tEnd, $temps);
        SQL;
        $run = $this->pdb->query($query);
        if($run) $entity->set_Pk($this->pdb->lastInsertId());
        else throw new DbFailureRequestException("Inscription - Erreur d\'insertion en DB", 21);
        return 0;
    }

    public function read(int $id = null, int $etudId = null, int $eprId = null)
    {
        $Tinscr = array();
// Ce switch case permet de déterminer la requête SQL à exécuter en fonction des paramètres passés à la méthode read
        switch (true)
        {
            case $id !== null:
                $query = <<< SQL
                SELECT * FROM inscr WHERE PkInscr='$id';
            SQL;
                break;

            case $etudId !== null:
                $query = <<< SQL
                SELECT * FROM inscr WHERE FKetud='$etudId';
            SQL;
                break;

            case $eprId !== null:
                $query = <<< SQL
                SELECT * FROM inscr WHERE FKepr='$eprId';
            SQL;
                break;

            default:
                $query = <<< SQL
                SELECT * FROM inscr;
            SQL;
                break;
        }

        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            $result = $run->fetchAll();
            foreach ($result as $row)
            {
                $t_inscr = new inscr();
                $t_inscr->set_Pk($row['PkInscr']);
                $t_inscr->set_etudId($row['FkEtud']);
                $t_inscr->set_eprId($row['FkEpr']);
                $t_inscr->set_NoDos($row['NoDos']);
                $t_inscr->set_tEnd($row['Tend']);
                $t_inscr->set_rw($row['Rw']);
                $t_inscr->set_tStart($row['Tstart']);
                $t_inscr->set_temps();
                $Tinscr[] = $t_inscr;
            }
            return $Tinscr;
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Inscription - Erreur de lecture en DB", 21);
        }
    }

    public function update($entity)
    {
        if(!$entity instanceof inscr)
            throw new UnexpectedValueException(inscr::class, get_class($entity));
        $NoDos = $entity->get_NoDos();
        $runWalk = $entity->get_rw();
        $tStart = $entity->get_Tstart();
        $tEnd = $entity->get_Tend();
        $temps = $entity->get_temps();
        $PkInscr = $entity->get_Pk();

        $query = <<< SQL
            UPDATE inscr SET NoDos = '$NoDos', Rw = '$runWalk', Tstart = '$tStart', Tend = '$tEnd', Temps = '$temps' 
            WHERE PkInscr = '$PkInscr';
        SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Inscription : Erreur de mise à jour en DB", 22);
        }
        return 0;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        //Delete only if Tend is null, else throw exception
        try
        {
            $query = <<< SQL
            SELECT Tend FROM inscr WHERE PkInscr='$id';
         SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
            $result = $run->fetch();
            if($result['Tend'] != null && $result['Tend'] != '00:00:00')
                throw new DeleteInscrWithTEndException();
            $query = <<< SQL
            DELETE FROM inscr WHERE PkInscr='$id';
        SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Inscription - Erreur de suppression en DB", 21);
        }
        catch (DeleteInscrWithTEndException $e)
        {
            throw $e;
        }
    }

    /**
     * @param $PkEtud
     * @return void
     */
    public function get_NbInscrByEtudDB($PkEtud)
    {
        $query = <<< SQL
        SELECT Count(*) FROM inscr where FkEtud = '$PkEtud';
        SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetch()[0];
        }
        catch (PDOException $e)
        {
            echo "<br> Erreur de récupération depuis la base de données";
        }
    }

    public function get_NbPartByEprDB($PkEpr) // retourne le nombre d'inscrits à une épreuve
    {
        $query = <<< SQL
        SELECT Count(*) FROM inscr where FkEpr = '$PkEpr';
        SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetch()[0];
        }
        catch (PDOException $e)
        {
            echo "<br> Erreur de récupération depuis la base de données";
        }
    }

    public function readArriv($NoDos, $eprId) //méthode read pour la page d'arrivée qui prend en paramètre le numéro de dossard et l'id de l'épreuve afin d'éviter les doublons
    {
        $Tinscr = array();
        $query = <<< SQL
        SELECT * FROM inscr WHERE NoDos = '$NoDos' AND FkEpr = '$eprId';
        SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            $result = $run->fetchAll();
            foreach ($result as $row)
            {
                $t_inscr = new inscr();
                $t_inscr->set_Pk($row['PkInscr']);
                $t_inscr->set_etudId($row['FkEtud']);
                $t_inscr->set_eprId($row['FkEpr']);
                $t_inscr->set_NoDos($row['NoDos']);
                $t_inscr->set_rw($row['Rw']);
                $t_inscr->set_tStart($row['Tstart']);
                $t_inscr->set_tEnd($row['Tend']);
                $t_inscr->set_temps();
                $Tinscr[] = $t_inscr;
            }
            return $Tinscr;
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Inscription - Erreur de lecture en DB", 21);
        }
    }

}