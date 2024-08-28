<?php

class clas
{
    private $niv;
    private $ident;
    private $nbEtud;

    public function __construct()
    {
        if(func_num_args()) // réception d'un argument
        {
            $t_arg = func_get_arg(0);
            if(is_object($t_arg))$this->constructC($t_arg);
            else throw new InvalidArgumentException("Argument invalide");
        }
    }

    private function constructC($t_clas)
    {
        if(get_class($t_clas) == clas::class)
        {
            $this->niv = $t_clas->niv;
            $this->ident = $t_clas->ident;
            $this->nbEtud = $t_clas->nbEtud;
        }
        else throw new InvalidArgumentException("Argument invalide");
    }

    public function set_niv($t_niv)
    {
        $this->niv = $t_niv;
    }

    public function get_niv()
    {
        return $this->niv;
    }

    public function set_ident($t_ident)
    {
        $this->ident = $t_ident;
    }

    public function get_ident()
    {
        return $this->ident;
    }

    public function set_nbEtud($t_nbEtud)
    {
        $this->nbEtud = $t_nbEtud;
    }

    public function set_Pk($t_Pk)
    {
        $this->Pk = $t_Pk;
    }

    public function get_Pk()
    {
        return $this->Pk;
    }

    public function get_etab()
    {
        return $this->etab;
    }

    public function set_etab($t_etab)
    {
        $this->etab = $t_etab;
    }
}
