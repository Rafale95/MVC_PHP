<?php

class epr
{
    private $Date;
    private $tStart;
    private $dist;
    private $nbPart;
    private $anSco;
    private $PkEpr;

    public function __construct()
    {
        if(func_num_args()) // réception d'un argument
        {
            $t_arg = func_get_arg(0);
            if(is_object($t_arg))$this->constructC($t_arg);
            else throw new InvalidArgumentException("Argument invalide");
        }
    }

    private function constructC($t_epr)
    {
        if(get_class($t_epr) == epr::class)
        {
            $this->Date = $t_epr->Date;
            $this->tStart = $t_epr->tStart;
            $this->dist = $t_epr->dist;
            $this->nbPart = $t_epr->nbPart;
            $this->anSco = $t_epr->anSco;
        }
        else throw new InvalidArgumentException("Argument invalide");
    }
    public function set_Pk($t_PkEpr)
    {
        $this->PkEpr = $t_PkEpr;
    }

    public function get_Pk()
    {
        return $this->PkEpr;
    }

    public function set_Date($t_Date)
    {
        $this->Date = $t_Date;
    }

    public function get_Date()
    {
        return $this->Date;
    }

    public function set_tStart($t_tStart)
    {
        $this->tStart = $t_tStart;
    }

    public function get_tStart()
    {
        return $this->tStart;
    }

    public function set_dist($t_dist)
    {
        $this->dist = $t_dist;
    }

    public function get_dist()
    {
        return $this->dist;
    }

    public function set_nbPart($t_nbPart)
    {
        $this->nbPart = $t_nbPart;
    }

    public function get_nbPart()
    {
        return $this->nbPart;
    }

    public function set_anSco($t_anSco)
    {
        $this->anSco = $t_anSco;
    }

    public function get_anSco()
    {
        return $this->anSco;
    }
}