<?php
include './App/Models/Post.php';
include './App/Models/User.php';

include './dBug/dBug.php';
include './blog/index.php';
include './conix.php';
include './App/Tools/conx/conx.php';

use ETIROU\Cnx\InstanceTheMatrix;
use SYRADEV\Dbg\dBug;
use ETIROU\App\Models\Post;
use ETIROU\App\Models\User;

$instanceMoiEncoreCa = new InstanceTheMatrix($conf);


$newPost = new Post;

$newPost->blog_id = 3;
$newPost->date_post = 2022;
$newPost->auteur_id = 17;
$newPost->contenu = "ca c'est moi";

//On utilise la classe de conix pour PDO
$results = $instanceMoiEncoreCa->insertion('post', $newPost);

//On utilise la classe debug pour afficher le tableau
new dBug($newPost);


//new user

$newUser = new User;
$newUser->firstname = "Jean";
$newUser->lastname = "Edouard";
$newUser->email = "jean.edouard@gmail.com";
$newUser->role = "Commentator";
$newUser->birth_date = 1990;

$result2 = $instanceMoiEncoreCa->insertion('user', $newUser);
new dBug($newUser);
