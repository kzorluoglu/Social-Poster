<?php require 'layout/header.php'; ?>
<div class="container">


    <?php foreach ($posts as $post) : ?>
        <?php echo $post->for; ?>

    <?php endforeach; ?>
</div>
<?php require 'layout/footer.php'; ?>