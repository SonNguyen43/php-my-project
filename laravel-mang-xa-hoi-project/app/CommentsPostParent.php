<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentsPostParent extends Model
{
    protected $table = 'comments_post_parents';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
