<?php
    require 'layout/header.php';
?>
<div class="container">

    <?php if ($error_message) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <?php if ($reports) : ?>
        <div class="alert alert-success" role="alert">
            Twitt sent to these addresses: <br>
            <?php foreach ($reports as $report) : ?>
                <?php echo $report->user->name; ?> (<?php echo $report->created_at; ?>)<br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form  method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="InputTwitt">Twitt</label>
            <textarea class="form-control" name="message"></textarea>
            <small id="InputTwittHelp" class="form-text text-muted">Maximum 140 Character.</small>
        </div>

        <div class="form-group form-check">
            <label for="exampleInputPassword1">Image\-s</label>
            <input type="file" size="32" name="pictures[]" multiple="true" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>        
</div>

<?php require 'layout/footer.php'; ?>
 