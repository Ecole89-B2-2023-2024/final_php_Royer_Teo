<?php
require("./inc/db.php");
$sql = "SELECT * FROM `article`;";
$request = $pdo->query($sql);
$postsList = $request->fetchAll(PDO::FETCH_ASSOC);
$sql = "SELECT * FROM `utilisateur`;";
$request = $pdo->query($sql);
$usersList = $request->fetchAll(PDO::FETCH_ASSOC);
function fetch_user(int $id, array $usersList)
{
    $count = 0;
    foreach ($usersList as $users) {
        if ($users['id'] == $id) {
            return $count;
        }
        $count += 1;
    }
    return -1;
}
?>
<section>
    <?php
    foreach ($postsList as $post) {
        if ($post["id"] == $_GET["id"]) {
            ?>
            <article>
                <?php if ($post["categorie"] == "news"): ?>
                    <h2 class="news">news</h2>
                <?php elseif ($post["categorie"] == "work"): ?>
                    <h2 class="work">work</h2>
                <?php elseif ($post["categorie"] == "team"): ?>
                    <h2 class="team">Team</h2>
                <?php endif; ?>
                <?php echo "<h1>" . $post["titre"] . "</h1>" ?>
                <div class="info">
                    <img class="imggg" src="images/icon-john.png" alt="">
                    <h3><strong>
                        </strong> le
                        <?php echo $post["date_publication"] ?>
                    </h3>
                </div>
                    <img src="./images/art_image.png" alt="">
                    <?php echo $post["contenu"] ?>
                <a href="./index.php">Retour à l'Accueil</a>
            </article>
        <?php } ?>
    <?php } ?>
</section>