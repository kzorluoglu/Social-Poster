<?php require 'layout/header.php'; ?>
<div class="container">

    <?php if ($status['response']) : ?>
<?php echo $status['response']; ?>
    <?php endif; ?>
    <?php if ($status['error']) : ?>
        <?php echo $status['error']; ?>
    <?php endif; ?>
    <?php foreach ($posts as $post) : ?>
        <?php echo $post->for; ?>

    <?php endforeach; ?>
</div>
<?php require 'layout/footer.php'; ?>