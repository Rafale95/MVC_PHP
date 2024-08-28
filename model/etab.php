<?php

class etab
{
    private $Etab;
    private $NbClas;
    private $AnSco;
    public function __construct()
    {
        if(func_num_args()) // réception d'un argument
        {
            $t_arg = func_get_arg(0);
            if(is_object($t_arg))$this->constructC($t_arg);
            else throw new InvalidArgumentException("Argument invalide");
        }
    }

    private function constructC($t_etab)
    {
        if(get_class($t_etab) == etab::class)
        {
            $this->Etab = $t_etab->Etab;
            $this->NbClas = $t_etab->NbClas;
            $this->AnSco = $t_etab->AnSco;
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

    public function set_Etab($t_Etab)
    {
        $this->Etab = $t_Etab;
    }

    public function get_Etab()
    {
        return $this->Etab;
    }

    public function set_NbClas($t_NbClas)
    {
        $this->NbClas = $t_NbClas;
    }

    public function get_NbClas()
    {
        return $this->NbClas;
    }

    public function set_AnSco($t_AnSco)
    {
        $this->AnSco = $t_AnSco;
    }

    public function get_AnSco()
    {
        return $this->AnSco;
    }
}