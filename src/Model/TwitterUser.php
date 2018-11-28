<?php

namespace d8devs\socialposter\Model;

/**
 * Description of TwitterUser
 *
 * @author Koray Zorluoglu
 */
class TwitterUser {

    protected $consumerKey;
    protected $consumerSecret;
    protected $accessToken;
    protected $accessTokenSecret;

    public function __construct($consumerKey, $consumerSecret, $accessToken = null, $accessTokenSecret = null) {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->accessToken = $accessToken;
        $this->accessTokenSecret = $accessTokenSecret;
    }

    function getConsumerKey() {
        return $this->consumerKey;
    }

    function getConsumerSecret() {
        return $this->consumerSecret;
    }

    function getAccessToken() {
        return $this->accessToken;
    }

    function getAccessTokenSecret() {
        return $this->accessTokenSecret;
    }

}
