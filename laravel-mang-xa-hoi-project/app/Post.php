<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaKey = 'id';
    protected $timestamp = true;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function like(){
        return $this->hasMany(Like::class);
    }

    public function comment_post_parent(){
        return $this->hasMany(CommentsPostParent::class);
    }

    public function tracking(){
        return $this->hasMany(TrackingUser::class);
    }
}
