<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section>
    <h1>Articles written by <i><?= $_GET["author"] ?></i> </h1>
    <pre style="background-color: #E9E5D6">
        <ul>
            <?php foreach ($articles as $article) : if ($article->author == $_GET["author"]){ ?>
                <li><a href="index.php?page=articles-show&id=<?= $article->id ?>"><?= $article->title ?></a> (<?= $article->formatPublishDate() ?>)</li>
            <?php } endforeach; ?>
        </ul>
    </pre>
</section>

<?php require 'View/includes/footer.php'?>