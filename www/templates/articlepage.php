<main>
<link rel="stylesheet" type="text/css" href="./css/create_article.css">
<form class="m-5" action="#" method="post">
  <div class="mb-3">
    <label for="titre" class="form-label">Titre</label>
    <input type="text" class="form-control" id="titre" name="titre">
    <label for="contenu" class="form-label">Contenu</label>
    <input type="text" class="form-control" id="contenu" name="contenu">
    <label for="categorie" class="form-label">Categorie</label>
    <input type="text" class="form-control" id="categorie" name="categorie">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
// var_dump($_POST);
$erreur=[];
$message=[];
// test prenom
if(isset($_POST['titre']) && preg_match('/[a-z]+$/', $_POST['titre'])){
    array_push($message, 'ok pour le titre');
}else{
    array_push($erreur, 'Le titre n\'est pas valide');
}
if(isset($_POST['categorie']) && preg_match('/[a-z]+$/', $_POST['categorie'])){
    array_push($message, 'ok pour la categorie');
}else{
    array_push($erreur, 'La categorie n\'est pas valide');
}

if($erreur==[]){
    require("./inc/db.php");

    $request=$pdo->prepare("INSERT INTO article (titre, contenu, categorie, auteur, date_publication) VALUES (?, ?, ?, ?);");
    $request->execute([$_POST['titre'], $_POST['contenu'], $_POST['categorie'], date("Y-m-d")]);
}

?>
<ul>
    <?php
    foreach($message as $value){
        echo "<li>".$value."</li>";
    }
    ?>
</ul>
<ul>
    <?php
    foreach($erreur as $item){
        echo "<li>".$item."</li>";
    }
    ?>
</ul>
</main>