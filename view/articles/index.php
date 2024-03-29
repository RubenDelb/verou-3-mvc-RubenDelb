<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section>
    <h1>Articles</h1>
    <pre style="background-color: #E9E5D6">
        <ul>
            <?php foreach ($articles as $article) : ?>
                <li><a href="index.php?page=articles-show&id=<?= $article->id ?>"><?= $article->title ?></a> - By <a href="index.php?page=articles-author&author=<?= $article->author ?>"><i><?= $article->author ?></i></a> (<?= $article->formatPublishDate() ?>)</li>
            <?php endforeach; ?>
        </ul>
    </pre>
</section>

<?php require 'View/includes/footer.php'?>