<?php

use ProjetExam\Exception\DbFailureRequestException;

include_once ('../../model/etab.php');
include_once ('dbManager.php');
include_once ('clasManager.php');

class etabManager
{
    public function  __construct()
    {
        $this->pdb = dbManager::get_instance();
    }

    public function create($entity)
    {
        if(!$entity instanceof etab) //sécu pour éviter une erreur de type de la part du dev
            throw new UnexpectedValueException(etab::class, get_class($entity));
        $etab = $entity->get_Etab();
        $anSco = $entity->get_AnSco();
        $nbClas = 0;
        try {
            $query = <<< SQL
                INSERT INTO etab
                VALUES (null, '$etab', '$nbClas', '$anSco');
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

    public function read(int $id = null)
    {
        $TEtab = array();
        if($id !== null) // check si l'id n'est pas null et bien un entier
            $query = <<< SQL
                SELECT * FROM etab WHERE PkEtab='$id';
                SQL;

        else
            $query = <<< SQL
                SELECT * FROM etab;
                SQL;

        try{
            $run = $this->pdb->prepare($query);
            $run->execute();
            $result = $run->fetchAll();
            foreach ($result as $row)
            {
                $t_etab = new etab();
                $classManager = new clasManager();
                $t_etab->set_Etab($row['Etab']);
                $t_etab->set_AnSco($row['AnSco']);
                $t_etab->set_NbClas($classManager->get_NbClasDB());
                $t_etab->set_Pk($row['PkEtab']);
                $TEtab[] = $t_etab;
            }
            return $TEtab;
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Classe : Erreur de lecture en DB", 20);
        }
        catch (DbFailureRequestException $e)
        {
            throw $e;
        }
    }

    public function update($entity)
    {
        if(!$entity instanceof etab)
            throw new UnexpectedValueException(etab::class, get_class($entity));
        $classManager = new clasManager();
        $anSco = $entity->get_AnSco();
        $etab = $entity->get_Etab();
        $PkEtab = $entity->get_Pk();
        try{

            $nbClas = $classManager->get_NbClasDB($PkEtab); //nécessaire pour qu'il y ait une modif en DB

        $query = <<< SQL
            UPDATE etab  SET Etab = '$etab', AnSco = '$anSco', NbClas = '$nbClas' 
            WHERE PkEtab = '$PkEtab';
        SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("Classe : Erreur de mise à jour en DB", 22);
        }

        return 0;
    }

    public function get_etabId($etabName = null, $Pk = null)
    {

        try{
            if($Pk == null)
                $query = <<< SQL
                SELECT PkEtab FROM etab left join clas c on etab.PkEtab = c.FkEtab where Etab = '$etabName';
                SQL;
            else
                $query = <<< SQL
                SELECT PkEtab FROM etab left join clas c on etab.PkEtab = c.FkEtab where PkClas = '$Pk';
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

}