<?php
namespace d8devs\socialposter\Account;

use d8devs\socialposter\Model\Facebook;

/**
 * Description of FacebookPage
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class FacebookPage
{
    protected $accounts;

    public function __construct()
    {
        $this->addAccount(
            new Facebook('yourPageId', 'yourAppId', 'yourAppSecretCode', 'yourGraphVersion', 'yourLongAccessToken')
        );
    }

    private function addAccount(Facebook $facebook)
    {
        $this->accounts[] = $facebook;
    }

    public function getAccounts()
    {
        return $this->accounts;
    }
}
