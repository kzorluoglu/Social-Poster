<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container">

    <?php if ($posts) : ?>
        <meta http-equiv="refresh" content="1"/>
    <?php endif; ?>

    <?php if ($status['response']) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $status['response']; ?>
        </div>
    <?php endif; ?>

    <?php if ($status['error']) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $status['error']; ?>
        </div>
    <?php endif; ?>

    <?php if ($posts) : ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">For</th>
                <th scope="col">Target</th>
                <th scope="col">Message</th>
                <th scope="col">Attachments</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <th scope="row">
                        <?php echo $post->id; ?>
                    </th>
                    <td>
                        <?php echo $post->for; ?>
                    </td>
                    <td>
                        <?php echo $post->target; ?>
                    </td>
                    <td>
                        <?php echo $post->message; ?>
                    </td>
                    <td>
                        <?php if (unserialize($post->attachments)) : ?>
                            <?php foreach (unserialize($post->attachments) as $attach) : ?>
                                <?php echo $attach; ?> <br>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <td>
                    </td>
                </tr>
            <?php endforeach; ?>


            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
