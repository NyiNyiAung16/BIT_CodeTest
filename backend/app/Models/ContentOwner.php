<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentOwner extends Model
{
    use HasFactory;
    protected $table = 'content_owner';

    public function written_books(){
        return $this->hasMany(Book::class,'co_id','idx');
    }
}
