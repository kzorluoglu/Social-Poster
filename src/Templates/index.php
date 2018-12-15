<?php require 'layout/header.php'; ?>
<div class="container">
    <?php if (isset($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($reports)) : ?>
        <div class="alert alert-success" role="alert">
            Message sent to these addresses: <br>
            <?php foreach ($reports as $report) : ?>
                <?php echo $report->user->name; ?> (<?php echo $report->created_at; ?>)<br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form  method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputPost">Post</label>
            <textarea class="form-control" name="message"></textarea>
        </div>

        <div class="form-group form-check">
            <label for="inputAttachments">Attachments</label>
            <input type="file" size="32" name="files[]" multiple="true" class="form-control-file">

            <small id="attachmentsHelp" class="form-text text-muted">Multiple selection allowed.</small>
        </div>

        <div class="form-group form-check">
            <label for="inputFiles">Sending Accounts</label>

            <?php if ($facebook_pages) : ?>
                <?php foreach ($facebook_pages as $account) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="facebook_page[]" value="<?php echo $account->id; ?>"
                               id="facebookCheck<?php echo $account->id; ?>">
                        <label class="form-check-label" for="facebookCheck<?php echo $account->id; ?>">
                            <?php echo $account->description; ?> | Facebook
                        </label>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($twitter_accounts) : ?>
                <?php foreach ($twitter_accounts as $account) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="twitter_account[]" value="<?php echo $account->id; ?>"
                               id="twitterCheck<?php echo $account->id; ?>">
                        <label class="form-check-label" for="twitterCheck<?php echo $account->id; ?>">
                            <?php echo $account->description; ?> | Twitter
                        </label>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($instagram_accounts) : ?>
                <?php foreach ($instagram_accounts as $account) : ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="instagram_account[]" value="<?php echo $account->id; ?>"
                               id="instagramCheck<?php echo $account->id; ?>">
                        <label class="form-check-label" for="instagramCheck<?php echo $account->id; ?>">
                            <?php echo $account->description; ?> | Instagram
                        </label>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <button type="submit" class="btn btn-primary">Send in the queue</button>
    </form>   
</div>
<?php require 'layout/footer.php'; ?>