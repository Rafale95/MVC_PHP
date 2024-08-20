<?php
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
            $query = "INSERT INTO user (login, pswd) VALUES ('$login', '$pswd')";
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
                SELECT * FROM user WHERE login='$login';
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
            $t_user->set_login($row['login']);
            $t_user->set_pswd($row['pswd']);
            $Tuser[] = $t_user;
        }
        return $Tuser;
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
}