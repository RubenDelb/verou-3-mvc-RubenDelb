<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section>
    <h1><?= $article->title ?></h1>
    <p><?= $article->formatPublishDate() ?></p>
    <p><?= $article->description ?></p>

    <?php pre($_GET); // TODO: links to next and previous ?>
    <a href="index.php?page=articles-show&id=<?= $this->getPreviousId($article->id); ?>">Previous article</a>
    <a href="index.php?page=articles-show&id=<?= $this->getNextId($article->id); ?>">Next article</a>
</section>

<?php require 'View/includes/footer.php'?>