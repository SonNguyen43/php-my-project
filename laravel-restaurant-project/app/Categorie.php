<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    # table name
    protected $table = 'categories';
    # primary key
    protected $primaryKey = 'id';
    # timestamps
    public $timestamps = true;

    public function foods()
    {
        return $this->hasMany('App\Food');
    }
}
