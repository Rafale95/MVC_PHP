# MVC_PHP
Projet d'examen Site de gestion d'épreuves scolaires sportives en php structure MVC

Fait par Jérémie Reuter

________________________________
Mode d’emploi du site

Le fonctionnement du site est assez simple, chaque lien dans le menu représente un module (Etudiant, Epreuve, Classe, Inscription, Arrivée,  un bouton quitter déconnectera l’utilisateur.

Au premier accès, l’utilisateur devra créer un compte et choisir un mot de passe. Il pourra s’y connecter plus tard grâce à ces identifiants.

Une classe ne peut pas être supprimée si elle contient des étudiants.
Un étudiant ne peut pas être supprimé s’il est inscrit à au moins une épreuve.
Une épreuve ne peut pas être supprimée si des étudiants y sont inscrits.
Une inscription ne peut pas être supprimée si l’heure d’arrivée est encodée.

Le but est de suivre le déroulement d’épreuves sportives scolaires en y encodant des numéro de dossards à chaque arrivée et ainsi suivre les résultats (temps et ratio Run/Walk).
