<?php
namespace d8devs\socialposter\Model;

/**
 * Description of Post
 *
 * @property string description
 * @property string consumer_key
 * @property string consumer_secret
 * @property string access_token
 * @property string access_token_secret
 * @property strtotime created_at
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class TwitterAccount extends Model
{
    public $table = "twitter_accounts";

    public $columns = [
        'description',
        'consumer_key',
        'consumer_secret',
        'access_token',
        'access_token_secret',
        'created_at'
    ];
}
