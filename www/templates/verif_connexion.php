<?php
  if(isset($_SESSION["utilisateur"])){header("Location: index.php");}
?>
<main>
<link rel="stylesheet" type="text/css" href="./css/connexion.css">
<form class="m-5" action="" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</main>
<?php
if(isset($_POST["email"]) && isset($_POST["password"])){
    require("./inc/db.php");
    $request=$pdo->prepare("SELECT * FROM `utilisateur` WHERE `email`= ?;");
    $request->execute([$_POST['email']]);
    $utilisateur=$request->fetch(PDO::FETCH_ASSOC);
    if($utilisateur==false){
        echo "L'utilisateur ou le mot de passe est invalide";
    } else {
        if($utilisateur["password"]==hash("sha512", $_POST["password"])){
            echo "vous êtes connecté";
            $_SESSION['utilisateur']=$utilisateur["login"];
            $_SESSION['role']=$utilisateur['role'];
            header('Location: index.php');
            exit;
        } else {
            echo "L'utilisateur ou le mot de passe est invalide";
        }
    }
}
?>