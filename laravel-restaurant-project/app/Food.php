<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    # table name
    protected $table = 'foods';
    # primary key
    protected $primaryKey = 'id';
    # timestamps
    public $timestamps = true;

    public function categories()
    {
        return $this->belongsTo('App\Categorie');
    }
}
