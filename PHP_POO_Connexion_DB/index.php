<?php

use ETIROU\Cnx\InstanceTheMatrix;
use SYRADEV\Dbg\dBug;

include('./dBug/dBug.php');
include('./conix.php');
include('./App/Tools/conx/conx.php');

$debugger = new dBug($conf);
var_dump($debugger);




$instanceMoiCa = new InstanceTheMatrix($conf);


$req0 = 'SELECT COUNT(*) AS nbPosts FROM `post`';
$resultat0 = $instanceMoiCa->request($req0, 'fetch');

new dBug($resultat0);

//b et p c'est un raccourci avec AS 
//inner join reférence au schéma, lien entre les deux tables
//ON pour faire la comparaison

$req1 = 'SELECT p.id AS postTitle, b.title AS blogTitle, u.firstname, u.lastname
FROM `post` p 
INNER JOIN `blog` b ON p.blog_id = b.id
INNER JOIN `user` u ON p.auteur_id = u.id
WHERE `blog_id` = 2';

//PDO fetch assoc c'est une fonction statique, 
//qu'on peut appeler sans instancier la classe, contrairement aux 
//méthodes dynamiques( comme le ->querry).

$resultat1 = $instanceMoiCa->request($req1);

new dBug($resultat1);
