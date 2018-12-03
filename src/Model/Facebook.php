<?php
namespace d8devs\socialposter\Model;

/**
 * Description of Facebook
 *
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class Facebook
{

    protected $page;
    protected $app_id;
    protected $app_secret;
    protected $default_graph_version;
    protected $accessToken;

    public function __construct($page, $app_id, $app_secret, $default_graph_version, $accessToken)
    {
        $this->page = $page;
        $this->app_id = $app_id;
        $this->app_secret = $app_secret;
        $this->default_graph_version = $default_graph_version;
        $this->accessToken = $accessToken;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getAppId()
    {
        return $this->app_id;
    }

    public function getAppSecret()
    {
        return $this->app_secret;
    }

    public function getDefaultGraphVersion()
    {
        return $this->default_graph_version;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
