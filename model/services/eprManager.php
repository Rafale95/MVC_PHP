<?php
use ProjetExam\Exception\DbFailureRequestException;
use ProjetExam\Exception\DeleteEprWithInscrException;

include_once ('../../model/epr.php');
include_once ('dbManager.php');
include_once ('inscrManager.php');
include_once ('CRUD.php');

class eprManager implements CRUD
{
    public function  __construct()
    {
        $this->pdb = dbManager::get_instance();
    }

    public function create($entity)
    {
        if(!$entity instanceof epr) //sécu pour éviter une erreur de type de la part du dev
            throw new UnexpectedValueException(epr::class, get_class($entity));
        $anSco = $entity->get_anSco();
        $date = $entity->get_date();
        $tStart = $entity->get_tStart();
        $dist = $entity->get_dist();
        $nbPart = 0;

        $query = <<< SQL
            INSERT INTO epr
            VALUES (null, '$date', '$tStart', '$dist', '$nbPart', '$anSco');
        SQL;
        try {
            $run = $this->pdb->query($query);
            if($run) $entity->set_Pk($this->pdb->lastInsertId());
            else throw new DbFailureRequestException("Epreuve : Erreur d\'insertion en DB", 21);
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Epreuve : Erreur d\'insertion en DB", 21);
        }
        catch (DbFailureRequestException $e)
        {
            throw $e;
        }
        return 0;

    }

    public function read(int $id = null)
    {
        $Tepr = array();
        if($id !== null) // check si l'id n'est pas null et bien un entier
            $query = <<< SQL
                SELECT * FROM epr WHERE PkEpr='$id';
                SQL;

        else
            $query = <<< SQL
                SELECT * FROM epr;
                SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            $result = $run->fetchAll();
            foreach ($result as $row)
            {
                $t_epr = new epr;
                $inscrManager = new inscrManager();
                $t_epr->set_anSco($row['AnSco']);
                $t_epr->set_date($row['Date']);
                $t_epr->set_tStart($row['Tstart']);
                $t_epr->set_dist($row['Dist']);
                $t_epr->set_nbPart($inscrManager->get_NbPartByEprDB($row['PkEpr']));
                $t_epr->set_Pk($row['PkEpr']);
                $Tepr[] = $t_epr;
            }
            return $Tepr;
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Epreuve : Erreur de lecture en DB", 22);
        }
    }

    public function update($entity)
    {
        if(!$entity instanceof epr) //sécu pour éviter une erreur de type de la part du dev
            throw new UnexpectedValueException(epr::class, get_class($entity));
        $inscrManager = new inscrManager();
        $anSco = $entity->get_anSco();
        $date = $entity->get_date();
        $tStart = $entity->get_tStart();
        $dist = $entity->get_dist();
        $nbPart = $inscrManager->get_NbPartByEprDB($entity->get_Pk());
        $PkEpr = $entity->get_Pk();

        $query = <<< SQL
            UPDATE epr SET AnSco='$anSco', Date='$date', Tstart='$tStart', Dist='$dist', NbPart='$nbPart'
            WHERE PkEpr='$PkEpr';
        SQL;
        try {
            $run = $this->pdb->prepare($query);
            $run->execute();
        } catch (PDOException $e) {
            throw new DbFailureRequestException("Epreuve : Erreur de mise à jour en DB", 23);
        }
        return 0;
    }

    public function delete(int $id)
    {
        try {
            $incrManager = new inscrManager();
             if($incrManager->get_NbPartByEprDB($id) > 0)
                 throw new DeleteEprWithInscrException();

             $query = <<< SQL
                    DELETE FROM epr WHERE PkEpr='$id';
             SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
        } catch (PDOException $e) {
            throw new DbFailureRequestException("Epreuve : Erreur de suppression en DB", 24);
        }
        catch (DeleteEprWithInscrException $e)
        {
            throw $e;
        }
    }
    /**
     * @param $ClasName
     * @return void
     */
    public function get_EprId($Pk) // retourne l'id de l'épreuve
    {
        try{
            $query = <<< SQL
                SELECT PkEpr FROM epr left join inscr i on epr.PkEpr = i.FkEpr where PkInscr = '$Pk';
                SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll()[0][0]; // retourne la première colonne de la première ligne de résultat.
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Epreuve : Erreur de récupération en DB", 24);
        }
    }

    public function  get_EprTstart($Pk = null, $PkInscr = null) // retourne l'heure de début de l'épreuve
    {
        try
        {
            if ($PkInscr == null)
            {
                $query = <<< SQL
                SELECT Tstart FROM epr where PkEpr = '$Pk';
                SQL;
            }
            else
            {
                $query = <<< SQL
                SELECT Tstart FROM epr left join inscr i on epr.PkEpr = i.FkEpr where PkInscr = '$PkInscr';
                SQL;
            }
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll()[0][0]; // retourne la première colonne de la première ligne de résultat.
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Epreuve : Erreur de récupération en DB", 24);
        }
    }

    public function get_EprDate($Id) // retourne la date de l'épreuve
    {
        try
        {
            $query = <<< SQL
                SELECT Date FROM epr where PkEpr = '$Id';
                SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll()[0][0]; // retourne la première colonne de la première ligne de résultat.
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Epreuve : Erreur de récupération en DB", 24);
        }
    }

    public function get_EprAnSco($Pk) // retourne l'année scolaire de l'épreuve
    {
        try
        {
            $query = <<< SQL
                SELECT AnSco FROM epr where PkEpr = '$Pk';
                SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll()[0][0]; // retourne la première colonne de la première ligne de résultat.
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Epreuve : Erreur de récupération en DB", 24);
        }
    }

    public function get_TEpr() // retourne les épreuves
    {
        try
        {
            $query = <<< SQL
                SELECT  AnSco, Date FROM epr;
                SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll();
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Epreuve : Erreur de récupération en DB", 24);
        }
    }

    public function readMain() // retourne les 10 dernières épreuves, méthode créée pour la page d'accueil
    {
        $Tepr = array();
        $query = <<< SQL
            SELECT * FROM epr ORDER BY Date DESC LIMIT 10;
            SQL;
        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            $result = $run->fetchAll();
            foreach ($result as $row)
            {
                $t_epr = new epr;
                $inscrManager = new inscrManager();
                $t_epr->set_anSco($row['AnSco']);
                $t_epr->set_date($row['Date']);
                $t_epr->set_tStart($row['Tstart']);
                $t_epr->set_dist($row['Dist']);
                $t_epr->set_nbPart($inscrManager->get_NbPartByEprDB($row['PkEpr']));
                $t_epr->set_Pk($row['PkEpr']);
                $Tepr[] = $t_epr;
            }
            return $Tepr;
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Epreuve : Erreur de lecture en DB", 22);
        }
    }
    public function get_sumRwByEprDB($PkEpr) // retourne la somme des rw pour une épreuve
    {
        $query = <<< SQL
        SELECT SUM(Rw) FROM inscr where FkEpr = '$PkEpr';
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
}