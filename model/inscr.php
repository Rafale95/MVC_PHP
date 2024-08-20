<?php

class inscr
{
    private $Pk;
    private $NoDos;
    private $rw;
    private $tStart;
    private $tEnd;
    private $temps;
    private $etud;
    private $epr;

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
        if(get_class($t_epr) == inscr::class)
        {
            $this->NoDos = $t_epr->NoDos;
            $this->rw = $t_epr->rw;
            $this->tStart = $t_epr->tStart;
            $this->tEnd = $t_epr->tEnd;
            $this->temps = $t_epr->temps;
        }
        else throw new InvalidArgumentException("Argument invalide");
    }
    public function set_Pk($t_Pk)
    {
        $this->Pk = $t_Pk;
    }

    public function get_Pk()
    {
        return $this->Pk;
    }

    public function set_NoDos($t_NoDos = null) //si null, générer un nombre aléatoire
    {
            $this->NoDos = $t_NoDos;
    }

    public function get_NoDos()
    {
        return $this->NoDos;
    }

    public function set_rw($t_rw)
    {
        if($this->get_tEnd() == null) //si tEnd est null, rw doit être null
            $this->rw = null;
        else
            $this->rw = $t_rw;
    }

    public function get_rw()
    {
        if($this->rw > 100 || $this->rw < 0)
            return -1;
        return $this->rw;
    }

    public function set_tStart($t_Tstart)
    {
        $this->tStart = $t_Tstart;
    }

    public function get_tStart()
    {
        return $this->tStart;
    }

    public function set_tEnd($t_Tend)
    {
        $this->tEnd = $t_Tend;
    }

    public function get_tEnd()
    {
        return $this->tEnd;
    }

    public function set_temps()
    {
        if($this->get_tEnd() == null)
            $this->temps = null;
        else
        {
            $tEnd = new DateTime($this->get_tEnd());
            $tStart = new DateTime($this->get_tStart());
            $t_temps = $tStart->diff($tEnd);
            $this->temps = $t_temps;
        }
    }

    public function get_temps()
    {
        return $this->temps;

    }
    public function get_etudId()
    {
        return $this->etud;
    }
    public function get_eprId()
    {
        return $this->epr;
    }
    public function set_etudId($t_etud)
    {
        $this->etud = $t_etud;
    }
    public function set_eprId($t_epr)
    {
        $this->epr = $t_epr;
    }
}