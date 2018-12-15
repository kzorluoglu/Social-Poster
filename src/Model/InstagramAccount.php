<?php
namespace d8devs\socialposter\Model;

/**
 * Description of Post
 *
 * @property string description
 * @property strtotime created_at
 * @author Koray Zorluoglu <koray@d8devs.com>
 */
class InstagramAccount extends Model
{
    public $table = "instagram_accounts";

    public $columns = [
        'description',
        'created_at'
    ];
}
