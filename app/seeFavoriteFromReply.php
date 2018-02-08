<?php

namespace App;

trait seeFavoriteFromReply
{
    /** Relationship to favorite (1 reply, many favorites)  */
    public function favorites()
    {
        return $this->morphMany('App\Favorite', 'favorited');
    }

    /** make the current reply favorited */
    public function favorite($userId)
    {
        if(! $this->favorites()->where(['user_id' => $userId])->exists()){
            return $this->favorites()->create(['user_id' => $userId ]);
            // saat create data ke database, ini ngga perlu pass in favorite_id dan favorited_type, karena ini tipe relationship morphMany
        }
    }

    /** check if thre reply is favorited */
    public function isFavorited()
    {
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}
