<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Typ</th>
            <th scope="col">Description</th>
            <th scope="col">Informations</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php if ($facebook_pages): ?>
            <?php foreach ($facebook_pages as $account): ?>
                <form method="post">
                    <tr>
                        <td>
                            Facebook Page
                            <input type="hidden" name="id" value="<?php echo $account->id; ?>">
                        </td>
                        <td>
                            <input class="form-control" name="description" value="<?php echo $account->description; ?>">
                        </td>
                        <td>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">page</span>
                                </div>
                                <input type="text" class="form-control" name="page"
                                       value="<?php echo $account->page; ?>">
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">app_id</span>
                                </div>
                                <input type="text" class="form-control" name="app_id"
                                       value="<?php echo $account->app_id; ?>">
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">app_secret</span>
                                </div>
                                <input type="password" class="form-control" name="app_secret"
                                       value="<?php echo $account->app_secret; ?>">
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">default_graph_version</span>
                                </div>
                                <input type="text" class="form-control" name="default_graph_version"
                                       value="<?php echo $account->default_graph_version; ?>"></div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">access_token</span>
                                </div>
                                <input type="password" class="form-control" name="access_token"
                                       value="<?php echo $account->access_token; ?>"></div>
                        </td>
                        <td>
                            <input type="submit" name="facebook_page|update" value="Update">
                            <input type="submit" name="facebook_page|delete" value="Delete">
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($twitter_accounts): ?>
            <?php foreach ($twitter_accounts as $account): ?>
                <form method="post">
                    <tr>

                        <td>
                            Twitter Account
                            <input type="hidden" name="id" value="<?php echo $account->id; ?>">

                        </td>
                        <td>
                            <input class="form-control" name="description" value="<?php echo $account->description; ?>">
                        </td>
                        <td>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">consumer_key</span>
                                </div>
                                <input type="text" class="form-control" name="consumer_key"
                                       value="<?php echo $account->consumer_key; ?>">
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">consumer_secret</span>
                                </div>
                                <input type="password" class="form-control" name="consumer_secret"
                                       value="<?php echo $account->consumer_secret; ?>">
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">access_token</span>
                                </div>
                                <input type="text" class="form-control" name="access_token"
                                       value="<?php echo $account->access_token; ?>"></div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">access_token_secret</span>
                                </div>
                                <input type="password" class="form-control" name="access_token_secret"
                                       value="<?php echo $account->access_token_secret; ?>"></div>
                        </td>
                        <td>
                            <input type="submit" name="twitter_account|update" value="Update">
                            <input type="submit" name="twitter_account|delete" value="Delete">
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($instagram_accounts): ?>
            <?php foreach ($instagram_accounts as $account): ?>
                <form method="post">
                    <tr>
                        <td>
                            Instagram Account
                            <input type="hidden" name="id" value="<?php echo $account->id; ?>">

                        </td>
                        <td>
                            <input class="form-control" name="description" value="<?php echo $account->description; ?>">
                        </td>
                        <td>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">username</span>
                                </div>
                                <input type="text" class="form-control" name="username"
                                       value="<?php echo $account->username; ?>">
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">password</span>
                                </div>
                                <input type="password" class="form-control" name="password"
                                       value="<?php echo $account->password; ?>">
                            </div>

                        </td>
                        <td>
                            <input type="submit" name="instagram_account|update" value="Update">
                            <input type="submit" name="instagram_account|delete" value="Delete">
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#facebook_page" role="button" aria-expanded="false"
           aria-controls="collapseExample">
            New Facebook Page
        </a>
        <a class="btn btn-primary" data-toggle="collapse" href="#twitter_account" role="button" aria-expanded="false"
           aria-controls="collapseExample">
            New Twitter Account
        </a>
        <a class="btn btn-primary" data-toggle="collapse" href="#instagram_account" role="button" aria-expanded="false"
           aria-controls="collapseExample">
            New Instagram Account
        </a>
    </p>
    <!-- facebook_page collapse -->
    <div class="collapse" id="facebook_page">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Typ</th>
                <th scope="col">Description</th>
                <th scope="col">Informations</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <form method="post">
                <tr>
                    <td>
                        Facebook Page
                    </td>
                    <td>
                        <input class="form-control" name="description" value="">
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">page</span>
                            </div>
                            <input type="text" class="form-control" name="page"
                                   value="">
                        </div>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">app_id</span>
                            </div>
                            <input type="text" class="form-control" name="app_id"
                                   value="">
                        </div>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">app_secret</span>
                            </div>
                            <input type="password" class="form-control" name="app_secret"
                                   value="">
                        </div>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">default_graph_version</span>
                            </div>
                            <input type="text" class="form-control" name="default_graph_version"
                                   value=""></div>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">access_token</span>
                            </div>
                            <input type="password" class="form-control" name="access_token"
                                   value=""></div>
                    </td>
                    <td>
                        <input type="submit" name="facebook_page|insert" value="Save">
                    </td>
                </tr>
            </form>
            </tbody>
        </table>
    </div>

    <!-- twitter_account collapse -->
    <div class="collapse" id="twitter_account">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Typ</th>
                <th scope="col">Description</th>
                <th scope="col">Informations</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <form method="post">
                <tr>
                    <td>
                        Twitter Account
                    </td>
                    <td>
                        <input class="form-control" name="description" value="">
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">consumer_key</span>
                            </div>
                            <input type="text" class="form-control" name="consumer_key"
                                   value="">
                        </div>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">consumer_secret</span>
                            </div>
                            <input type="password" class="form-control" name="consumer_secret"
                                   value="">
                        </div>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">access_token</span>
                            </div>
                            <input type="text" class="form-control" name="access_token"
                                   value=""></div>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">access_token_secret</span>
                            </div>
                            <input type="password" class="form-control" name="access_token_secret"
                                   value=""></div>
                    </td>

                    <td>
                        <input type="submit" name="twitter_account|insert" value="Save">
                    </td>
                </tr>
            </form>
            </tbody>
        </table>
    </div>

    <!-- instagram_account collapse -->
    <div class="collapse" id="instagram_account">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Typ</th>
                <th scope="col">Description</th>
                <th scope="col">Informations</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <form method="post">
                <tr>
                    <td>
                        Instagram Account
                    </td>
                    <td>
                        <input class="form-control" name="description" value="">
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">username</span>
                            </div>
                            <input type="text" class="form-control" name="username"
                                   value="">
                        </div>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">password</span>
                            </div>
                            <input type="password" class="form-control" name="password"
                                   value="">
                        </div>

                    </td>

                    <td>
                        <input type="submit" name="instagram_account|insert" value="Save">
                    </td>
                </tr>
            </form>
            </tbody>
        </table>
    </div>

</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
