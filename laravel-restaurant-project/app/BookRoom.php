<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookRoom extends Model
{
     # table name
     protected $table = 'book_rooms';
     # primary key
     protected $primaryKey = 'id';
     # timestamps
     public $timestamps = true;
}
