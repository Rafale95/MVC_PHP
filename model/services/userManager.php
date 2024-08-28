<?php

use ProjetExam\Exception\DbFailureRequestException;

include_once ('../../exception/DbFailureRequestException.php');
include_once ('../../exception/DeleteInscrWithTEndException.php');
include_once ('../../exception/DeleteClassWithStudentsException.php');
include_once ('../../exception/DeleteStudentWithInscrException.php');
include_once ('../../exception/DeleteEprWithInscrException.php');
include_once ('../../exception/UnexpectedClassException.php');



include_once('../../model/user.php');
include_once ('dbManager.php');

/**
 *
 */
class userManager
{
    public function  __construct()
    {
        $this->pDB = dbManager::get_instance();
    }
    /**
     * @param user $t_user
     * @return void
     */
    public function create(user $t_user)
    {
        $result = $this->read($t_user->get_login());
        if(!count($result))
        {
            $login = $t_user->get_login();
            $pswd = password_hash($t_user->get_pswd(), PASSWORD_DEFAULT);
            $Admin = $t_user->get_admin();
            $query = "INSERT INTO user (Login, Pswd, Admin) VALUES ('$login', '$pswd', '$Admin')";
            $run = $this->pDB->prepare($query);
            $run->execute();
        }
    }

    /**
     * @return array
     */
    public function read()
    {
        $Tuser = array();
        if(func_num_args())
        {
            $login = func_get_arg(0);
            $query = <<< SQL
                SELECT * FROM user WHERE PkUser='$login';
            SQL;
        }
        else
        {
            $query = <<< SQL
                SELECT * FROM user;
            SQL;
        }

        $run = $this->pDB->prepare($query);
        $run->execute();
        $result = $run->fetchAll();
        foreach ($result as $row)
        {
            $t_user = new user();
            $t_user->set_login($row['Login']);
            $t_user->set_pswd($row['Pswd']);
            $t_user->set_admin($row['Admin']);
            $t_user->set_Pk($row['PkUser']);
            $Tuser[] = $t_user;
        }
        return $Tuser;
    }

    public function update($entity)
    {
        if(!$entity instanceof user)
            throw new UnexpectedValueException(user::class, get_class($entity));
        $etudManager = new etudManager();
        $login = $entity->get_login();
        $pswd = password_hash($entity->get_pswd(), PASSWORD_DEFAULT);
        $PkUser = $entity->get_Pk();

        $query = <<< SQL
            UPDATE user SET Login = '$login', Pswd = '$pswd'
            WHERE PkUser = '$PkUser';
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

    /**
     * Vérifie dans la DB si le login et le mot de passe correspondent
     * @param $login
     * @param $pswd
     * @return bool
     */
    public function checkLoginPassword($login, $pswd)
    {
        $query = "SELECT * FROM user WHERE login='$login'";
        $run = $this->pDB->prepare($query);
        $run->execute();
        $result = $run->fetchAll();
        if(count($result))
            if(password_verify($pswd, $result[0]['Pswd'])) return true;
        return false;
    }

    public function checkAdmin($login)
    {
        $query = "SELECT * FROM user WHERE login='$login' and Admin = '1'";
        $run = $this->pDB->prepare($query);
        $run->execute();
        $result = $run->fetchAll();
        if(count($result))
            return true;
        return false;
    }

    public function get_admin()
    {
        $query = "SELECT * FROM user WHERE Admin = 1";
        $run = $this->pDB->prepare($query);
        $run->execute();
        $result = $run->fetchAll();
        $Tuser = array();
        foreach ($result as $row)
        {
            $t_user = new user();
            $t_user->set_login($row['Login']);
            $t_user->set_pswd($row['Pswd']);
            $t_user->set_admin($row['Admin']);
            $Tuser[] = $t_user;
        }
        return $Tuser;
    }

    public function get_UserId($Login = null, $Pk = null)
    {

        try{
            if($Pk == null)
                $query = <<< SQL
                SELECT PkUser FROM user left join etud e on user.PkUser = e.FkUser where Login = '$Login';
                SQL;
            else
                $query = <<< SQL
                SELECT PkUser FROM user left join etud e on user.PkUser = e.FkUser where PkEtud = '$Pk';
                SQL;
            $run = $this->pdb->prepare($query);
            $run->execute();
            return $run->fetchAll()[0][0]; // retourne la première colonne de la première ligne de résultat.
        }
        catch (PDOException $e)
        {
            throw new DbFailureRequestException("User : Erreur de récupération en DB", 24);
        }
    }
}