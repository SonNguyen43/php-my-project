<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendMessage extends Model
{
    protected $table = 'friend_messages';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
