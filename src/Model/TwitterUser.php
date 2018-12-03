<?php
namespace d8devs\socialposter\Model;

/**
 * Description of TwitterUser
 *
 * @author Koray Zorluoglu
 */
class TwitterUser
{

    protected $consumerKey;
    protected $consumerSecret;
    protected $accessToken;
    protected $accessTokenSecret;

    public function __construct($consumerKey, $consumerSecret, $accessToken = null, $accessTokenSecret = null)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->accessToken = $accessToken;
        $this->accessTokenSecret = $accessTokenSecret;
    }

    public function getConsumerKey()
    {
        return $this->consumerKey;
    }

    public function getConsumerSecret()
    {
        return $this->consumerSecret;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getAccessTokenSecret()
    {
        return $this->accessTokenSecret;
    }
}
