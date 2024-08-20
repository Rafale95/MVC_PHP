<?php

/**
 * méthode destinée à récupérer l'id d'une entité
 */
class common
{
    static function preg_matchId(string $string)
    {
        if (preg_match('/\d+$/', $string, $matches)) {
            return (int) $matches[0];  // $matches[0] contiendra la partie de la chaîne qui correspond à l'expression régulière
        } else {
            throw new Exception('aucun id trouvé');
        }
    }
}