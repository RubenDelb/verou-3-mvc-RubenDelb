<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>


<section>
    
    <h1><?= $article->title ?></h1>
    <img src="<?= $article->imageLink; ?>" alt="article image">
    <pre style="background-color: #E9E5D6">
        <p><i><?= $article->formatPublishDate() ?></i></p>
        <p><?= $article->description ?></p>
        <p> Written by <a href="index.php?page=articles-author&author=<?= $article->author ?>"><i><?= $article->author ?></i></a></p>
    </pre>
    <a href="index.php?page=articles-show&id=<?= $this->getPreviousId($article->id); ?>">Previous article</a>
    <a href="index.php?page=articles-show&id=<?= $this->getNextId($article->id); ?>">Next article</a>
</section>


<?php require 'View/includes/footer.php'?>