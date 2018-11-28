<?php

namespace d8devs\socialposter\Account;

use d8devs\socialposter\Model\TwitterUser;

/**
 * Description of Twitter
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class Twitter {

    protected $accounts;

    public function __construct() {

        $this->addAccount(new TwitterUser(
                'yourConsumerKey', 'yourConsumerSecretkey', 'yourAccessToken', 'yourAccesTokenSecret'
        ));

    }

    function addAccount(TwitterUser $user) {
        $this->accounts[] = $user;
    }

    public function getAccounts() {
        return $this->accounts;
    }

}
