<?php
namespace d8devs\socialposter\Model;

/**
 * Description of Post
 *
 * @property {facebook_page, twitter_account, instagram_account} for
 * @property int target
 * @property string message
 * @property string attachments
 * @property string status
 * @property strtotime sended_at
 * @property strtotime created_at
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class Post extends Model
{
    public $table = "posts";

    public $columns = [
        'for',
        'target',
        'message',
        'attachments',
        'status',
        'sended_at',
        'created_at'
    ];
}
