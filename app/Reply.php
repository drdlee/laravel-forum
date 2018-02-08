<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use seeFavoriteFromReply;

    protected $fillable = ['body', 'user_id'];
    protected $with = ['owner', 'favorites'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}
