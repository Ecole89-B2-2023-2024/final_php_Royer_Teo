<?php
    if(isset($_SESSION["username"])){header("Location: index.php");}
?>
<main>
<link rel="stylesheet" type="text/css" href="./css/inscription.css">
<form class="m-5" action="#" method="post">
  <div class="mb-3">
    <label for="firstname" class="form-label">Login</label>
    <input type="text" class="form-control" id="firstname" name="firstname">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
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
if(isset($_POST['firstname']) && preg_match('/[a-z]+$/', $_POST['firstname'])){
    array_push($message, 'ok pour le login');
}else{
    array_push($erreur, 'Le login n\'est pas valide');
}
// test email
if(isset($_POST['email']) && preg_match('/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $_POST['email'])){
    array_push($message, 'ok pour l\'email');
}else{
    array_push($erreur, 'L\'email n\'est pas valide');
}
// test password
if(isset($_POST['password']) && preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@!#\?])(?=.*[a-zA-Z]).{8,}$/', $_POST['password'])){
    array_push($message, 'ok pour le mdp');
}else{
    array_push($erreur, 'Le mdp n\'est pas valide');
}
// var_dump($message);
// var_dump($erreur);
// print_r($_SERVER);
if($erreur==[]){
    require("./inc/db.php");

    $encrypted_password=hash('sha512', $_POST['password']);
    $request=$pdo->prepare("INSERT INTO utilisateur (login, email, password) VALUES (?, ?, ?);");
    $request->execute([$_POST['firstname'], $_POST['email'], $encrypted_password]);
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