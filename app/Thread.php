<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use recordActivity;
    protected $fillable = ['user_id', 'title', 'body', 'channel_id'];
    protected $with = ['owner','channel'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        }); // ini maksudnya setiap kali panggil Thread::all(); maka pasti akan ada property 'replies_count' yg hitung jumlah reply dalam thread kita
        // static::addGlobalScope('owner', function ($builder) {
        //     $builder->with('owner');
        // });
        static::deleting(function ($thread){
            $thread->replies->each->delete();
        }); // when deleting thread, also delete replies, ini namanya Model Events
    }

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

    /** function to call filters */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
