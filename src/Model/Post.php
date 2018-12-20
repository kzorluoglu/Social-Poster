<?php

namespace d8devs\socialposter\Model;

/**
 * Description of Post
 *
 * @property facebook_page|witter_account|instagram_account for
 * @property string target
 * @property string message
 * @property string link
 * @property string attachments
 * @property string status
 * @property string report
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
        'link',
        'attachments',
        'status',
        'report',
        'sended_at',
        'created_at'
    ];
}
