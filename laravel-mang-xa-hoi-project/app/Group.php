<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    public function group_message(){
        return $this->hasMany(GroupMessage::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
