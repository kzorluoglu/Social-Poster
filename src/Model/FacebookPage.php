<?php
namespace d8devs\socialposter\Model;

/**
 * Description of Post
 *
 * @property string description
 * @property string page
 * @property string app_id
 * @property string app_secret
 * @property string default_graph_version
 * @property string access_token
 * @property strtotime created_at
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class FacebookPage extends Model
{
    public $table = "facebook_pages";

    public $columns = [
        'description',
        'page',
        'app_id',
        'app_secret',
        'default_graph_version',
        'access_token',
        'created_at'
    ];
}
