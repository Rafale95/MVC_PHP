<?php

class dbManager
{
    private $pdb;
    private static $instance;

    private function __construct()
    {
        try
        {
            $this->pdb = new pdo('mysql:host=localhost; dbname=jeremiereuter','root','');
            //$this->flagStop = 0;
        }
        catch (PDOException $e)
        {
            die("ERREUR de connexion à la Base de données : Code => ". $e->getCode()." - Message => ".$e->getMessage());
            //$flagStop = 1;
        }
    }

    public static function get_instance() : PDO
    {
        if(empty(self::$instance)) // pas d'accès DB
        {
            self::$instance = new dbManager();
        }
        return self::$instance->pdb;
    }

}