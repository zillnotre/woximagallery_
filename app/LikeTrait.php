<?php

namespace App;

trait LikeTrait
{
    public function likes()
    {
        return $this->morphMany('App\Models\like_foto', 'likeable');
    }

    public function YouLikeIt()
    {
        $like = new \App\Models\like_foto(); // Correct namespace
        $like->user_id = auth()->user()->id;

        $this->likes()->save($like);

        return $like;
    }

    public function YouLiked()
    {
        return !!$this->likes()->where('user_id', auth()->id())->count();
    }

    public function YouUnlike()
    {
        $this->likes()->where('user_id', auth()->id())->delete();
    }
}
