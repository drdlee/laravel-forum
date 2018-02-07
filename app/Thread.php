<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'channel_id'];

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    /** relationship to reply */
    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    /** relationship to user */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /** relationship to channel */
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    /** function to add reply to its table */
    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }


}
