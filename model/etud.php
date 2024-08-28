<?php
include_once 'inscr.php';

/**
 * Classe d'étudiant
 */
class etud
{
    private $Pk;
    private $nom;
    private $pren;
    private $sexe;
    private $nbInscr;
    private $clas;

    public function __construct()
    {
        if(func_num_args()) // réception d'un argument
        {
            $t_arg = func_get_arg(0);
            if(is_object($t_arg))$this->constructC($t_arg);
            else throw new InvalidArgumentException("Argument invalide");
        }
    }

    /**
     * @param $t_etud
     * @return void
     */
    private function constructC($t_etud)
    {
        if(get_class($t_etud) == etud::class)
        {
            $this->Pk = $t_etud->Pk;
            $this->nom = $t_etud->nom;
            $this->pren = $t_etud->pren;
            $this->sexe = $t_etud->sexe;
            $this->nbInscr = $t_etud->nbInscr;
            $this->clas = $t_etud->clas;
        }
        else throw new InvalidArgumentException("Argument invalide");
    }

    /**
     * @param string $t_nom
     * @return void
     */
    public function set_nom(string $t_nom)
    {
        $this->nom = $t_nom;
    }

    /**
     * @return mixed
     */
    public function get_nom()
    {
        return $this->nom;
    }

    /**
     * @param $t_pren
     * @return void
     */
    public function set_pren($t_pren)
    {
        $this->pren = $t_pren;
    }

    /**
     * @return mixed
     */
    public function get_pren()
    {
        return $this->pren;
    }

    /**
     * @param $t_sexe
     * @return void
     */
    public function set_sexe($t_sexe)
    {
        $this->sexe = $t_sexe;
    }

    /**
     * @return mixed
     */
    public function get_sexe()
    {
        return $this->sexe;
    }

    /**
     * @param $t_nbInscr
     * @return void
     */
    public function set_nbInscr($t_nbInscr)
    {
        $this->nbInscr = $t_nbInscr;
    }

    /**
     * @return mixed
     */
    public function get_nbInscr()
    {
        return $this->nbInscr;
    }

    /**
     * @param $t_clas
     * @return void
     */
    public function set_clas($t_clas)
    {
        $this->clas = $t_clas;
    }

    /**
     * @return mixed
     */
    public function get_clas()
    {
        return $this->clas;
    }

    /**
     * @param $t_Pk
     * @return void
     */
    public function set_Pk($t_Pk)
    {
        $this->Pk = $t_Pk;
    }

    /**
     * @return mixed
     */
    public function get_Pk()
    {
        return $this->Pk;
    }

    public function set_user($t_user)
    {
        $this->user = $t_user;
    }

    public function get_user()
    {
        return $this->user;
    }


}