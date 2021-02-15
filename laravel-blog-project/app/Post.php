<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // table name
    protected $table = 'posts';
    // primary key
    protected $primaryKey = 'id';
    // timestamps
    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
