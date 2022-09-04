<?php

namespace ETIROU\Cnx;

use PDO, PDOException;


class InstanceTheMatrix
{
    private PDO $connection; //-> Car on ne s'en sert que dans la classe donc "private".

    public function  __construct($access)
    {
        echo '<p>Connexion à la database</p>';

        try {

            //connection pour ouvrir et connecter a la bdd en utilisant le fichier conx.php.

            $this->connection = new PDO('mysql:host=' . $access['db']['host'] . ';dbname=' . $access['db']['database'] . '',  $access['db']['user'], $access['db']['password']);
        } catch (PDOException $e) {
            $message = 'Erreur !: ' . $e->getMessage() . "<br/>";
            die($message);
        }
    }


    public function request($req, $fetchMode = 'fetchAll') //-> Force de base en fetchAll.
    {
        return $this->connection->query($req, PDO::FETCH_ASSOC)->{$fetchMode}();

        //On met la variable entre {} pour 
        //tricker la concaténation ->fetchAll() ou ->fetch().
    }


    public function insertion($table, $values)
    {

        //Ici on break l'object $values et on retrouve en array clefs et valeurs.

        $newValuesArray = get_object_vars($values);
        $newValuesArrayKeys = array_keys($newValuesArray);
        $newValuesArrayValues = array_values($newValuesArray);

        $keysForQuery = implode(",", $newValuesArrayKeys); // -> implode pour séparer et return en string


        //Ici on boucle le nombre de ? en fonction du nombre de values.

        $tabOfValues = [];
        foreach ($newValuesArray as $i) {
            $tabOfValues[] = "?";
        };
        $tabOfValues = implode(",", $tabOfValues);


        //ici on écrit la requete sql en dynamique

        $sqlQuerry = 'INSERT INTO ' . $table . ' (' . $keysForQuery . ') VALUES (' . $tabOfValues . ')';
        $pdoQuery = $this->connection->prepare($sqlQuerry);
        $pdoQuery->execute($newValuesArrayValues);
    }

    public function  __destruct()
    {
        try {
            $connection = null;
            echo '<p>Déconnexion de la database</p>';
        } catch (PDOException $e) {
            $message = 'Erreur !: ' . $e->getMessage() . "<br/>";
            die($message);
        }
    }
}
