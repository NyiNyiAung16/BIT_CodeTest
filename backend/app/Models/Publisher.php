<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
    protected $table ='publisher';

    public function published_books(){
        return $this->hasMany(Book::class,'publisher_id','idx');
    }
}
