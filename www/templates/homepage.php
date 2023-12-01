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
    <h1>Latest news</h1>
    <?php foreach ($postsList as $post) { ?>
        <article>
            <?php if ($post["categorie"] == "news"): ?>
                <h3 class="news">News</h3>
            <?php elseif ($post["categorie"] == "work"): ?>
                <h3 class="work">Work</h3>
            <?php elseif ($post["categorie"] == "team"): ?>
                <h3 class="team">Team</h3>
            <?php endif; ?>
            <?php echo "<h2>" . $post["titre"] . "</h2>" ?>
            <div class="info">
                <img src="images/icon-john.png" alt="">
                <h4><strong>
                </h4></strong> le
                <?php echo $post["date_publication"] ?>
                </h4>
            </div>
            <p class="toudou">
                <?php echo $post["contenu"] ?>
            </p>
            <a href="./single_article.php?id=<?php echo $post["id"] ?>">Continue reading</a>
        </article>
    <?php } ?>
</section>