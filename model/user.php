<?php

/**
 * classe d'utilisateur
 */
class user
{
    private $login;
    private $pswd;

    /**
     * @param $t_user
     * @return void
     * @throws Exception
     */
    private function construct_Copie($t_user)
    {
        if(get_debug_type(($t_user)) == "user")
        {
                $this->login = $t_user->login;
                $this->pswd = $t_user->pswd;
        }
        else throw new Exception("Argument invalide");
    }

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $nbarg = func_num_args();
        if($nbarg)
        {
            $arg = func_get_arg(0);
            $this->construct_Copie($arg);
        }
    }

    /**
     *
     */
    public function __destruct()
    {
        unset($this->login);
        unset($this->pswd);
    }

    /**
     * @param $t_login
     * @return void
     */
    public function set_login($t_login)
    {
        $this->login = $t_login;
    }

    /**
     * @return mixed
     */
    public function get_login()
    {
        return $this->login;
    }

    /**
     * @param $t_pswd
     * @return void
     */
    public function set_pswd($t_pswd)
    {
        $this->pswd = $t_pswd;
    }

    /**
     * @return mixed
     */
    public function get_pswd()
    {
        return $this->pswd;
    }



}