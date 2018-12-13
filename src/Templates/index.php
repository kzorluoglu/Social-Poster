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
            <label for="inputFiles">Accounts</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="facebook_page[]" value="1" id="facebookCheck1">
                <label class="form-check-label" for="facebookCheck1">
                    Facebook 1
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="facebook_page[]" value="2" id="facebookCheck2">
                <label class="form-check-label" for="facebookCheck2">
                    Facebook 2
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="twitter_account[]"  value="1" id="twitterCheck1">
                       <label class="form-check-label" for="twitterCheck1">
                    Twitter 1
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       name="instagram_account[]" value="1" id="instagramCheck1">
                <label class="form-check-label" for="instagramCheck1">
                    Instagram 1
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       name="instagram_account[]" value="1" id="instagramCheck2">
                <label class="form-check-label" for="instagramCheck2">
                    Instagram 2
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Send</button>
    </form>   
</div>
<?php require 'layout/footer.php'; ?>