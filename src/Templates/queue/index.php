<?php require __DIR__.'/../layout/header.php'; ?>
    <div class="container">


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
                            <?php $target = unserialize($post->target);
                            echo $target['description']; ?>
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

            <a href="index.php?page=run" class="btn btn-primary btn-sm active"
               role="button" aria-pressed="true">Start Sending</a>

        <?php endif; ?>
    </div>
<?php require __DIR__.'/../layout/footer.php'; ?>
